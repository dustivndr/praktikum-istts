using MySql.Data.MySqlClient;

namespace bank7
{
    public partial class Login : Form
    {
        public Login()
        {
            InitializeComponent();
        }

        private void Login_Load(object sender, EventArgs e)
        {
            textBox1.Clear();
            labelError.Text = "";
        }

        private void button1_Click(object sender, EventArgs e)
        {
            using (MySqlConnection conn = connection.getConn())
            {
                conn.Open();
                
                string username = textBox1.Text;
                string connectionString = "SELECT * FROM user WHERE nama = @username";
                
                using (MySqlCommand cmd = new MySqlCommand(connectionString, conn))
                {
                    cmd.Parameters.AddWithValue("@username", username);
                    using (MySqlDataReader reader = cmd.ExecuteReader())
                    {
                        if (reader.Read())
                        {
                            this.Hide();
                            labelError.Text = "";
                            textBox1.Clear();
                            Dashboard dashboard = new Dashboard(username);
                            dashboard.FormClosed += (s, args) => this.Show();
                            dashboard.Show();
                        }
                        else
                        {
                            labelError.Text = "User not found";
                            textBox1.Clear();
                        }
                    }
                }
            }
        }
    }
}
