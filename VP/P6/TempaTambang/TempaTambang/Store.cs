using System;
using System.Collections.Generic;
using System.ComponentModel;
using System.Data;
using System.Drawing;
using System.Text;
using System.Windows.Forms;

namespace TempaTambang
{
    public partial class Store : Form
    {
        public static List<Artifact> artifactInventory = new List<Artifact>();
        public Store()
        {
            InitializeComponent();
            foreach (Artifact item in artifactInventory)
            {
                artifactListBox.Items.Add(item);
            }
        }

        private void Store_Load(object sender, EventArgs e)
        {
            if (Form1.money < 100000)
            {
                btnBuyWin.Enabled = false;
            }
            else
            {
                btnBuyWin.Enabled = true;
            }
            updateRMlabels();
        }

        private void sellButton_Click(object sender, EventArgs e)
        {
            if (artifactListBox.SelectedItem != null)
            {
                Artifact selectedArtifact = (Artifact)artifactListBox.SelectedItem;

                artifactInventory.Remove(selectedArtifact);

                artifactListBox.Items.Remove(selectedArtifact);

                MessageBox.Show($"Artifact sold for {selectedArtifact.Price}!");
            }
            else
            {
                MessageBox.Show("Please select an artifact to sell.");
            }
        }

        private void btnBuyWin_Click(object sender, EventArgs e)
        {
            if (Form1.money >= 100000)
            {
                MessageBox.Show("Congratulation, You Win!");
                Application.Exit();
            }
            else
            {
                MessageBox.Show("You don't have enough money to buy this!");
            }
        }

        private void updateRMlabels()
        {
            labelMoney.Text = "Current Money: $" + Form1.money;
            labelCopper.Text = $"Copper: {Form1.copper} x $100";
            labelIron.Text = $"Iron: {Form1.iron} x $500";
            labelDiamond.Text = $"Diamond: {Form1.diamond} x $1000";
        }

        // Note: aku anggep sell ore nya jual 1 ore 1 ore
        // - - -

        private void sellCopper_Click(object sender, EventArgs e)
        {
            if (Form1.copper <= 0)
            {
                MessageBox.Show("You don't have any copper to sell!");
                return;
            }
            Form1.money += 100;
            Form1.copper -= 1;
            updateRMlabels();
        }

        private void sellIron_Click(object sender, EventArgs e)
        {
            if (Form1.iron <= 0)
            {
                MessageBox.Show("You don't have any iron to sell!");
                return;
            }
            Form1.money += 200;
            Form1.iron -= 1;
            updateRMlabels();
        }

        private void sellDiamond_Click(object sender, EventArgs e)
        {
            if (Form1.diamond <= 0)
            {
                MessageBox.Show("You don't have any diamond to sell!");
                return;
            }
            Form1.money += 500;
            Form1.diamond -= 1;
            updateRMlabels();

        }

        private void sellArtifact_Click(object sender, EventArgs e)
        {
            if (artifactListBox.SelectedItem != null)
            {
                Artifact selectedArtifact = (Artifact)artifactListBox.SelectedItem;

                Form1.money += selectedArtifact.Price;

                artifactInventory.Remove(selectedArtifact);

                artifactListBox.Items.Remove(selectedArtifact);

                MessageBox.Show($"You sold the artifact for {selectedArtifact.Price}!\nTotal Money: {Form1.money}");
            }
            else
            {
                MessageBox.Show("Please select an artifact from the list to sell.");
            }

            updateRMlabels();
        }
    }
}
