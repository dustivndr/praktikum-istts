namespace TempaTambang
{
    partial class Store
    {
        /// <summary>
        /// Required designer variable.
        /// </summary>
        private System.ComponentModel.IContainer components = null;

        /// <summary>
        /// Clean up any resources being used.
        /// </summary>
        /// <param name="disposing">true if managed resources should be disposed; otherwise, false.</param>
        protected override void Dispose(bool disposing)
        {
            if (disposing && (components != null))
            {
                components.Dispose();
            }
            base.Dispose(disposing);
        }

        #region Windows Form Designer generated code

        /// <summary>
        /// Required method for Designer support - do not modify
        /// the contents of this method with the code editor.
        /// </summary>
        private void InitializeComponent()
        {
            label1 = new Label();
            labelMoney = new Label();
            label3 = new Label();
            label4 = new Label();
            labelCopper = new Label();
            labelIron = new Label();
            labelDiamond = new Label();
            sellCopper = new Button();
            sellIron = new Button();
            sellDiamond = new Button();
            artifactListBox = new ListBox();
            sellArtifact = new Button();
            btnBuyWin = new Button();
            SuspendLayout();
            // 
            // label1
            // 
            label1.AutoSize = true;
            label1.Dock = DockStyle.Top;
            label1.Font = new Font("Segoe UI", 16F, FontStyle.Bold);
            label1.Location = new Point(0, 0);
            label1.Margin = new Padding(5);
            label1.Name = "label1";
            label1.Padding = new Padding(8, 5, 5, 5);
            label1.Size = new Size(98, 47);
            label1.TabIndex = 0;
            label1.Text = "Store";
            // 
            // labelMoney
            // 
            labelMoney.AutoSize = true;
            labelMoney.Dock = DockStyle.Top;
            labelMoney.Font = new Font("Segoe UI", 11F, FontStyle.Bold);
            labelMoney.Location = new Point(0, 47);
            labelMoney.Margin = new Padding(5);
            labelMoney.Name = "labelMoney";
            labelMoney.Padding = new Padding(10, 1, 5, 5);
            labelMoney.Size = new Size(195, 31);
            labelMoney.TabIndex = 1;
            labelMoney.Text = "Current Money: $0";
            // 
            // label3
            // 
            label3.AutoSize = true;
            label3.Font = new Font("Segoe UI", 11F, FontStyle.Bold);
            label3.Location = new Point(14, 88);
            label3.Margin = new Padding(5);
            label3.Name = "label3";
            label3.Size = new Size(49, 25);
            label3.TabIndex = 2;
            label3.Text = "Ore:";
            // 
            // label4
            // 
            label4.AutoSize = true;
            label4.Font = new Font("Segoe UI", 11F, FontStyle.Bold);
            label4.Location = new Point(318, 88);
            label4.Margin = new Padding(5);
            label4.Name = "label4";
            label4.Size = new Size(92, 25);
            label4.TabIndex = 2;
            label4.Text = "Artifacts:";
            // 
            // labelCopper
            // 
            labelCopper.AutoSize = true;
            labelCopper.Font = new Font("Segoe UI", 10F);
            labelCopper.Location = new Point(14, 144);
            labelCopper.Name = "labelCopper";
            labelCopper.Size = new Size(138, 23);
            labelCopper.TabIndex = 3;
            labelCopper.Text = "Copper: 0 x $100";
            // 
            // labelIron
            // 
            labelIron.AutoSize = true;
            labelIron.Font = new Font("Segoe UI", 10F);
            labelIron.Location = new Point(14, 191);
            labelIron.Name = "labelIron";
            labelIron.Size = new Size(113, 23);
            labelIron.TabIndex = 3;
            labelIron.Text = "Iron: 0 x $200";
            // 
            // labelDiamond
            // 
            labelDiamond.AutoSize = true;
            labelDiamond.Font = new Font("Segoe UI", 10F);
            labelDiamond.Location = new Point(14, 239);
            labelDiamond.Name = "labelDiamond";
            labelDiamond.Size = new Size(152, 23);
            labelDiamond.TabIndex = 3;
            labelDiamond.Text = "Diamond: 0 x $500";
            // 
            // sellCopper
            // 
            sellCopper.Location = new Point(231, 142);
            sellCopper.Name = "sellCopper";
            sellCopper.Size = new Size(61, 29);
            sellCopper.TabIndex = 4;
            sellCopper.Text = "Sell";
            sellCopper.UseVisualStyleBackColor = true;
            sellCopper.Click += sellCopper_Click;
            // 
            // sellIron
            // 
            sellIron.Location = new Point(231, 189);
            sellIron.Name = "sellIron";
            sellIron.Size = new Size(61, 29);
            sellIron.TabIndex = 4;
            sellIron.Text = "Sell";
            sellIron.UseVisualStyleBackColor = true;
            sellIron.Click += sellIron_Click;
            // 
            // sellDiamond
            // 
            sellDiamond.Location = new Point(231, 237);
            sellDiamond.Name = "sellDiamond";
            sellDiamond.Size = new Size(61, 29);
            sellDiamond.TabIndex = 4;
            sellDiamond.Text = "Sell";
            sellDiamond.UseVisualStyleBackColor = true;
            sellDiamond.Click += sellDiamond_Click;
            // 
            // artifactListBox
            // 
            artifactListBox.FormattingEnabled = true;
            artifactListBox.Location = new Point(318, 142);
            artifactListBox.Name = "artifactListBox";
            artifactListBox.Size = new Size(323, 124);
            artifactListBox.TabIndex = 5;
            // 
            // sellArtifact
            // 
            sellArtifact.Location = new Point(318, 288);
            sellArtifact.Name = "sellArtifact";
            sellArtifact.Size = new Size(92, 29);
            sellArtifact.TabIndex = 4;
            sellArtifact.Text = "Sell";
            sellArtifact.UseVisualStyleBackColor = true;
            sellArtifact.Click += sellArtifact_Click;
            // 
            // btnBuyWin
            // 
            btnBuyWin.Font = new Font("Segoe UI", 11F, FontStyle.Bold);
            btnBuyWin.Location = new Point(14, 321);
            btnBuyWin.Name = "btnBuyWin";
            btnBuyWin.Size = new Size(278, 51);
            btnBuyWin.TabIndex = 4;
            btnBuyWin.Text = "Buy Win ($100000)";
            btnBuyWin.UseVisualStyleBackColor = true;
            btnBuyWin.Click += btnBuyWin_Click;
            // 
            // Store
            // 
            AutoScaleDimensions = new SizeF(8F, 20F);
            AutoScaleMode = AutoScaleMode.Font;
            ClientSize = new Size(682, 403);
            Controls.Add(artifactListBox);
            Controls.Add(sellDiamond);
            Controls.Add(sellIron);
            Controls.Add(btnBuyWin);
            Controls.Add(sellArtifact);
            Controls.Add(sellCopper);
            Controls.Add(labelDiamond);
            Controls.Add(labelIron);
            Controls.Add(labelCopper);
            Controls.Add(label4);
            Controls.Add(label3);
            Controls.Add(labelMoney);
            Controls.Add(label1);
            FormBorderStyle = FormBorderStyle.FixedSingle;
            MaximizeBox = false;
            Name = "Store";
            StartPosition = FormStartPosition.CenterScreen;
            Text = "Store";
            Load += Store_Load;
            ResumeLayout(false);
            PerformLayout();
        }

        #endregion

        private Label label1;
        private Label labelMoney;
        private Label label3;
        private Label label4;
        private Label labelCopper;
        private Label labelIron;
        private Label labelDiamond;
        private Button sellCopper;
        private Button sellIron;
        private Button sellDiamond;
        private ListBox artifactListBox;
        private Button sellArtifact;
        private Button btnBuyWin;
    }
}