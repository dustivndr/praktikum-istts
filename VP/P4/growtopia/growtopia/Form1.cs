using System.Data;

namespace growtopia
{
    public partial class Form1 : Form
    {
        private const int ROWS = 12;
        private const int COLS = 17;
        private TableLayoutPanel tableLayoutPanelWorld;
        private Panel[,] tileGrid = new Panel[ROWS, COLS];
        private Random rand = new Random();
        
        private string currentWorldName = "START";

        private DataTable playerInventory;
        private Panel inventoryPanel;

        public Form1()
        {
            InitializeComponent();
            InitializeInventory();
            InitializeDynamicWorldGrid();
            EnterWorld("START");
        }

        private void InitializeDynamicWorldGrid()
        {
            int tileWidth = 38;
            int tileHeight = 38;

            int gridWidth = (COLS * tileWidth) + (COLS * 2) + 1;
            int gridHeight = (ROWS * tileHeight) + (ROWS * 2) + 1;

            tableLayoutPanelWorld = new TableLayoutPanel
            {
                Name = "tableLayoutPanelWorld",
                Size = new Size(gridWidth, gridHeight),
                BackColor = Color.FromArgb(60, 60, 60),
                CellBorderStyle = TableLayoutPanelCellBorderStyle.None,
                Margin = new Padding(0),
                Padding = new Padding(1),
                RowCount = ROWS,
                ColumnCount = COLS,
                Anchor = AnchorStyles.None
            };

            // Recalculate centering with the corrected width
            CenterGrid(gridWidth, gridHeight);

            tableLayoutPanelWorld.SuspendLayout();

            // Explicitly set column and row sizes to absolute pixel dimensions
            // to prevent TableLayoutPanel from clipping right/bottom cells
            for (int c = 0; c < COLS; c++)
            {
                tableLayoutPanelWorld.ColumnStyles.Add(new ColumnStyle(SizeType.Absolute, tileWidth + 2));
            }

            for (int r = 0; r < ROWS; r++)
            {
                tableLayoutPanelWorld.RowStyles.Add(new RowStyle(SizeType.Absolute, tileHeight + 2));
            }

            Color skyColor = Color.LightSkyBlue;
            Color dirtColor = Color.SaddleBrown;
            Color rockColor = Color.DimGray;

            for (int r = 0; r < ROWS; r++)
            {
                for (int c = 0; c < COLS; c++)
                {
                    Panel tile = new Panel
                    {
                        Size = new Size(tileWidth, tileHeight),
                        Margin = new Padding(1),
                        Tag = new Point(c, r)
                    };

                    if (r < 4)
                    {
                        tile.BackColor = skyColor;
                    }
                    else if (r == ROWS - 1)
                    {
                        tile.BackColor = rockColor;
                    }
                    else if (r >= ROWS - 4)
                    {
                        tile.BackColor = (rand.Next(2) == 0) ? dirtColor : rockColor;
                    }
                    else
                    {
                        tile.BackColor = dirtColor;
                    }

                    tile.Click += Tile_Click;

                    tableLayoutPanelWorld.Controls.Add(tile, c, r);
                    tileGrid[r, c] = tile;
                }
            }

            tableLayoutPanelWorld.ResumeLayout();

            this.Controls.Add(tableLayoutPanelWorld);
        }

        private void CenterGrid(int gridWidth, int gridHeight)
        {
            int x = (this.ClientSize.Width - gridWidth) / 2;
            int y = (this.ClientSize.Height - gridHeight) / 2 + 20;
            tableLayoutPanelWorld.Location = new Point(x, y);
        }

        private void EnterWorld(string worldName)
        {
            currentWorldName = worldName.ToUpper();

            bool loaded = Save.LoadWorld(currentWorldName, tileGrid, ROWS, COLS);

            if (!loaded)
            {
                GenerateProceduralTerrain();
            }

            labelWorldName.Text = $"🌏 World: {currentWorldName}";

        }

        private void GenerateProceduralTerrain()
        {
            Color skyColor = Color.LightSkyBlue;
            Color dirtColor = Color.SaddleBrown;
            Color rockColor = Color.DimGray;

            for (int r = 0; r < ROWS; r++)
            {
                for (int c = 0; c < COLS; c++)
                {
                    if (r < 4)
                        tileGrid[r, c].BackColor = skyColor;
                    else if (r == ROWS - 1)
                        tileGrid[r, c].BackColor = rockColor;
                    else if (r >= ROWS - 4)
                        tileGrid[r, c].BackColor = (rand.Next(2) == 0) ? dirtColor : rockColor;
                    else
                        tileGrid[r, c].BackColor = dirtColor;
                }
            }
        }

        private void Tile_Click(object sender, EventArgs e)
        {
            if (sender is Panel tile && tile.Tag is Point coord)
            {
                // Simple interaction test
                this.Text = $"Clicked Tile: ({coord.X}, {coord.Y})";
            }
        }

        private void leaveWorldBtn_Click(object sender, EventArgs e)
        {
            Save.SaveWorld(currentWorldName, tileGrid, ROWS, COLS);

            using (LwForm joinDialog = new LwForm(currentWorldName))
            {
                if (joinDialog.ShowDialog() == DialogResult.OK)
                {
                    string targetWorld = joinDialog.SelectedWorld;

                    if (targetWorld != currentWorldName)
                    {
                        EnterWorld(targetWorld);
                    }
                }
            }
        }

        private void InitializeInventory()
        {
            playerInventory = new DataTable("PlayerInventory");
            playerInventory.Columns.Add("Item", typeof(string));
            playerInventory.Columns.Add("Count", typeof(int));
            playerInventory.Columns.Add("Tier", typeof(int));
            playerInventory.Columns.Add("Slot", typeof(string));

            playerInventory.Rows.Add("Fist", 1, 0, "1");
            playerInventory.Rows.Add("Dirt", 30, 1, "2");
            playerInventory.Rows.Add("Dirt Seed", 8, 1, "3");
            playerInventory.Rows.Add("Rock Seed", 4, 1, "");
            playerInventory.Rows.Add("Lava Seed", 3, 1, "");

            UpdateQuickSlots();
        }

        private void UpdateQuickSlots()
        {
            topQuickSlot1.Text = "[1]";
            topQuickSlot2.Text = "[2]";
            topQuickSlot3.Text = "[3]";

            foreach (DataRow row in playerInventory.Rows)
            {
                string slot = row["Slot"].ToString();
                if (string.IsNullOrEmpty(slot)) continue;

                string itemName = row["Item"].ToString();
                int count = Convert.ToInt32(row["Count"]);

                string displayText = itemName == "Fist" ? $"[{slot}] {itemName}" : $"[{slot}] {itemName} ({count})";

                if (slot == "1") topQuickSlot1.Text = displayText;
                else if (slot == "2") topQuickSlot2.Text = displayText;
                else if (slot == "3") topQuickSlot3.Text = displayText;
            }
        }

        private void inventoryBtn_Click(object sender, EventArgs e)
        {
            if (inventoryPanel != null && inventoryPanel.Visible)
            {
                inventoryPanel.Hide();
                return;
            }

            if (inventoryPanel == null)
            {
                CreateInventoryPanel();
            }

            inventoryPanel.Show();
            inventoryPanel.BringToFront();
        }

        private void CreateInventoryPanel()
        {
            inventoryPanel = new Panel
            {
                Size = new Size(600, 400),
                Location = new Point((this.ClientSize.Width - 600) / 2, 80),
                BackColor = Color.White,
                BorderStyle = BorderStyle.FixedSingle
            };

            Label lblTitle = new Label { Text = "🎒 Backpack", Font = new Font(this.Font.FontFamily, 14, FontStyle.Bold), Location = new Point(15, 15), AutoSize = true, ForeColor = Color.SteelBlue };
            Label lblDesc = new Label { Text = "Select which items to assign to Top Quickslots [1], [2], or [3] for quick access.", Location = new Point(18, 45), AutoSize = true, ForeColor = Color.Gray };

            Button btnClose = new Button { Text = "✕ Close", Location = new Point(490, 15), Size = new Size(90, 30), BackColor = Color.IndianRed, ForeColor = Color.White, FlatStyle = FlatStyle.Flat };
            btnClose.FlatAppearance.BorderSize = 0;
            btnClose.Click += (s, e) => inventoryPanel.Hide();

            DataGridView dgvInventory = new DataGridView
            {
                Location = new Point(20, 80),
                Size = new Size(560, 300),
                DataSource = playerInventory,
                AllowUserToAddRows = false,
                RowHeadersVisible = false,
                SelectionMode = DataGridViewSelectionMode.FullRowSelect,
                AutoSizeColumnsMode = DataGridViewAutoSizeColumnsMode.Fill,
                ReadOnly = true,
                BackgroundColor = Color.DarkGray
            };

            DataGridViewButtonColumn btnCol = new DataGridViewButtonColumn
            {
                Name = "Action",
                HeaderText = "Action",
                Text = "Set Slot",
                UseColumnTextForButtonValue = true
            };
            dgvInventory.Columns.Add(btnCol);

            dgvInventory.DataBindingComplete += (s, ev) =>
            {
                if (dgvInventory.Columns.Contains("Action"))
                {
                    dgvInventory.Columns["Action"].DisplayIndex = dgvInventory.Columns.Count - 1;
                }
            };

            dgvInventory.CellClick += DgvInventory_CellClick;

            inventoryPanel.Controls.Add(lblTitle);
            inventoryPanel.Controls.Add(lblDesc);
            inventoryPanel.Controls.Add(btnClose);
            inventoryPanel.Controls.Add(dgvInventory);

            this.Controls.Add(inventoryPanel);
        }

        private void DgvInventory_CellClick(object sender, DataGridViewCellEventArgs e)
        {
            // 1. Ignore clicks on the header row (RowIndex -1)
            if (e.RowIndex < 0) return;

            // 2. Cast the sender back to a DataGridView
            DataGridView grid = sender as DataGridView;
            if (grid == null) return;

            // 3. Check if the clicked column is exactly our "Action" button column by its Name
            if (grid.Columns[e.ColumnIndex].Name == "Action")
            {
                using (SetSlotForm slotForm = new SetSlotForm())
                {
                    if (slotForm.ShowDialog() == DialogResult.OK)
                    {
                        string targetSlot = slotForm.SelectedSlot.ToString();

                        // Remove this slot number from any other item first
                        foreach (DataRow row in playerInventory.Rows)
                        {
                            if (row["Slot"].ToString() == targetSlot)
                            {
                                row["Slot"] = "";
                            }
                        }

                        // Assign the new slot to the clicked item
                        playerInventory.Rows[e.RowIndex]["Slot"] = targetSlot;

                        UpdateQuickSlots();
                    }
                }
            }
        }
    }
}
