namespace WarungKue
{
    public partial class Form1 : Form
    {
        public Form1()
        {
            InitializeComponent();
            //menuStrip1.Visible = false;
        }

        private void newGame_Click(object sender, EventArgs e)
        {
            menuStrip1.Visible = true;

        }

        private void continueGame_Click(object sender, EventArgs e)
        {
            menuStrip1.Visible = true;

        }

        private void exitGame_Click(object sender, EventArgs e)
        {
            this.Close();
        }

        private void tunjukResepToolStripMenuItem_Click(object sender, EventArgs e)
        {
            MessageBox.Show("" +
                "Roti Coklat = Roti + Coklat\n" +
                "Roti Keju = Roti + Keju\n" +
                "Roti Coklat Keju = Roti + Coklat + Keju\n" +
                "Kue Coklat = Kue + Coklat\n" +
                "Kue Keju = Kue + Keju\n" +
                "Kue Coklat Keju = Kue + Coklat + Keju",
                "Resep",
                MessageBoxButtons.OK,
                MessageBoxIcon.Information
            );
        }
    }
}
