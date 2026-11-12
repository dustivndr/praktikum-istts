using MySql.Data.MySqlClient;
using System;
using System.Data;
using System.Windows.Forms;

namespace bank7
{
    public partial class Dashboard : Form
    {
        private string username, norek;
        private int userId;
        private decimal saldo;

        public Dashboard(string username)
        {
            InitializeComponent();
            this.username = username;

            dataGridView1.AllowUserToAddRows = false;

            this.dataGridView1.CellContentClick += new System.Windows.Forms.DataGridViewCellEventHandler(this.dataGridView1_CellContentClick);
        }

        private void dashboardToolStripMenuItem_Click(object sender, EventArgs e)
        {
            panelDashboard.Show();
            panelTransLog.Hide();
        }

        private void transactionLogToolStripMenuItem_Click(object sender, EventArgs e)
        {
            panelDashboard.Hide();
            panelTransLog.Show();
            LoadTransactionLog();
        }

        private void Dashboard_Load(object sender, EventArgs e)
        {
            panelDashboard.Show();
            panelTransLog.Hide();

            LoadMainUserData();
            LoadAllUserData();
            LoadTransactionLog();
        }

        private void LoadMainUserData()
        {
            using (MySqlConnection conn = connection.getConn())
            {
                conn.Open();
                string query = "SELECT * FROM user WHERE nama = @username";

                using (MySqlCommand cmd = new MySqlCommand(query, conn))
                {
                    cmd.Parameters.AddWithValue("@username", username);
                    using (MySqlDataReader reader = cmd.ExecuteReader())
                    {
                        if (reader.Read())
                        {
                            this.userId = Convert.ToInt32(reader["id"]);
                            this.username = reader["nama"].ToString();
                            this.norek = reader["norek"].ToString();
                            this.saldo = Convert.ToDecimal(reader["saldo"]);

                            labelNama.Text = "Hello, " + username;
                            labelNorek.Text = "Account Number: " + norek;

                            UpdateBalance();
                        }
                        else
                        {
                            MessageBox.Show("User not found", "Error", MessageBoxButtons.OK, MessageBoxIcon.Error);
                        }
                    }
                }
            }
        }

        private void LoadAllUserData()
        {
            using (MySqlConnection conn = connection.getConn())
            {
                conn.Open();
                string query = "SELECT id, nama, norek FROM user WHERE nama != @username";
                using (MySqlCommand cmd = new MySqlCommand(query, conn))
                {
                    cmd.Parameters.AddWithValue("@username", username);
                    using (MySqlDataReader reader = cmd.ExecuteReader())
                    {
                        DataTable dataTable = new DataTable();
                        dataTable.Load(reader);
                        dataGridView1.DataSource = dataTable;
                    }
                }
            }

            if (dataGridView1.Columns.Contains("id"))
            {
                dataGridView1.Columns["id"].Visible = false;
            }

            dataGridView1.AutoSizeColumnsMode = DataGridViewAutoSizeColumnsMode.Fill;

            if (!dataGridView1.Columns.Contains("ActionColumn"))
            {
                DataGridViewButtonColumn transferButtonColumn = new DataGridViewButtonColumn();
                transferButtonColumn.Name = "ActionColumn";
                transferButtonColumn.HeaderText = "Action";
                transferButtonColumn.Text = "Transfer";
                transferButtonColumn.UseColumnTextForButtonValue = true;

                dataGridView1.Columns.Add(transferButtonColumn);
            }
        }

        private void LoadTransactionLog()
        {
            using (MySqlConnection conn = connection.getConn())
            {
                try
                {
                    conn.Open();

                    string query = @"
                        SELECT 
                            lt.jenis_transaksi, 
                            lt.jumlah, 
                            u.nama AS counterparty, 
                            lt.tanggal_transaksi 
                        FROM log_transaksi lt
                        LEFT JOIN user u ON lt.user_tujuan_id = u.id
                        WHERE lt.user_id = @currentUserId
                        ORDER BY lt.tanggal_transaksi DESC";

                    using (MySqlCommand cmd = new MySqlCommand(query, conn))
                    {
                        cmd.Parameters.AddWithValue("@currentUserId", userId);

                        using (MySqlDataReader reader = cmd.ExecuteReader())
                        {
                            DataTable dataTable = new DataTable();
                            dataTable.Load(reader);

                            dataGridView2.DataSource = dataTable;
                        }
                    }

                    if (dataGridView2.Columns.Contains("jenis_transaksi"))
                        dataGridView2.Columns["jenis_transaksi"].HeaderText = "Transaction Type";

                    if (dataGridView2.Columns.Contains("jumlah"))
                    {
                        dataGridView2.Columns["jumlah"].HeaderText = "Amount";
                        dataGridView2.Columns["jumlah"].DefaultCellStyle.Format = "N2";
                    }

                    if (dataGridView2.Columns.Contains("counterparty"))
                        dataGridView2.Columns["counterparty"].HeaderText = "Counterparty";

                    if (dataGridView2.Columns.Contains("tanggal_transaksi"))
                    {
                        dataGridView2.Columns["tanggal_transaksi"].HeaderText = "Date & Time";
                        dataGridView2.Columns["tanggal_transaksi"].DefaultCellStyle.Format = "yyyy-MM-dd HH:mm:ss";
                    }

                    dataGridView2.AutoSizeColumnsMode = DataGridViewAutoSizeColumnsMode.Fill;
                }
                catch (Exception ex)
                {
                    MessageBox.Show("Failed to load transaction log: " + ex.Message, "Error", MessageBoxButtons.OK, MessageBoxIcon.Error);
                }
            }
        }

        private void UpdateBalance()
        {
            labelSaldo.Text = "Balance: " + saldo.ToString("N2");
        }

        private void dataGridView1_CellContentClick(object sender, DataGridViewCellEventArgs e)
        {
            if (e.RowIndex < 0) return;

            if (e.RowIndex >= 0 && dataGridView1.Columns[e.ColumnIndex].Name == "ActionColumn")
            {
                string recipientId = dataGridView1.Rows[e.RowIndex].Cells["id"].Value.ToString();

                Transfer transferForm = new Transfer(recipientId, userId.ToString());
                transferForm.ShowDialog();

                LoadMainUserData();
                LoadAllUserData();
                LoadTransactionLog();
            }
        }
    }
}