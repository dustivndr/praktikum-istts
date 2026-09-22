namespace WarungKue
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
            label1 = new Label();
            newGame = new Button();
            continueGame = new Button();
            exitGame = new Button();
            panelMainMenu = new Panel();
            menuStrip1 = new MenuStrip();
            tunjukResepToolStripMenuItem = new ToolStripMenuItem();
            autoFillpenalty50ToolStripMenuItem = new ToolStripMenuItem();
            groupBox1 = new GroupBox();
            gudangKeju = new Label();
            gudangCoklat = new Label();
            button4 = new Button();
            button3 = new Button();
            button2 = new Button();
            button1 = new Button();
            gudangKue = new Label();
            gudangRoti = new Label();
            panelMainMenu.SuspendLayout();
            menuStrip1.SuspendLayout();
            groupBox1.SuspendLayout();
            SuspendLayout();
            // 
            // label1
            // 
            label1.AutoSize = true;
            label1.Font = new Font("Segoe UI Semibold", 32F, FontStyle.Bold);
            label1.ForeColor = Color.FromArgb(255, 224, 192);
            label1.Location = new Point(285, 91);
            label1.Name = "label1";
            label1.Size = new Size(334, 72);
            label1.TabIndex = 0;
            label1.Text = "Warung Kue";
            // 
            // newGame
            // 
            newGame.Font = new Font("Segoe UI", 14F, FontStyle.Bold);
            newGame.Location = new Point(357, 197);
            newGame.Name = "newGame";
            newGame.Size = new Size(192, 51);
            newGame.TabIndex = 1;
            newGame.Text = "New Game";
            newGame.UseVisualStyleBackColor = true;
            newGame.Click += newGame_Click;
            // 
            // continueGame
            // 
            continueGame.Font = new Font("Segoe UI", 14F, FontStyle.Bold);
            continueGame.Location = new Point(357, 266);
            continueGame.Name = "continueGame";
            continueGame.Size = new Size(192, 51);
            continueGame.TabIndex = 2;
            continueGame.Text = "Continue";
            continueGame.UseVisualStyleBackColor = true;
            continueGame.Click += continueGame_Click;
            // 
            // exitGame
            // 
            exitGame.Font = new Font("Segoe UI", 14F, FontStyle.Bold);
            exitGame.Location = new Point(357, 336);
            exitGame.Name = "exitGame";
            exitGame.Size = new Size(192, 51);
            exitGame.TabIndex = 3;
            exitGame.Text = "Exit";
            exitGame.UseVisualStyleBackColor = true;
            exitGame.Click += exitGame_Click;
            // 
            // panelMainMenu
            // 
            panelMainMenu.Controls.Add(exitGame);
            panelMainMenu.Controls.Add(continueGame);
            panelMainMenu.Controls.Add(newGame);
            panelMainMenu.Controls.Add(label1);
            panelMainMenu.Location = new Point(794, 359);
            panelMainMenu.Name = "panelMainMenu";
            panelMainMenu.Size = new Size(908, 510);
            panelMainMenu.TabIndex = 4;
            // 
            // menuStrip1
            // 
            menuStrip1.ImageScalingSize = new Size(20, 20);
            menuStrip1.Items.AddRange(new ToolStripItem[] { tunjukResepToolStripMenuItem, autoFillpenalty50ToolStripMenuItem });
            menuStrip1.Location = new Point(0, 0);
            menuStrip1.Name = "menuStrip1";
            menuStrip1.Size = new Size(932, 28);
            menuStrip1.TabIndex = 5;
            menuStrip1.Text = "menuStrip1";
            // 
            // tunjukResepToolStripMenuItem
            // 
            tunjukResepToolStripMenuItem.Name = "tunjukResepToolStripMenuItem";
            tunjukResepToolStripMenuItem.Size = new Size(110, 24);
            tunjukResepToolStripMenuItem.Text = "Tunjuk Resep";
            tunjukResepToolStripMenuItem.Click += tunjukResepToolStripMenuItem_Click;
            // 
            // autoFillpenalty50ToolStripMenuItem
            // 
            autoFillpenalty50ToolStripMenuItem.Name = "autoFillpenalty50ToolStripMenuItem";
            autoFillpenalty50ToolStripMenuItem.Size = new Size(171, 24);
            autoFillpenalty50ToolStripMenuItem.Text = "Auto Fill (Penalty 50%)";
            // 
            // groupBox1
            // 
            groupBox1.Controls.Add(gudangKeju);
            groupBox1.Controls.Add(gudangCoklat);
            groupBox1.Controls.Add(button4);
            groupBox1.Controls.Add(button3);
            groupBox1.Controls.Add(button2);
            groupBox1.Controls.Add(button1);
            groupBox1.Controls.Add(gudangKue);
            groupBox1.Controls.Add(gudangRoti);
            groupBox1.Font = new Font("Segoe UI Semibold", 10F, FontStyle.Bold);
            groupBox1.ForeColor = Color.White;
            groupBox1.Location = new Point(7, 31);
            groupBox1.Name = "groupBox1";
            groupBox1.Size = new Size(244, 185);
            groupBox1.TabIndex = 6;
            groupBox1.TabStop = false;
            groupBox1.Text = "Gudang";
            // 
            // gudangKeju
            // 
            gudangKeju.AutoSize = true;
            gudangKeju.Font = new Font("Segoe UI Semibold", 10F, FontStyle.Bold);
            gudangKeju.Location = new Point(7, 144);
            gudangKeju.Name = "gudangKeju";
            gudangKeju.Size = new Size(47, 23);
            gudangKeju.TabIndex = 12;
            gudangKeju.Text = "Keju:";
            // 
            // gudangCoklat
            // 
            gudangCoklat.AutoSize = true;
            gudangCoklat.Font = new Font("Segoe UI Semibold", 10F, FontStyle.Bold);
            gudangCoklat.Location = new Point(7, 107);
            gudangCoklat.Name = "gudangCoklat";
            gudangCoklat.Size = new Size(63, 23);
            gudangCoklat.TabIndex = 11;
            gudangCoklat.Text = "Coklat:";
            // 
            // button4
            // 
            button4.Font = new Font("Segoe UI Semibold", 10F, FontStyle.Bold);
            button4.ForeColor = Color.Black;
            button4.Location = new Point(126, 140);
            button4.Name = "button4";
            button4.Size = new Size(103, 31);
            button4.TabIndex = 10;
            button4.Text = "+ Rp 5.000";
            button4.UseVisualStyleBackColor = true;
            // 
            // button3
            // 
            button3.Font = new Font("Segoe UI Semibold", 10F, FontStyle.Bold);
            button3.ForeColor = Color.Black;
            button3.Location = new Point(126, 103);
            button3.Name = "button3";
            button3.Size = new Size(103, 31);
            button3.TabIndex = 9;
            button3.Text = "+ Rp 5.000";
            button3.UseVisualStyleBackColor = true;
            // 
            // button2
            // 
            button2.Font = new Font("Segoe UI Semibold", 10F, FontStyle.Bold);
            button2.ForeColor = Color.Black;
            button2.Location = new Point(126, 66);
            button2.Name = "button2";
            button2.Size = new Size(103, 31);
            button2.TabIndex = 8;
            button2.Text = "+ Rp 3.000";
            button2.UseVisualStyleBackColor = true;
            // 
            // button1
            // 
            button1.Font = new Font("Segoe UI Semibold", 10F, FontStyle.Bold);
            button1.ForeColor = Color.Black;
            button1.Location = new Point(126, 29);
            button1.Name = "button1";
            button1.Size = new Size(103, 31);
            button1.TabIndex = 7;
            button1.Text = "+ Rp 2.000";
            button1.UseVisualStyleBackColor = true;
            // 
            // gudangKue
            // 
            gudangKue.AutoSize = true;
            gudangKue.Font = new Font("Segoe UI Semibold", 10F, FontStyle.Bold);
            gudangKue.Location = new Point(7, 70);
            gudangKue.Name = "gudangKue";
            gudangKue.Size = new Size(43, 23);
            gudangKue.TabIndex = 1;
            gudangKue.Text = "Kue:";
            // 
            // gudangRoti
            // 
            gudangRoti.AutoSize = true;
            gudangRoti.Font = new Font("Segoe UI Semibold", 10F, FontStyle.Bold);
            gudangRoti.Location = new Point(7, 33);
            gudangRoti.Name = "gudangRoti";
            gudangRoti.Size = new Size(50, 23);
            gudangRoti.TabIndex = 0;
            gudangRoti.Text = "Roti: ";
            // 
            // Form1
            // 
            AutoScaleMode = AutoScaleMode.None;
            BackColor = Color.Sienna;
            ClientSize = new Size(932, 553);
            Controls.Add(groupBox1);
            Controls.Add(panelMainMenu);
            Controls.Add(menuStrip1);
            Font = new Font("Segoe UI", 12F, FontStyle.Regular, GraphicsUnit.Point, 0);
            MainMenuStrip = menuStrip1;
            MaximizeBox = false;
            Name = "Form1";
            Text = "Warung Kue";
            panelMainMenu.ResumeLayout(false);
            panelMainMenu.PerformLayout();
            menuStrip1.ResumeLayout(false);
            menuStrip1.PerformLayout();
            groupBox1.ResumeLayout(false);
            groupBox1.PerformLayout();
            ResumeLayout(false);
            PerformLayout();
        }

        #endregion

        private Label label1;
        private Button newGame;
        private Button continueGame;
        private Button exitGame;
        private Panel panelMainMenu;
        private MenuStrip menuStrip1;
        private ToolStripMenuItem tunjukResepToolStripMenuItem;
        private ToolStripMenuItem autoFillpenalty50ToolStripMenuItem;
        private GroupBox groupBox1;
        private Button button1;
        private Label gudangKue;
        private Label gudangRoti;
        private Label gudangKeju;
        private Label gudangCoklat;
        private Button button4;
        private Button button3;
        private Button button2;
    }
}
