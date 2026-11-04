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
            if (
                copperAmount.Value + ironAmount.Value + diamondAmount.Value >= 3 && 
                copperAmount.Value + ironAmount.Value + diamondAmount.Value <= 20
            ) {
                int amount = (int)(copperAmount.Value + ironAmount.Value + diamondAmount.Value);
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
                if (ironAmount.Value == 0 && diamondAmount.Value == 0)
                {
                    quality = "Cheap";
                }
                else if (copperAmount.Value == 0 && diamondAmount.Value == 0)
                {
                    quality = "Fair";
                }
                else if (copperAmount.Value == 0 && ironAmount.Value == 0)
                {
                    quality = "Expensive";
                }
                else
                {
                    int rquality = rand.Next(1, amount);
                    if (rquality >= 1 && rquality <= 5)
                    {
                        quality = "Cheap";
                    }
                    else if (rquality >= 6 && rquality <= 13)
                    {
                        quality = "Fair";
                    }
                    else if (rquality >= 14 && rquality <= 20)
                    {
                        quality = "Expensive";
                    }
                    else
                    {
                        quality = "Unknown";
                    }
                }

                Artifact forgedArtifact = new Artifact(size, quality);
                Store.artifactInventory.Add(forgedArtifact);

                Form1.copper -= (int)copperAmount.Value;
                Form1.iron -= (int)ironAmount.Value;
                Form1.diamond -= (int)diamondAmount.Value;

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
