using System;
using System.Collections.Generic;
using System.ComponentModel;
using System.Data;
using System.Drawing;
using System.Text;
using System.Windows.Forms;

namespace TempaTambang
{
    public partial class Forge : Form
    {
        public Random rand = new Random();
        public Forge()
        {
            InitializeComponent();
        }

        private void button1_Click(object sender, EventArgs e)
        {
            if (copperAmount.Value > Form1.copper)
            {
                MessageBox.Show("Not enough copper!");
                return;
            }
            if (ironAmount.Value > Form1.iron)
            {
                MessageBox.Show("Not enough iron!");
                return;
            }
            if (diamondAmount.Value > Form1.diamond)
            {
                MessageBox.Show("Not enough diamond!");
                return;
            }

            if (
                copperAmount.Value + ironAmount.Value + diamondAmount.Value >= 3 &&
                copperAmount.Value + ironAmount.Value + diamondAmount.Value <= 20
            )
            {
                int c = (int)copperAmount.Value;
                int i = (int)ironAmount.Value;
                int d = (int)diamondAmount.Value;
                int amount = c + i + d;
                string size, quality;

                // size
                if (3 <= amount && amount <= 4)
                {
                    size = "Small";
                }
                else if (5 <= amount && amount <= 9)
                {
                    size = "Medium";
                }
                else if (10 <= amount && amount <= 14)
                {
                    size = "Large";
                }
                else
                {
                    size = "Massive";
                }

                // quality
                int rquality = rand.Next(1, amount + 1);

                if (rquality <= c)
                {
                    quality = "Cheap";
                }
                else if (rquality <= c + i)
                {
                    quality = "Fair";
                }
                else
                {
                    quality = "Expensive";
                }

                Artifact forgedArtifact = new Artifact(size, quality);
                Store.artifactInventory.Add(forgedArtifact);

                Form1.copper -= c;
                Form1.iron -= i;
                Form1.diamond -= d;

                MessageBox.Show("Forge Successful");

                copperAmount.Value = 0;
                ironAmount.Value = 0;
                diamondAmount.Value = 0;
            }
            else
            {
                MessageBox.Show("Please enter minimum total 3 ores, maximum 20 ores");
            }
        }

    }
}
