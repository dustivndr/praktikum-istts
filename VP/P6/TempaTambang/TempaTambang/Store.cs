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

        //public void AddArtifactToList(Artifact newArtifact)
        //{
        //    artifactInventory.Add(newArtifact);
        //    artifactListBox.Items.Add(newArtifact);
        //}

        private void sellButton_Click(object sender, EventArgs e)
        {
            // Ensure an item is actually selected before trying to sell it
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

    }
}
