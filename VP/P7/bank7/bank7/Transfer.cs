using MySql.Data.MySqlClient;
using System;
using System.Collections.Generic;
using System.ComponentModel;
using System.Data;
using System.Drawing;
using System.Text;
using System.Windows.Forms;

namespace bank7
{
    public partial class Transfer : Form
    {
        private String recipientId;
        private String senderId;
        public Transfer(String recipientId, String senderId)
        {
            InitializeComponent();
            this.recipientId = recipientId;
            this.senderId = senderId;
        }

        private void buttonTransfer_Click(object sender, EventArgs e)
        {
            labelError.Text = "";

            if (!decimal.TryParse(textBox1.Text.Trim(), out decimal amount))
            {
                labelError.Text = "Invalid amount format";
                textBox1.Clear();
                return;
            }

            if (amount <= 0)
            {
                labelError.Text = "Amount must be greater than 0";
                textBox1.Clear();
                return;
            }

            using (MySqlConnection conn = connection.getConn())
            {
                try
                {
                    conn.Open();

                    decimal senderBalance = 0;
                    string checkBalanceQuery = "SELECT saldo FROM user WHERE id = @senderId";
                    using (MySqlCommand checkCmd = new MySqlCommand(checkBalanceQuery, conn))
                    {
                        checkCmd.Parameters.AddWithValue("@senderId", senderId);
                        object result = checkCmd.ExecuteScalar();

                        if (result != null && result != DBNull.Value)
                        {
                            senderBalance = Convert.ToDecimal(result);
                        }
                    }

                    if (amount > senderBalance)
                    {
                        MessageBox.Show("Transfer Failed, Insufficient Balance", "Warning", MessageBoxButtons.OK, MessageBoxIcon.Warning);
                        return;
                    }

                    using (MySqlTransaction tx = conn.BeginTransaction())
                    {
                        try
                        {
                            string deductQuery = "UPDATE user SET saldo = saldo - @amount WHERE id = @senderId";
                            using (MySqlCommand cmd = new MySqlCommand(deductQuery, conn, tx))
                            {
                                cmd.Parameters.AddWithValue("@amount", amount);
                                cmd.Parameters.AddWithValue("@senderId", senderId);
                                cmd.ExecuteNonQuery();
                            }

                            string addQuery = "UPDATE user SET saldo = saldo + @amount WHERE id = @recipientId";
                            using (MySqlCommand cmd = new MySqlCommand(addQuery, conn, tx))
                            {
                                cmd.Parameters.AddWithValue("@amount", amount);
                                cmd.Parameters.AddWithValue("@recipientId", recipientId);
                                cmd.ExecuteNonQuery();
                            }

                            string logSenderQuery = @"INSERT INTO log_transaksi 
                        (user_id, jenis_transaksi, jumlah, user_tujuan_id, tanggal_transaksi) 
                        VALUES (@userId, 'Transfer Keluar', @jumlah, @userTujuanId, NOW())";
                            using (MySqlCommand cmd = new MySqlCommand(logSenderQuery, conn, tx))
                            {
                                cmd.Parameters.AddWithValue("@userId", senderId);
                                cmd.Parameters.AddWithValue("@jumlah", amount);
                                cmd.Parameters.AddWithValue("@userTujuanId", recipientId);
                                cmd.ExecuteNonQuery();
                            }

                            string logRecipientQuery = @"INSERT INTO log_transaksi 
                        (user_id, jenis_transaksi, jumlah, user_tujuan_id, tanggal_transaksi) 
                        VALUES (@userId, 'Transfer Masuk', @jumlah, @userTujuanId, NOW())";
                            using (MySqlCommand cmd = new MySqlCommand(logRecipientQuery, conn, tx))
                            {
                                cmd.Parameters.AddWithValue("@userId", recipientId);
                                cmd.Parameters.AddWithValue("@jumlah", amount);
                                cmd.Parameters.AddWithValue("@userTujuanId", senderId);
                                cmd.ExecuteNonQuery();
                            }

                            tx.Commit();

                            MessageBox.Show("Transfer Successful!", "Success", MessageBoxButtons.OK, MessageBoxIcon.Information);
                            this.Close();
                        }
                        catch (Exception ex)
                        {
                            tx.Rollback();
                            MessageBox.Show("Transaction failed: " + ex.Message, "Error", MessageBoxButtons.OK, MessageBoxIcon.Error);
                        }
                    }
                }
                catch (Exception ex)
                {
                    MessageBox.Show("Database Error: " + ex.Message, "Error", MessageBoxButtons.OK, MessageBoxIcon.Error);
                }
            }
        }

        private void buttonCancel_Click(object sender, EventArgs e)
        {
            this.Close();
        }

        private void Transfer_Load(object sender, EventArgs e)
        {
            labelError.Text = "";
        }
    }
}
