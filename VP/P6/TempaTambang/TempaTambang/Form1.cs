namespace TempaTambang
{
    public partial class Form1 : Form
    {
        bool goUp, goDown, goLeft, goRight;
        int speed = 8;
        public static int copper = 0, iron = 0, diamond = 0, money = 0;
        private List<Panel> activeOres = new List<Panel>();
        private Random rand = new Random();

        public Form1()
        {
            InitializeComponent();
            updateRMlabels();

            labelForge.Hide();
            labelStorage.Hide();

            this.KeyPreview = true;
            thePlayer.BringToFront();

            this.KeyDown += Form1_KeyDown;
            this.KeyUp += Form1_KeyUp;

            GameTimer.Interval = 30;
            GameTimer.Tick += GameTimer_Tick;
            GameTimer.Start();

            spawnTimer.Interval = 5000;
            spawnTimer.Tick += spawnTimer_Tick;
            spawnTimer.Start();
        }

        private void Form1_KeyDown(object sender, KeyEventArgs e)
        {
            if (e.KeyCode == Keys.W) goUp = true;
            if (e.KeyCode == Keys.S) goDown = true;
            if (e.KeyCode == Keys.A) goLeft = true;
            if (e.KeyCode == Keys.D) goRight = true;
        }

        private void Form1_KeyUp(object sender, KeyEventArgs e)
        {
            if (e.KeyCode == Keys.W) goUp = false;
            if (e.KeyCode == Keys.S) goDown = false;
            if (e.KeyCode == Keys.A) goLeft = false;
            if (e.KeyCode == Keys.D) goRight = false;

            if (e.KeyCode == Keys.E)
            {
                if (thePlayer.Bounds.IntersectsWith(areaForge.Bounds))
                {
                    goUp = goDown = goLeft = goRight = false;

                    Forge forgeMenu = new Forge();
                    forgeMenu.ShowDialog();
                    updateRMlabels();
                }
                else if (thePlayer.Bounds.IntersectsWith(areaStore.Bounds))
                {
                    goUp = goDown = goLeft = goRight = false;

                    Store storageMenu = new Store();
                    storageMenu.ShowDialog();
                    updateRMlabels();
                }
            }

            if (e.KeyCode == Keys.Space)
            {
                for (int i = activeOres.Count - 1; i >= 0; i--)
                {
                    Panel ore = activeOres[i];

                    if (thePlayer.Bounds.IntersectsWith(ore.Bounds))
                    {
                        string oreType = ore.Tag.ToString();

                        int dropAmount = rand.Next(2, 6);

                        if (oreType == "copper") copper += dropAmount;
                        else if (oreType == "iron") iron += dropAmount;
                        else if (oreType == "diamond") diamond += dropAmount;

                        this.Controls.Remove(ore);
                        ore.Dispose();

                        activeOres.RemoveAt(i);

                        updateRMlabels();

                        break;
                    }
                }
            }
        }

        private void GameTimer_Tick(object sender, EventArgs e)
        {
            // Up and Down
            if (goUp && thePlayer.Top > 0)
            {
                thePlayer.Top -= speed;
            }
            if (goDown && thePlayer.Bottom < this.ClientSize.Height)
            {
                thePlayer.Top += speed;
            }

            // Left Right
            if (goLeft && thePlayer.Left > 0)
            {
                thePlayer.Left -= speed;
            }
            if (goRight && thePlayer.Right < this.ClientSize.Width)
            {
                thePlayer.Left += speed;
            }

            if (thePlayer.Bounds.IntersectsWith(areaForge.Bounds))
            {
                labelForge.Show();
            }
            else if (thePlayer.Bounds.IntersectsWith(areaStore.Bounds))
            {
                labelStorage.Show();
            }
            else
            {
                labelForge.Hide();
                labelStorage.Hide();
            }
        }

        public void updateRMlabels()
        {
            labelCID.Text = "Copper: " + copper + " | Iron: " + iron + " | Diamond: " + diamond;
            labelMoney.Text = "Money: $" + money;
        }

        private void Form1_Load(object sender, EventArgs e)
        {
            //money = 100000;
            //copper = 10;
            //iron = 10;
            //diamond = 10;

            updateRMlabels();
        }

        private void spawnTimer_Tick(object sender, EventArgs e)
        {
            int oresToSpawn = 5 - activeOres.Count;

            for (int i = 0; i < oresToSpawn; i++)
            {
                Panel newOre = new Panel();
                newOre.Size = new Size(20, 20);

                int spawnX = rand.Next(0, this.ClientSize.Width - newOre.Width);
                int spawnY = rand.Next(36, 250 - newOre.Height);
                newOre.Location = new Point(spawnX, spawnY);

                int oreType = rand.Next(0, 3);

                if (oreType == 0)
                {
                    newOre.BackColor = Color.Brown;
                    newOre.Tag = "copper";
                }
                else if (oreType == 1)
                {
                    newOre.BackColor = Color.White;
                    newOre.Tag = "iron";
                }
                else if (oreType == 2)
                {
                    newOre.BackColor = Color.LightBlue;
                    newOre.Tag = "diamond";
                }

                this.Controls.Add(newOre);
                activeOres.Add(newOre);

                thePlayer.BringToFront();
            }
        }
    }
}
