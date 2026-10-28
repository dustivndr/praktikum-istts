using MySqlConnector;

namespace library
{
    public partial class Login : Form
    {
        public static string connectionString = "" +
            "Server=localhost;" +
            "Port=3306;" +
            "Database=db_library;" +
            "UserID=root;" +
            "Password=;";
        public static MySqlConnection connection;

        public Login()
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

        private void openRegisterPagebtn_Click(object sender, EventArgs e)
        {
            var registerForm = new Register();
            registerForm.Show();
            this.Hide();
        }

        private void loginBtn_Click(object sender, EventArgs e)
        {
            try
            {
                connection.Open();
                string query = "" +
                    "SELECT * FROM all_users WHERE username = @username AND password = @password";
                MySqlCommand command = new MySqlCommand(query, connection);
                command.Parameters.AddWithValue("@username", nameInput.Text);
                command.Parameters.AddWithValue("@password", passwordInput.Text);
                MySqlDataReader reader = command.ExecuteReader();
                if (reader.Read())
                {
                    string userRole = reader["role"].ToString();

                    var bookCatalogForm = new BookCatalog(userRole);
                    bookCatalogForm.Show();
                    this.Hide();
                }
                else
                {
                    MessageBox.Show("Invalid username or password.");
                    nameInput.Clear();
                    passwordInput.Clear();
                }
                reader.Close();
            }
            catch (Exception ex)
            {
                MessageBox.Show(ex.Message);
            }
        }
    }
}
