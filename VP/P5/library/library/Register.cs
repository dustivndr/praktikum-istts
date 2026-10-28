using MySqlConnector;
using System;
using System.Collections.Generic;
using System.ComponentModel;
using System.Data;
using System.Drawing;
using System.Text;
using System.Windows.Forms;

namespace library
{
    public partial class Register : Form
    {
        public static string connectionString = "" +
            "Server=localhost;" +
            "Port=3306;" +
            "Database=db_library;" +
            "UserID=root;" +
            "Password=;";
        public static MySqlConnection connection;

        public Register()
        {
            InitializeComponent();
            connectDatabase();
        }

        public static void connectDatabase()
        {
            connection = new MySqlConnection(connectionString);
            try
            {
                connection.Open();
                connection.Close();
                MessageBox.Show("Database Connected");
            }
            catch (Exception ex)
            {
                MessageBox.Show(ex.Message);
            }
        }

        private void OpenLoginPage()
        {
            var loginForm = new Login();
            loginForm.Show();
            this.Hide();
        }

        private void openLoginPagebtn_Click(object sender, EventArgs e)
        {
            OpenLoginPage();
        }

        private void registerBtn_Click(object sender, EventArgs e)
        {
            try
            {
                if (comboBox1.SelectedItem == null)
                {
                    MessageBox.Show("Please select a valid role.", "Invalid Role", MessageBoxButtons.OK, MessageBoxIcon.Warning);
                    return;
                }

                connection.Open();
                string role = comboBox1.SelectedItem.ToString().Trim();
                string query = "";
                if (role == "Patron")
                {
                    query = "INSERT INTO patron (patron_name, password) VALUES (@username, @password);";
                }
                else if (role == "Librarian")
                {
                    query = "INSERT INTO librarian (librarian_name, password) VALUES (@username, @password);";
                }
                else
                {
                    MessageBox.Show("Please select a valid role.", "Invalid Role", MessageBoxButtons.OK, MessageBoxIcon.Warning);
                    return;
                }

                MySqlCommand command = new MySqlCommand(query, connection);
                command.Parameters.AddWithValue("@username", nameInput.Text);
                command.Parameters.AddWithValue("@password", passwordInput.Text);

                int rowsAffected = command.ExecuteNonQuery();

                if (rowsAffected > 0)
                {
                    MessageBox.Show("Registration successful!", "Success", MessageBoxButtons.OK, MessageBoxIcon.Information);

                    OpenLoginPage();
                }

            }
            catch (Exception ex)
            {
                MessageBox.Show(ex.Message);
            }
        }

        private void Register_FormClosed(object sender, FormClosedEventArgs e)
        {
            Application.Exit();
        }
    }
}
