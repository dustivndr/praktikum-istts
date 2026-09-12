using System;
using System.Collections.Generic;
using System.ComponentModel;
using System.Data;
using System.Drawing;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.Windows.Forms;
using static System.Windows.Forms.VisualStyles.VisualStyleElement;

namespace WindowsFormsApp1
{
    public partial class Form1 : Form
    {
        // prosedur dan function
        public bool checkinput() 
        {
            if (textBox1.Text.Length <= 0)
            {
                return true; // return true kalau textBox1 kosong
            }
            disablenumber();
            return false; 
        }

        public void disablenumber() // Enable itu untuk mengaktifkan atau mengnonaktifkan objek (jika true maka textbox bisa di interaksi, jika false maka tidak bisa)
        {
            button0.Enabled = false;
            button1.Enabled = false;
            button2.Enabled = false;
            button3.Enabled = false;
            button4.Enabled = false;
            button5.Enabled = false;
            button6.Enabled = false;
            button7.Enabled = false;
            button8.Enabled = false;
            button9.Enabled = false;
        }

        public void enablenumber()
        {
            button0.Enabled = true;
            button1.Enabled = true;
            button2.Enabled = true;
            button3.Enabled = true;
            button4.Enabled = true;
            button5.Enabled = true;
            button6.Enabled = true;
            button7.Enabled = true;
            button8.Enabled = true;
            button9.Enabled = true;
        }

        public void disableoperator()
        {
            buttondivide.Enabled = false;
            buttonminus.Enabled = false;
            buttonmultiply.Enabled = false;
            buttonplus.Enabled = false;
        }

        public void enableoperator()
        {
            buttondivide.Enabled = true;
            buttonminus.Enabled = true;
            buttonmultiply.Enabled = true;
            buttonplus.Enabled = true;
        }

        public void insert(bool type,String input)
        {
            if (type)
            {
                if (checkinput())
                {
                    textBox1.Text = input; // mengganti value dari sebuah text dengan variable
                }
                else
                {
                    textBox2.Text = input;
                }
            }
            else
            {
                textBoxOp.Text = input;
            }
        }

        public Form1()
        {
            InitializeComponent();
            textBox1.ReadOnly = true; // readonly untuk supaya tidak bisa di edit
            textBox2.ReadOnly = true;
            textBoxOp.ReadOnly = true;
        }
        private void button1_Click(object sender, EventArgs e)
        {
            insert(true, "1");
        }

        private void button2_Click(object sender, EventArgs e)
        {
            insert(true, "2");
        }

        private void button3_Click(object sender, EventArgs e)
        {
            insert(true, "3");
        }

        private void button4_Click(object sender, EventArgs e)
        {
            insert(true, "4");
        }

        private void button5_Click(object sender, EventArgs e)
        {
            insert(true, "5");
        }

        private void button6_Click(object sender, EventArgs e)
        {
            insert(true, "6");
        }

        private void button7_Click(object sender, EventArgs e)
        {
            insert(true, "7");
        }

        private void button8_Click(object sender, EventArgs e)
        {
            insert(true, "8");
        }

        private void button9_Click(object sender, EventArgs e)
        {
            insert(true, "9");
        }

        private void button0_Click(object sender, EventArgs e)
        {
            insert(true, "0");
        }

        private void buttonplus_Click(object sender, EventArgs e)
        {
            insert(false, "+");
            disableoperator();
        }

        private void buttonmultiply_Click(object sender, EventArgs e)
        {
            insert(false, "x");
            disableoperator();
        }

        private void buttonminus_Click(object sender, EventArgs e)
        {
            insert(false, "-");
            disableoperator();
        }

        private void buttondivide_Click(object sender, EventArgs e)
        {
            insert(false, "/");
            disableoperator();
        }

        private void buttonAC_Click(object sender, EventArgs e)
        {
            enablenumber();
            enableoperator();
            textBox1.Text = "";
            textBox2.Text = "";
            textBoxOp.Text = "";
        }

        private void buttonequal_Click(object sender, EventArgs e)
        {
            if (!textBox1.Text.Equals("") || !textBox2.Text.Equals("") || !textBoxOp.Text.Equals(""))
            {
                int angka1 = int.Parse(textBox1.Text); // cara mengganti string ke int
                int angka2 = int.Parse(textBox2.Text);

                String operators = textBoxOp.Text;
                float hasil = 0;

                switch (operators)
                {
                    case "+":
                        hasil = angka1 + angka2;
                        MessageBox.Show(hasil.ToString()); // untuk membuat message box tekan mbox lalu TAB 2x
                        break;

                    case "-":
                        hasil = angka1 - angka2;
                        MessageBox.Show(hasil.ToString());
                        break;

                    case "x":
                        hasil = angka1 * angka2;
                        MessageBox.Show(hasil.ToString());
                        break;

                    case "/":
                        if (angka2 == 0) // begitulah
                        {
                            MessageBox.Show("Katanya Jason error");
                            break;
                        }
                        hasil = angka1 / angka2;
                        MessageBox.Show(hasil.ToString());
                        break;

                    default:
                        break;
                }
                enableoperator(); // enable semua operator kembali ketika operasi matematika selesai
            }
        }
    }
}




