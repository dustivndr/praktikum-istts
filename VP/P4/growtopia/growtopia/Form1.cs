using System.Data;
using Timer = System.Windows.Forms.Timer;

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

        private PictureBox playerBox;
        private Timer gameTimer;

        private int playerSpeed = 5;
        private int velocityY = 0;
        private int gravity = 1;
        private int jumpStrength = 13;
        private bool isGrounded = false;
        private bool moveLeft, moveRight;

        private int[,] tileHealth = new int[ROWS, COLS];
        private bool[,] isWorldGeneratedDirt = new bool[ROWS, COLS];

        private int selectedSlot = 1;
        private string activeItemName = "Fist";
        private Color caveBgColor = Color.DarkSlateGray;

        private Panel splicingPanel;

        public Form1()
        {
            InitializeComponent();
            InitializeInventory();
            InitializeDynamicWorldGrid();
            InitializePlayer();
            EnterWorld("START");
            SetupQuickSlots();
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

            CenterGrid(gridWidth, gridHeight);

            tableLayoutPanelWorld.SuspendLayout();

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

        private void InitializePlayer()
        {
            this.KeyPreview = true;
            this.KeyDown += Form1_KeyDown;
            this.KeyUp += Form1_KeyUp;

            playerBox = new PictureBox
            {
                Size = new Size(30, 30),
                SizeMode = PictureBoxSizeMode.Zoom,
                BackColor = Color.Transparent,
                Image = Properties.Resources.player 
            };

            this.Controls.Add(playerBox);
            playerBox.BringToFront();

            int tileHeight = 40;
            int spawnX = tableLayoutPanelWorld.Left + 10;
            int spawnY = tableLayoutPanelWorld.Top + (4 * tileHeight) - playerBox.Height;

            playerBox.Location = new Point(spawnX, spawnY);

            gameTimer = new Timer();
            gameTimer.Interval = 16;
            gameTimer.Tick += GameLoop;
            gameTimer.Start();
        }

        private void Form1_KeyDown(object sender, KeyEventArgs e)
        {
            if (e.KeyCode == Keys.A) moveLeft = true;
            if (e.KeyCode == Keys.D) moveRight = true;

            if (e.KeyCode == Keys.W && isGrounded)
            {
                velocityY = -jumpStrength;
                isGrounded = false;
            }
        }

        private void Form1_KeyUp(object sender, KeyEventArgs e)
        {
            if (e.KeyCode == Keys.A) moveLeft = false;
            if (e.KeyCode == Keys.D) moveRight = false;
        }

        private void GameLoop(object sender, EventArgs e)
        {
            int nextX = playerBox.Left;
            int nextY = playerBox.Top;

            if (moveLeft) nextX -= playerSpeed;
            if (moveRight) nextX += playerSpeed;

            Rectangle playerRectX = new Rectangle(nextX, playerBox.Top, playerBox.Width, playerBox.Height);

            for (int r = 0; r < ROWS; r++)
            {
                for (int c = 0; c < COLS; c++)
                {
                    Panel tile = tileGrid[r, c];

                    bool isSolid = (tile.BackColor != Color.LightSkyBlue && tile.BackColor != caveBgColor);

                    if (isSolid)
                    {
                        int tileX = tableLayoutPanelWorld.Left + tile.Left;
                        int tileY = tableLayoutPanelWorld.Top + tile.Top;
                        Rectangle tileRect = new Rectangle(tileX, tileY, tile.Width, tile.Height);

                        if (playerRectX.IntersectsWith(tileRect))
                        {
                            if (moveRight) nextX = tileRect.Left - playerBox.Width; 
                            if (moveLeft) nextX = tileRect.Right; 
                        }
                    }
                }
            }

            playerBox.Left = nextX;

            velocityY += gravity;
            nextY += velocityY;

            isGrounded = false;
            Rectangle playerRectY = new Rectangle(playerBox.Left, nextY, playerBox.Width, playerBox.Height);

            for (int r = 0; r < ROWS; r++)
            {
                for (int c = 0; c < COLS; c++)
                {
                    Panel tile = tileGrid[r, c];

                    bool isSolid = (tile.BackColor != Color.LightSkyBlue && tile.BackColor != caveBgColor);

                    if (isSolid)
                    {
                        int tileX = tableLayoutPanelWorld.Left + tile.Left;
                        int tileY = tableLayoutPanelWorld.Top + tile.Top;
                        Rectangle tileRect = new Rectangle(tileX, tileY, tile.Width, tile.Height);

                        if (playerRectY.IntersectsWith(tileRect))
                        {
                            if (velocityY > 0)
                            {
                                nextY = tileRect.Top - playerBox.Height;
                                velocityY = 0;
                                isGrounded = true;
                            }
                            else if (velocityY < 0)
                            {
                                nextY = tileRect.Bottom;
                                velocityY = 0;
                            }
                        }
                    }
                }
            }

            if (nextX < tableLayoutPanelWorld.Left)
                nextX = tableLayoutPanelWorld.Left;

            if (nextX + playerBox.Width > tableLayoutPanelWorld.Right)
                nextX = tableLayoutPanelWorld.Right - playerBox.Width;

            if (nextY > tableLayoutPanelWorld.Bottom)
            {
                nextY = tableLayoutPanelWorld.Bottom - playerBox.Height;
                isGrounded = true;
            }

            playerBox.Top = nextY;
        }

        private void EnterWorld(string worldName)
        {
            currentWorldName = worldName.ToUpper();

            bool loaded = Save.LoadWorld(currentWorldName, tileGrid, ROWS, COLS, tileHealth, isWorldGeneratedDirt);

            if (!loaded)
            {
                GenerateProceduralTerrain();
            }

            this.Text = $"Growtopia 2D - World: {currentWorldName}";
        }

        private void GenerateProceduralTerrain()
        {
            Color skyColor = Color.LightSkyBlue;
            Color dirtColor = Color.SaddleBrown;
            Color rockColor = Color.DimGray;
            Color lavaColor = Color.Red;

            for (int r = 0; r < ROWS; r++)
            {
                for (int c = 0; c < COLS; c++)
                {
                    Panel tile = tileGrid[r, c];

                    tile.MouseEnter -= Tile_MouseEnter;
                    tile.MouseLeave -= Tile_MouseLeave;

                    tile.MouseEnter += Tile_MouseEnter;
                    tile.MouseLeave += Tile_MouseLeave;

                    tile.Controls.Clear();
                    isWorldGeneratedDirt[r, c] = false; // Reset flags

                    bool isLavaColumn = (c == 5 || c == 6 || c == 11 || c == 12);
                    bool isVeryBottomRow = (r == ROWS - 1);

                    // 1. Lava
                    if (isVeryBottomRow && isLavaColumn)
                    {
                        tile.BackColor = lavaColor;
                        tileHealth[r, c] = 1; // Lava durability

                        Label lavaEmoji = new Label { Text = "♨️", Dock = DockStyle.Fill, TextAlign = ContentAlignment.MiddleCenter, Font = new Font("Segoe UI Emoji", 12), BackColor = Color.Transparent, Tag = new Point(c, r) };
                        lavaEmoji.Click += (s, e) => Tile_Click(tile, e);
                        lavaEmoji.MouseEnter += Tile_MouseEnter;
                        lavaEmoji.MouseLeave += Tile_MouseLeave;
                        tile.Controls.Add(lavaEmoji);
                    }
                    // 2. Sky
                    else if (r < 4)
                    {
                        tile.BackColor = skyColor;
                        tileHealth[r, c] = 0;
                    }
                    // 3. Bedrock
                    else if (r == ROWS - 1)
                    {
                        tile.BackColor = rockColor;
                        tileHealth[r, c] = 3;
                    }
                    // 4. Mix zone (Rock & Dirt)
                    else if (r >= ROWS - 4)
                    {
                        bool isDirt = (rand.Next(2) == 0);
                        tile.BackColor = isDirt ? dirtColor : rockColor;
                        tileHealth[r, c] = isDirt ? 3 : 4;
                        isWorldGeneratedDirt[r, c] = isDirt;
                    }
                    // 5. Dirt
                    else
                    {
                        tile.BackColor = dirtColor;
                        tileHealth[r, c] = 3; // Dirt durability
                        isWorldGeneratedDirt[r, c] = true; // Tag it to reveal Cave BG later
                    }
                }
            }
        }

        private void CreateSplicingPanel()
        {
            splicingPanel = new Panel
            {
                Size = new Size(620, 430),
                Location = new Point((this.ClientSize.Width - 620) / 2, 70),
                BackColor = Color.White,
                BorderStyle = BorderStyle.FixedSingle
            };

            Label lblTitle = new Label
            {
                Text = "📖 Seed Splicing Recipes (Tier 1 → Tier 3)",
                Font = new Font(this.Font.FontFamily, 13, FontStyle.Bold),
                Location = new Point(15, 15),
                AutoSize = true,
                ForeColor = Color.SteelBlue
            };

            Button btnClose = new Button
            {
                Text = "✕ Close",
                Location = new Point(510, 15),
                Size = new Size(90, 30),
                BackColor = Color.IndianRed,
                ForeColor = Color.White,
                FlatStyle = FlatStyle.Flat
            };
            btnClose.FlatAppearance.BorderSize = 0;
            btnClose.Click += (s, e) => splicingPanel.Hide();

            DataGridView dgvRecipes = new DataGridView
            {
                Location = new Point(15, 60),
                Size = new Size(588, 350),
                DataSource = GetSplicingRecipes(),
                AllowUserToAddRows = false,
                ReadOnly = true,
                RowHeadersVisible = false,
                SelectionMode = DataGridViewSelectionMode.FullRowSelect,
                AutoSizeColumnsMode = DataGridViewAutoSizeColumnsMode.Fill,
                BackgroundColor = Color.DarkGray
            };

            splicingPanel.Controls.Add(lblTitle);
            splicingPanel.Controls.Add(btnClose);
            splicingPanel.Controls.Add(dgvRecipes);

            this.Controls.Add(splicingPanel);
        }

        private DataTable GetSplicingRecipes()
        {
            DataTable dt = new DataTable("SplicingRecipes");
            dt.Columns.Add("SeedA", typeof(string));
            dt.Columns.Add("SeedB", typeof(string));
            dt.Columns.Add("ResultSeed", typeof(string));
            dt.Columns.Add("ResultBlock", typeof(string));
            dt.Columns.Add("Tier", typeof(int));

            dt.Rows.Add("Dirt Seed", "Cave Background Seed", "Door Seed", "Door", 2);
            dt.Rows.Add("Dirt Seed", "Rock Seed", "Grass Seed", "Grass", 2);
            dt.Rows.Add("Dirt Seed", "Lava Seed", "Wood Block Seed", "Wood Block", 2);
            dt.Rows.Add("Rock Seed", "Lava Seed", "Glass Pane Seed", "Glass Pane", 2);
            dt.Rows.Add("Cave Background Seed", "Rock Seed", "Sign Seed", "Sign", 2);
            dt.Rows.Add("Cave Background Seed", "Lava Seed", "Lava Rock Seed", "Lava Rock", 2);

            dt.Rows.Add("Dirt Seed", "Glass Pane Seed", "Amber Glass Seed", "Amber Glass", 3);
            dt.Rows.Add("Rock Seed", "Grass Seed", "Bricks Seed", "Bricks", 3);
            dt.Rows.Add("Dirt Seed", "Wood Block Seed", "Cargo Shorts Seed", "Cargo Shorts", 3);
            dt.Rows.Add("Dirt Seed", "Door Seed", "Crappy Sign Seed", "Crappy Sign", 3);
            dt.Rows.Add("Dirt Seed", "Grass Seed", "Daisy Seed", "Daisy", 3);
            dt.Rows.Add("Door Seed", "Cave Background Seed", "Happy Joy Plaque Seed", "Happy Joy Plaque", 3);
            dt.Rows.Add("Cave Background Seed", "Grass Seed", "Mushroom Seed", "Mushroom", 3);
            dt.Rows.Add("Door Seed", "Sign Seed", "Pointy Sign Seed", "Pointy Sign", 3);
            dt.Rows.Add("Rock Seed", "Door Seed", "Rock Background Seed", "Rock Background", 3);
            dt.Rows.Add("Grass Seed", "Lava Seed", "Rose Seed", "Rose", 3);
            dt.Rows.Add("Dirt Seed", "Sign Seed", "Super Crate Box Seed", "Super Crate Box", 3);
            dt.Rows.Add("Sign Seed", "Lava Seed", "Torch Seed", "Torch", 3);
            dt.Rows.Add("Grass Seed", "Door Seed", "Wooden Background Seed", "Wooden Background", 3);
            dt.Rows.Add("Wood Block Seed", "Grass Seed", "Wooden Platform Seed", "Wooden Platform", 3);

            return dt;
        }

        private void Tile_Click(object sender, EventArgs e)
        {
            if (activeItemName != "Fist") return;

            if (sender is Panel tile && tile.Tag is Point coord)
            {
                int c = coord.X;
                int r = coord.Y;

                Color currentBg = tile.BackColor;
                if (currentBg == Color.LightSkyBlue || currentBg == Color.FromArgb(50, 50, 50)) return; // Ignore Sky and Bedrock

                if (!IsTileInReach(c, r)) return;

                tileHealth[r, c]--;

                if (tileHealth[r, c] > 0)
                {
                    UpdateTileDamageLabel(tile, tileHealth[r, c]);
                }
                else
                {
                    tile.Controls.Clear();
                    string destroyedBlockName = GetTileTypeFromColor(currentBg);

                    if (destroyedBlockName != "Sky" && destroyedBlockName != "CaveBG")
                    {
                        ProcessBlockDrops(destroyedBlockName);
                    }

                    if (currentBg == caveBgColor)
                    {
                        tile.BackColor = Color.LightSkyBlue;
                        tileHealth[r, c] = 0;
                    }
                    else if (r >= 4)
                    {
                        tile.BackColor = caveBgColor;
                        tileHealth[r, c] = 3;
                    }
                    else
                    {
                        tile.BackColor = Color.LightSkyBlue;
                        tileHealth[r, c] = 0;
                    }
                }
            }
        }

        private void ProcessBlockDrops(string blockName)
        {
            if (rand.NextDouble() <= 0.05)
            {
                AddItemToInventory(blockName, 1, 1);
            }

            if (rand.NextDouble() <= 0.125)
            {
                AddItemToInventory($"{blockName} Seed", 1, 1);
            }
        }

        private void AddItemToInventory(string itemName, int count, int tier)
        {
            bool itemExists = false;

            foreach (DataRow row in playerInventory.Rows)
            {
                if (row["Item"].ToString() == itemName)
                {
                    row["Count"] = Convert.ToInt32(row["Count"]) + count;
                    itemExists = true;
                    break;
                }
            }

            if (!itemExists)
            {
                playerInventory.Rows.Add(itemName, count, tier, "");
            }

            UpdateQuickSlots();
        }

        private void UpdateTileDamageLabel(Panel tile, int healthLeft)
        {
            Label dmgLbl = null;

            foreach (Control ctrl in tile.Controls)
            {
                if (ctrl is Label l && l.Text.StartsWith("⛏️"))
                {
                    dmgLbl = l;
                    break;
                }
            }

            if (dmgLbl == null)
            {
                dmgLbl = new Label
                {
                    Dock = DockStyle.Fill,
                    TextAlign = ContentAlignment.MiddleCenter,
                    Font = new Font("Segoe UI", 6, FontStyle.Bold),
                    BackColor = Color.Transparent,
                    ForeColor = Color.White
                };
                dmgLbl.Click += (s, e) => Tile_Click(tile, e);
                dmgLbl.MouseEnter += Tile_MouseEnter;
                dmgLbl.MouseLeave += Tile_MouseLeave;
                tile.Controls.Add(dmgLbl);
                dmgLbl.BringToFront();
            }

            dmgLbl.Text = $"⛏️{healthLeft}";
        }

        private bool IsTileInReach(int tCol, int tRow)
        {
            int pCenterX = playerBox.Left + (playerBox.Width / 2) - tableLayoutPanelWorld.Left;
            int pCenterY = playerBox.Top + (playerBox.Height / 2) - tableLayoutPanelWorld.Top;

            int tileWidth = 40; // 38px + 2px margin
            int tileHeight = 40;

            int pCol = pCenterX / tileWidth;
            int pRow = pCenterY / tileHeight;

            int dx = Math.Abs(tCol - pCol);
            int dy = Math.Abs(tRow - pRow);

            if (dx > 2 || dy > 2) return false;

            if (tRow > pRow)
            {
                if (tRow - 1 >= 0)
                {
                    Color blockAbove = tileGrid[tRow - 1, tCol].BackColor;
                    if (blockAbove != Color.LightSkyBlue && blockAbove != caveBgColor)
                    {
                        return false;
                    }
                }
            }

            return true;
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

        private void SetupQuickSlots()
        {
            topQuickSlot1.Click += QuickSlot_Click;
            topQuickSlot2.Click += QuickSlot_Click;
            topQuickSlot3.Click += QuickSlot_Click;

            SelectQuickSlot(1);
        }

        private void QuickSlot_Click(object sender, EventArgs e)
        {
            if (sender == topQuickSlot1) SelectQuickSlot(1);
            else if (sender == topQuickSlot2) SelectQuickSlot(2);
            else if (sender == topQuickSlot3) SelectQuickSlot(3);
        }

        private void SelectQuickSlot(int slotNumber)
        {
            selectedSlot = slotNumber;

            topQuickSlot1.BackColor = (slotNumber == 1) ? Color.Gold : Color.FromArgb(64, 64, 64);
            topQuickSlot2.BackColor = (slotNumber == 2) ? Color.Gold : Color.FromArgb(64, 64, 64);
            topQuickSlot3.BackColor = (slotNumber == 3) ? Color.Gold : Color.FromArgb(64, 64, 64);

            string btnText = "";
            if (slotNumber == 1) btnText = topQuickSlot1.Text;
            if (slotNumber == 2) btnText = topQuickSlot2.Text;
            if (slotNumber == 3) btnText = topQuickSlot3.Text;

            if (btnText.Contains("Fist")) activeItemName = "Fist";
            else if (btnText.Contains("Dirt Seed")) activeItemName = "Dirt Seed";
            else activeItemName = ""; 

            ResetTileInfoLabel();
        }

        private void Tile_MouseEnter(object sender, EventArgs e)
        {
            Control ctrl = sender as Control;
            if (ctrl == null) return;

            Panel tile = (ctrl is Panel) ? (Panel)ctrl : (ctrl.Parent as Panel);

            if (tile == null || !(tile.Tag is Point coord))
                return;

            int c = coord.X;
            int r = coord.Y;

            string reachStatus = IsTileInReach(c, r) ? "In Reach" : "Too Far";
            string blockName = GetTileTypeFromColor(tile.BackColor);

            if (blockName == "Sky")
            {
                tileInfoLabel.Text = $"Tile ({c},{r}) [{reachStatus}]: Sky/Air";
            }
            else
            {
                int hp = tileHealth[r, c];

                string caveBg = (r >= 4) ? " [Cave Background Behind]" : "";

                tileInfoLabel.Text = $"Tile ({c},{r}) [{reachStatus}]: {blockName} (HP: {hp}){caveBg}";
            }
        }

        private void Tile_MouseLeave(object sender, EventArgs e)
        {
            ResetTileInfoLabel();
        }

        private void ResetTileInfoLabel()
        {
            tileInfoLabel.Text = $"Equipped: {activeItemName} | Move: [A][D] | Jump: [W] (2 blocks) | Break Range 2 blocks";
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

        private void splicingBtn_Click(object sender, EventArgs e)
        {
            if (splicingPanel != null && splicingPanel.Visible)
            {
                splicingPanel.Hide();
                return;
            }

            if (splicingPanel == null)
            {
                CreateSplicingPanel();
            }

            splicingPanel.Show();
            splicingPanel.BringToFront();
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
            if (e.RowIndex < 0) return;

            DataGridView grid = sender as DataGridView;
            if (grid == null) return;

            if (grid.Columns[e.ColumnIndex].Name == "Action")
            {
                using (SetSlotForm slotForm = new SetSlotForm())
                {
                    if (slotForm.ShowDialog() == DialogResult.OK)
                    {
                        string targetSlot = slotForm.SelectedSlot.ToString();

                        foreach (DataRow row in playerInventory.Rows)
                        {
                            if (row["Slot"].ToString() == targetSlot)
                            {
                                row["Slot"] = "";
                            }
                        }

                        playerInventory.Rows[e.RowIndex]["Slot"] = targetSlot;

                        UpdateQuickSlots();
                    }
                }
            }
        }

        private string GetTileTypeFromColor(Color color)
        {
            if (color == Color.LightSkyBlue) return "Sky";
            if (color == Color.SaddleBrown) return "Dirt";
            if (color == Color.DimGray) return "Rock";
            if (color == Color.Red) return "Lava";
            if (color == Color.DarkSlateGray) return "CaveBG";
            return "Bedrock";
        }
    }
}
