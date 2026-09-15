namespace T1
{
    public partial class Form1 : Form
    {
        public Form1()
        {
            InitializeComponent();
        }

        int diceValue;

        private void rollBtn_Click(object sender, EventArgs e)
        {
            Random random = new Random();
            diceValue = random.Next(1, 7);
            diceBox.Text = diceValue.ToString();
        }
    }
}
