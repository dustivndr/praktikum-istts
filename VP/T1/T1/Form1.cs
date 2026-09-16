namespace T1
{
    public partial class Form1 : Form
    {
        int diceValue;
        TextBox[] board;
        int playerPosition = 0;

        public Form1()
        {
            InitializeComponent();
            
            board = new TextBox[]
            {
                textBox1,
                textBox2,
                textBox3,
                textBox4,
                textBox5,
                textBox6,
                textBox7,
                textBox8,
                textBox9,
                textBox10,
                textBox11,
                textBox12,
                textBox13,
                textBox14,
                textBox15,
                textBox16,
                textBox17,
                textBox18,
                textBox19,
                textBox20,
                textBox21,
                textBox22,
                textBox23,
                textBox24
            };

            board[playerPosition].Text = "P";
        }
        private void rollBtn_Click(object sender, EventArgs e)
        {
            Random random = new Random();
            diceValue = random.Next(1, 7);
            diceBox.Text = diceValue.ToString();
            MovePlayer();
        }

        private void MovePlayer()
        {
            board[playerPosition].Text = "";

            playerPosition += diceValue;

            if (playerPosition >= board.Length - 1)
            {
                playerPosition = board.Length - 1;
                board[playerPosition].Text = "P";
                MessageBox.Show("FINISH!");

                board[playerPosition].Text = "";
                playerPosition = 0;
                board[playerPosition].Text = "P";
                return;
            }

            if (playerPosition == 6)
            {
                playerPosition = 5;
                board[playerPosition].Text = "P";
                MessageBox.Show("Pemain terkena ular \n(Turun ke petak di bawah)");
            }

            if (playerPosition == 14)
            {
                playerPosition = 9;
                board[playerPosition].Text = "P";
                MessageBox.Show("Pemain terkena ular \n(Turun ke petak di bawah)");
            }

            if (playerPosition == 20)
            {
                playerPosition = 15;
                board[playerPosition].Text = "P";
                MessageBox.Show("Pemain terkena ular \n(Turun ke petak di bawah)");
            }

            board[playerPosition].Text = "P";
        }

    }
}
