namespace growtopia
{
    partial class Form1
    {
        /// <summary>
        ///  Required designer variable.
        /// </summary>
        private System.ComponentModel.IContainer components = null;

        /// <summary>
        ///  Clean up any resources being used.
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
        ///  Required method for Designer support - do not modify
        ///  the contents of this method with the code editor.
        /// </summary>
        private void InitializeComponent()
        {
            panel1 = new Panel();
            topQuickSlot1 = new Button();
            topQuickSlot3 = new Button();
            topQuickSlot2 = new Button();
            inventoryBtn = new Button();
            splicingBtn = new Button();
            leaveWorldBtn = new Button();
            labelWorldName = new Label();
            panel2 = new Panel();
            tileInfoLabel = new Label();
            panel1.SuspendLayout();
            panel2.SuspendLayout();
            SuspendLayout();
            // 
            // panel1
            // 
            panel1.BackColor = Color.FromArgb(20, 20, 20);
            panel1.Controls.Add(topQuickSlot1);
            panel1.Controls.Add(topQuickSlot3);
            panel1.Controls.Add(topQuickSlot2);
            panel1.Controls.Add(inventoryBtn);
            panel1.Controls.Add(splicingBtn);
            panel1.Controls.Add(leaveWorldBtn);
            panel1.Controls.Add(labelWorldName);
            panel1.Location = new Point(0, 0);
            panel1.Name = "panel1";
            panel1.Size = new Size(882, 70);
            panel1.TabIndex = 0;
            // 
            // topQuickSlot1
            // 
            topQuickSlot1.BackColor = Color.FromArgb(60, 60, 60);
            topQuickSlot1.FlatStyle = FlatStyle.Flat;
            topQuickSlot1.Font = new Font("Segoe UI", 10F, FontStyle.Bold);
            topQuickSlot1.ForeColor = Color.White;
            topQuickSlot1.Location = new Point(428, 7);
            topQuickSlot1.Name = "topQuickSlot1";
            topQuickSlot1.Size = new Size(145, 54);
            topQuickSlot1.TabIndex = 3;
            topQuickSlot1.Text = "[1]";
            topQuickSlot1.UseVisualStyleBackColor = false;
            topQuickSlot1.Click += QuickSlot_Click;
            // 
            // topQuickSlot3
            // 
            topQuickSlot3.BackColor = Color.FromArgb(64, 64, 64);
            topQuickSlot3.FlatStyle = FlatStyle.Flat;
            topQuickSlot3.Font = new Font("Segoe UI", 10F, FontStyle.Bold);
            topQuickSlot3.ForeColor = Color.White;
            topQuickSlot3.Location = new Point(726, 7);
            topQuickSlot3.Name = "topQuickSlot3";
            topQuickSlot3.Size = new Size(145, 54);
            topQuickSlot3.TabIndex = 3;
            topQuickSlot3.Text = "[3]";
            topQuickSlot3.UseVisualStyleBackColor = false;
            topQuickSlot3.Click += QuickSlot_Click;
            // 
            // topQuickSlot2
            // 
            topQuickSlot2.BackColor = Color.FromArgb(64, 64, 64);
            topQuickSlot2.FlatStyle = FlatStyle.Flat;
            topQuickSlot2.Font = new Font("Segoe UI", 10F, FontStyle.Bold);
            topQuickSlot2.ForeColor = Color.White;
            topQuickSlot2.Location = new Point(577, 7);
            topQuickSlot2.Name = "topQuickSlot2";
            topQuickSlot2.Size = new Size(145, 54);
            topQuickSlot2.TabIndex = 3;
            topQuickSlot2.Text = "[2]";
            topQuickSlot2.UseVisualStyleBackColor = false;
            topQuickSlot2.Click += QuickSlot_Click;
            // 
            // inventoryBtn
            // 
            inventoryBtn.BackColor = Color.SteelBlue;
            inventoryBtn.FlatStyle = FlatStyle.Flat;
            inventoryBtn.Font = new Font("Segoe UI", 10F, FontStyle.Bold);
            inventoryBtn.ForeColor = Color.White;
            inventoryBtn.Location = new Point(242, 7);
            inventoryBtn.Name = "inventoryBtn";
            inventoryBtn.Size = new Size(180, 54);
            inventoryBtn.TabIndex = 3;
            inventoryBtn.Text = "🎒 Inventory [Open]\r\n🔻";
            inventoryBtn.UseVisualStyleBackColor = false;
            inventoryBtn.Click += inventoryBtn_Click;
            // 
            // splicingBtn
            // 
            splicingBtn.BackColor = Color.FromArgb(64, 64, 64);
            splicingBtn.FlatStyle = FlatStyle.Flat;
            splicingBtn.Font = new Font("Segoe UI", 9F, FontStyle.Regular, GraphicsUnit.Point, 0);
            splicingBtn.ForeColor = Color.White;
            splicingBtn.Location = new Point(133, 32);
            splicingBtn.Name = "splicingBtn";
            splicingBtn.Size = new Size(103, 29);
            splicingBtn.TabIndex = 3;
            splicingBtn.Text = "📖 Splicing";
            splicingBtn.UseVisualStyleBackColor = false;
            splicingBtn.Click += splicingBtn_Click;
            // 
            // leaveWorldBtn
            // 
            leaveWorldBtn.BackColor = Color.FromArgb(64, 64, 64);
            leaveWorldBtn.FlatStyle = FlatStyle.Flat;
            leaveWorldBtn.Font = new Font("Segoe UI", 9F, FontStyle.Regular, GraphicsUnit.Point, 0);
            leaveWorldBtn.ForeColor = Color.White;
            leaveWorldBtn.Location = new Point(11, 32);
            leaveWorldBtn.Name = "leaveWorldBtn";
            leaveWorldBtn.Size = new Size(116, 29);
            leaveWorldBtn.TabIndex = 3;
            leaveWorldBtn.Text = "🚪 Leave World";
            leaveWorldBtn.UseVisualStyleBackColor = false;
            leaveWorldBtn.Click += leaveWorldBtn_Click;
            // 
            // labelWorldName
            // 
            labelWorldName.AutoSize = true;
            labelWorldName.Font = new Font("Segoe UI", 10F, FontStyle.Bold);
            labelWorldName.ForeColor = Color.LightSkyBlue;
            labelWorldName.Location = new Point(12, 7);
            labelWorldName.Name = "labelWorldName";
            labelWorldName.Size = new Size(75, 19);
            labelWorldName.TabIndex = 2;
            labelWorldName.Text = "🌏World:";
            // 
            // panel2
            // 
            panel2.BackColor = Color.FromArgb(20, 20, 20);
            panel2.Controls.Add(tileInfoLabel);
            panel2.Location = new Point(0, 623);
            panel2.Name = "panel2";
            panel2.Size = new Size(882, 32);
            panel2.TabIndex = 1;
            // 
            // tileInfoLabel
            // 
            tileInfoLabel.AutoSize = true;
            tileInfoLabel.ForeColor = Color.Lime;
            tileInfoLabel.Location = new Point(7, 8);
            tileInfoLabel.Name = "tileInfoLabel";
            tileInfoLabel.Size = new Size(38, 15);
            tileInfoLabel.TabIndex = 0;
            tileInfoLabel.Text = "label1";
            // 
            // Form1
            // 
            AutoScaleDimensions = new SizeF(96F, 96F);
            AutoScaleMode = AutoScaleMode.Dpi;
            BackColor = SystemColors.Control;
            ClientSize = new Size(882, 653);
            Controls.Add(panel2);
            Controls.Add(panel1);
            FormBorderStyle = FormBorderStyle.FixedSingle;
            MaximizeBox = false;
            Name = "Form1";
            StartPosition = FormStartPosition.CenterScreen;
            Text = "Growtopia 2D";
            panel1.ResumeLayout(false);
            panel1.PerformLayout();
            panel2.ResumeLayout(false);
            panel2.PerformLayout();
            ResumeLayout(false);
        }

        #endregion

        private Panel panel1;
        private Panel panel2;
        private Label labelWorldName;
        private Button leaveWorldBtn;
        private Button splicingBtn;
        private Button inventoryBtn;
        private Button topQuickSlot2;
        private Button topQuickSlot1;
        private Button topQuickSlot3;
        private Label tileInfoLabel;
    }
}
