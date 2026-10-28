using MySqlConnector;
using System;
using System.Collections.Generic;
using System.ComponentModel;
using System.Data;
using System.Drawing;
using System.Windows.Forms;

namespace library
{
    public partial class BookCatalog : Form
    {
        public static string connectionString = "" +
            "Server=localhost;" +
            "Port=3306;" +
            "Database=db_library;" +
            "UserID=root;" +
            "Password=;";
        public static MySqlConnection connection;

        public BookCatalog(string role)
        {
            InitializeComponent();
            connectDatabase();
            LoadComboBoxes();
            LoadDataGrid();
            if (role == "Librarian")
            {
                this.Text = "Librarian - Book Catalog";
            }
            else if (role == "Patron")
            {
                this.Text = "Patron - Book Catalog";
            }
            else
            {
                this.Text = "Book Catalog";
            }
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

        private void BookCatalog_Load(object sender, EventArgs e)
        {
            LoadComboBoxes();
        }

        private void LoadComboBoxes()
        {
            try
            {
                if (connection.State != System.Data.ConnectionState.Open)
                {
                    connection.Open();
                }

                string genreQuery = "SELECT genre_id, genre_name FROM Genre";
                MySqlDataAdapter genreAdapter = new MySqlDataAdapter(genreQuery, connection);
                DataTable genreTable = new DataTable();
                genreAdapter.Fill(genreTable);

                DataRow allGenreRow = genreTable.NewRow();
                allGenreRow["genre_id"] = 0;
                allGenreRow["genre_name"] = "-- All Genres --";
                genreTable.Rows.InsertAt(allGenreRow, 0);

                genreCB.DataSource = genreTable;
                genreCB.DisplayMember = "genre_name";
                genreCB.ValueMember = "genre_id";

                string langQuery = "SELECT language_id, language_name FROM Language";
                MySqlDataAdapter langAdapter = new MySqlDataAdapter(langQuery, connection);
                DataTable langTable = new DataTable();
                langAdapter.Fill(langTable);

                DataRow allLangRow = langTable.NewRow();
                allLangRow["language_id"] = 0;
                allLangRow["language_name"] = "-- All Languages --";
                langTable.Rows.InsertAt(allLangRow, 0);

                languageCB.DataSource = langTable;
                languageCB.DisplayMember = "language_name";
                languageCB.ValueMember = "language_id";

                genreCB.SelectedIndex = 0;
                languageCB.SelectedIndex = 0;
            }
            catch (Exception ex)
            {
                MessageBox.Show("Error loading dropdowns: " + ex.Message, "Database Error", MessageBoxButtons.OK, MessageBoxIcon.Error);
            }
        }

        private void LoadDataGrid(string bookName = "", string genreName = "", string languageName = "")
        {
            try
            {
                if (connection.State != System.Data.ConnectionState.Open)
                {
                    connection.Open();
                }

                string query =
                    "SELECT " +
                    "book_id as 'Book ID', " +
                    "book_name as 'Book Name', " +
                    "genre_name as 'Genre', " +
                    "language_name as 'Language' " +
                    "FROM Book_Catalog WHERE 1=1";

                MySqlCommand command = new MySqlCommand();

                if (!string.IsNullOrWhiteSpace(bookName))
                {
                    query += " AND book_name LIKE @bookName";
                    command.Parameters.AddWithValue("@bookName", $"%{bookName.Trim()}%");
                }

                if (!string.IsNullOrWhiteSpace(genreName))
                {
                    query += " AND genre_name = @genreName";
                    command.Parameters.AddWithValue("@genreName", genreName);
                }

                if (!string.IsNullOrWhiteSpace(languageName))
                {
                    query += " AND language_name = @languageName";
                    command.Parameters.AddWithValue("@languageName", languageName);
                }

                query += " ORDER BY book_id ASC";

                command.CommandText = query;
                command.Connection = connection;

                MySqlDataAdapter adapter = new MySqlDataAdapter(command);
                DataTable dataTable = new DataTable();

                adapter.Fill(dataTable);

                dataGridView1.DataSource = dataTable;
                if (dataGridView1.Columns.Contains("Book ID"))
                {
                    dataGridView1.Sort(dataGridView1.Columns["Book ID"], ListSortDirection.Ascending);
                }
                dataGridView1.AutoSizeColumnsMode = DataGridViewAutoSizeColumnsMode.Fill;
            }
            catch (Exception ex)
            {
                MessageBox.Show("Error loading catalog: " + ex.Message, "Database Error", MessageBoxButtons.OK, MessageBoxIcon.Error);
            }
        }

        private void SearchBtn_Click(object sender, EventArgs e)
        {
            string genreName = genreCB.SelectedIndex > 0 ? genreCB.Text : "";
            string languageName = languageCB.SelectedIndex > 0 ? languageCB.Text : "";
            LoadDataGrid(bookNameInput.Text, genreName, languageName);
        }

        private void ClearBtn_Click(object sender, EventArgs e)
        {
            bookNameInput.Clear();
            genreCB.SelectedIndex = 0;
            languageCB.SelectedIndex = 0;
            LoadDataGrid();
        }

        private void BookCatalog_FormClosed(object sender, FormClosedEventArgs e)
        {
            Application.Exit();
        }

        private void backBtn_Click(object sender, EventArgs e)
        {
            var loginForm = new Login();
            loginForm.Show();
            this.Hide();
        }
    }
}
