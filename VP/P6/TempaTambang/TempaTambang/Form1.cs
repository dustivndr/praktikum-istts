namespace TempaTambang
{
    public partial class Form1 : Form
    {
        bool goUp, goDown, goLeft, goRight;
        int speed = 8;

        public Form1()
        {
            InitializeComponent();

            labelForge.Hide();
            labelStorage.Hide();

            this.KeyPreview = true;
            thePlayer.BringToFront();

            this.KeyDown += Form1_KeyDown;
            this.KeyUp += Form1_KeyUp;

            GameTimer.Interval = 30;
            GameTimer.Tick += GameTimer_Tick;
            GameTimer.Start();
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
                }
                else if (thePlayer.Bounds.IntersectsWith(areaStore.Bounds))
                {
                    goUp = goDown = goLeft = goRight = false;

                    Store storageMenu = new Store();
                    storageMenu.ShowDialog();
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

            // Left and Right
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

    }
}
