using System;
using System.Data;
using System.Drawing;
using System.IO;
using System.Windows.Forms;

namespace growtopia
{
    public partial class LwForm : Form
    {
        public string SelectedWorld { get; private set; }
        private string currentWorld;

        private Label lblCurrent;
        private DataGridView dgvWorlds;
        private Label lblPrompt;
        private TextBox txtWorldName;
        private Button btnJoin;
        private Button btnCancel;

        public LwForm(string currentWorldName)
        {
            this.currentWorld = currentWorldName;
            InitializeUI();
            LoadWorldList();
        }

        private void InitializeUI()
        {
            this.Text = "Leave World & Join World";
            this.Size = new Size(400, 320);
            this.FormBorderStyle = FormBorderStyle.FixedDialog;
            this.StartPosition = FormStartPosition.CenterParent;
            this.MaximizeBox = false;
            this.MinimizeBox = false;

            lblCurrent = new Label
            {
                Text = $"Current World: {currentWorld} (Auto-saved)",
                Location = new Point(15, 15),
                AutoSize = true
            };
            this.Controls.Add(lblCurrent);

            dgvWorlds = new DataGridView
            {
                Location = new Point(15, 45),
                Size = new Size(350, 120),
                AllowUserToAddRows = false,
                ReadOnly = true,
                SelectionMode = DataGridViewSelectionMode.FullRowSelect,
                RowHeadersVisible = false,
                AllowUserToResizeRows = false,
                AutoSizeColumnsMode = DataGridViewAutoSizeColumnsMode.Fill
            };
            dgvWorlds.SelectionChanged += DgvWorlds_SelectionChanged;
            this.Controls.Add(dgvWorlds);

            lblPrompt = new Label
            {
                Text = "World Name to Join /",
                Location = new Point(15, 175),
                AutoSize = true
            };
            this.Controls.Add(lblPrompt);

            txtWorldName = new TextBox
            {
                Location = new Point(15, 195),
                Size = new Size(350, 20),
                Font = new Font(this.Font, FontStyle.Bold),
                CharacterCasing = CharacterCasing.Upper
            };
            this.Controls.Add(txtWorldName);

            btnJoin = new Button
            {
                Text = "🚀 Join",
                Location = new Point(180, 230),
                Size = new Size(90, 30),
                BackColor = Color.SteelBlue,
                ForeColor = Color.White,
                FlatStyle = FlatStyle.Flat
            };
            btnJoin.FlatAppearance.BorderSize = 0;
            btnJoin.Click += BtnJoin_Click;
            this.Controls.Add(btnJoin);

            btnCancel = new Button
            {
                Text = "Cancel",
                Location = new Point(275, 230),
                Size = new Size(90, 30),
                FlatStyle = FlatStyle.Standard
            };
            btnCancel.Click += (s, e) => { this.DialogResult = DialogResult.Cancel; this.Close(); };
            this.Controls.Add(btnCancel);

            this.AcceptButton = btnJoin;
            this.CancelButton = btnCancel;
        }

        private void LoadWorldList()
        {
            DataTable worldList = new DataTable("WorldList");
            worldList.Columns.Add("World", typeof(string));
            worldList.Columns.Add("Modified", typeof(string));

            string[] files = Directory.GetFiles(AppDomain.CurrentDomain.BaseDirectory, "*.xml");

            foreach (string file in files)
            {
                string fileName = Path.GetFileNameWithoutExtension(file);
                DateTime lastModified = File.GetLastWriteTime(file);

                worldList.Rows.Add(fileName.ToUpper(), lastModified.ToString("M/d/yyyy h:mm:ss tt"));
            }

            dgvWorlds.DataSource = worldList;

            dgvWorlds.ClearSelection();
        }

        private void DgvWorlds_SelectionChanged(object sender, EventArgs e)
        {
            if (dgvWorlds.SelectedRows.Count > 0)
            {
                txtWorldName.Text = dgvWorlds.SelectedRows[0].Cells["World"].Value.ToString();
            }
        }

        private void BtnJoin_Click(object sender, EventArgs e)
        {
            if (!string.IsNullOrWhiteSpace(txtWorldName.Text))
            {
                SelectedWorld = txtWorldName.Text.Trim().ToUpper();
                this.DialogResult = DialogResult.OK;
                this.Close();
            }
        }
    }
}