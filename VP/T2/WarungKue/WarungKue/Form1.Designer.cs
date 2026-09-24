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
            addKeju = new Button();
            addCoklat = new Button();
            addKue = new Button();
            addRoti = new Button();
            gudangKue = new Label();
            gudangRoti = new Label();
            groupBox2 = new GroupBox();
            label4 = new Label();
            label3 = new Label();
            label2 = new Label();
            labelDayCount = new Label();
            label5 = new Label();
            labelPesanan = new Label();
            targetPenjualanCounter = new Label();
            progressBar1 = new ProgressBar();
            cbRasa1 = new ComboBox();
            cbBahanUtama = new ComboBox();
            cbRasa2 = new ComboBox();
            kirimPesanan = new Button();
            buangItems = new Button();
            label7 = new Label();
            label8 = new Label();
            label9 = new Label();
            label10 = new Label();
            panelMainMenu.SuspendLayout();
            menuStrip1.SuspendLayout();
            groupBox1.SuspendLayout();
            groupBox2.SuspendLayout();
            SuspendLayout();
            // 
            // label1
            // 
            label1.AutoSize = true;
            label1.Font = new Font("Segoe UI Semibold", 32F, FontStyle.Bold);
            label1.ForeColor = Color.FromArgb(255, 224, 192);
            label1.Location = new Point(324, 123);
            label1.Name = "label1";
            label1.Size = new Size(265, 59);
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
            panelMainMenu.Location = new Point(0, 0);
            panelMainMenu.Name = "panelMainMenu";
            panelMainMenu.Size = new Size(932, 548);
            panelMainMenu.TabIndex = 4;
            // 
            // menuStrip1
            // 
            menuStrip1.ImageScalingSize = new Size(20, 20);
            menuStrip1.Items.AddRange(new ToolStripItem[] { tunjukResepToolStripMenuItem, autoFillpenalty50ToolStripMenuItem });
            menuStrip1.Location = new Point(0, 0);
            menuStrip1.Name = "menuStrip1";
            menuStrip1.Size = new Size(932, 24);
            menuStrip1.TabIndex = 5;
            menuStrip1.Text = "menuStrip1";
            // 
            // tunjukResepToolStripMenuItem
            // 
            tunjukResepToolStripMenuItem.Name = "tunjukResepToolStripMenuItem";
            tunjukResepToolStripMenuItem.Size = new Size(90, 20);
            tunjukResepToolStripMenuItem.Text = "Tunjuk Resep";
            tunjukResepToolStripMenuItem.Click += tunjukResepToolStripMenuItem_Click;
            // 
            // autoFillpenalty50ToolStripMenuItem
            // 
            autoFillpenalty50ToolStripMenuItem.Name = "autoFillpenalty50ToolStripMenuItem";
            autoFillpenalty50ToolStripMenuItem.Size = new Size(138, 20);
            autoFillpenalty50ToolStripMenuItem.Text = "Auto Fill (Penalty 50%)";
            autoFillpenalty50ToolStripMenuItem.Click += autoFillpenalty50ToolStripMenuItem_Click;
            // 
            // groupBox1
            // 
            groupBox1.Controls.Add(gudangKeju);
            groupBox1.Controls.Add(gudangCoklat);
            groupBox1.Controls.Add(addKeju);
            groupBox1.Controls.Add(addCoklat);
            groupBox1.Controls.Add(addKue);
            groupBox1.Controls.Add(addRoti);
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
            gudangKeju.Location = new Point(8, 144);
            gudangKeju.Name = "gudangKeju";
            gudangKeju.Size = new Size(52, 19);
            gudangKeju.TabIndex = 12;
            gudangKeju.Text = "Keju: 0";
            // 
            // gudangCoklat
            // 
            gudangCoklat.AutoSize = true;
            gudangCoklat.Font = new Font("Segoe UI Semibold", 10F, FontStyle.Bold);
            gudangCoklat.Location = new Point(8, 107);
            gudangCoklat.Name = "gudangCoklat";
            gudangCoklat.Size = new Size(64, 19);
            gudangCoklat.TabIndex = 11;
            gudangCoklat.Text = "Coklat: 0";
            // 
            // addKeju
            // 
            addKeju.Font = new Font("Segoe UI Semibold", 10F, FontStyle.Bold);
            addKeju.ForeColor = Color.Black;
            addKeju.Location = new Point(126, 140);
            addKeju.Name = "addKeju";
            addKeju.Size = new Size(103, 31);
            addKeju.TabIndex = 10;
            addKeju.Text = "+ Rp 5.000";
            addKeju.UseVisualStyleBackColor = true;
            addKeju.Click += addKeju_Click;
            // 
            // addCoklat
            // 
            addCoklat.Font = new Font("Segoe UI Semibold", 10F, FontStyle.Bold);
            addCoklat.ForeColor = Color.Black;
            addCoklat.Location = new Point(126, 103);
            addCoklat.Name = "addCoklat";
            addCoklat.Size = new Size(103, 31);
            addCoklat.TabIndex = 9;
            addCoklat.Text = "+ Rp 5.000";
            addCoklat.UseVisualStyleBackColor = true;
            addCoklat.Click += addCoklat_Click;
            // 
            // addKue
            // 
            addKue.Font = new Font("Segoe UI Semibold", 10F, FontStyle.Bold);
            addKue.ForeColor = Color.Black;
            addKue.Location = new Point(126, 66);
            addKue.Name = "addKue";
            addKue.Size = new Size(103, 31);
            addKue.TabIndex = 8;
            addKue.Text = "+ Rp 3.000";
            addKue.UseVisualStyleBackColor = true;
            addKue.Click += addKue_Click;
            // 
            // addRoti
            // 
            addRoti.Font = new Font("Segoe UI Semibold", 10F, FontStyle.Bold);
            addRoti.ForeColor = Color.Black;
            addRoti.Location = new Point(126, 29);
            addRoti.Name = "addRoti";
            addRoti.Size = new Size(103, 31);
            addRoti.TabIndex = 7;
            addRoti.Text = "+ Rp 2.000";
            addRoti.UseVisualStyleBackColor = true;
            addRoti.Click += addRoti_Click;
            // 
            // gudangKue
            // 
            gudangKue.AutoSize = true;
            gudangKue.Font = new Font("Segoe UI Semibold", 10F, FontStyle.Bold);
            gudangKue.Location = new Point(8, 70);
            gudangKue.Name = "gudangKue";
            gudangKue.Size = new Size(48, 19);
            gudangKue.TabIndex = 1;
            gudangKue.Text = "Kue: 0";
            // 
            // gudangRoti
            // 
            gudangRoti.AutoSize = true;
            gudangRoti.Font = new Font("Segoe UI Semibold", 10F, FontStyle.Bold);
            gudangRoti.Location = new Point(8, 33);
            gudangRoti.Name = "gudangRoti";
            gudangRoti.Size = new Size(50, 19);
            gudangRoti.TabIndex = 0;
            gudangRoti.Text = "Roti: 0";
            // 
            // groupBox2
            // 
            groupBox2.Controls.Add(label4);
            groupBox2.Controls.Add(label3);
            groupBox2.Controls.Add(label2);
            groupBox2.Font = new Font("Segoe UI Semibold", 10F, FontStyle.Bold);
            groupBox2.ForeColor = Color.White;
            groupBox2.Location = new Point(7, 222);
            groupBox2.Name = "groupBox2";
            groupBox2.Size = new Size(194, 151);
            groupBox2.TabIndex = 13;
            groupBox2.TabStop = false;
            groupBox2.Text = "Menu Pesanan";
            // 
            // label4
            // 
            label4.AutoSize = true;
            label4.Location = new Point(8, 106);
            label4.Name = "label4";
            label4.Size = new Size(130, 19);
            label4.TabIndex = 0;
            label4.Text = "Dua rasa +Rp 8000\r\n";
            // 
            // label3
            // 
            label3.AutoSize = true;
            label3.Location = new Point(8, 70);
            label3.Name = "label3";
            label3.Size = new Size(137, 19);
            label3.TabIndex = 0;
            label3.Text = "Satu Rasa +Rp 8000";
            // 
            // label2
            // 
            label2.AutoSize = true;
            label2.Location = new Point(8, 37);
            label2.Name = "label2";
            label2.Size = new Size(122, 19);
            label2.TabIndex = 0;
            label2.Text = "Roti/Kue Rp 6000";
            // 
            // labelDayCount
            // 
            labelDayCount.AutoSize = true;
            labelDayCount.Font = new Font("Segoe UI", 16F, FontStyle.Bold);
            labelDayCount.ForeColor = Color.White;
            labelDayCount.Location = new Point(417, 50);
            labelDayCount.Name = "labelDayCount";
            labelDayCount.Size = new Size(72, 30);
            labelDayCount.TabIndex = 14;
            labelDayCount.Text = "Day 1";
            // 
            // label5
            // 
            label5.AutoSize = true;
            label5.Font = new Font("Segoe UI", 16F, FontStyle.Bold);
            label5.ForeColor = Color.White;
            label5.Location = new Point(336, 109);
            label5.Name = "label5";
            label5.Size = new Size(206, 30);
            label5.TabIndex = 15;
            label5.Text = "Pesanan Sekarang:";
            // 
            // labelPesanan
            // 
            labelPesanan.AutoSize = true;
            labelPesanan.BackColor = Color.Transparent;
            labelPesanan.Font = new Font("Segoe UI", 16F, FontStyle.Bold);
            labelPesanan.ForeColor = Color.White;
            labelPesanan.Location = new Point(363, 146);
            labelPesanan.Name = "labelPesanan";
            labelPesanan.Size = new Size(131, 30);
            labelPesanan.TabIndex = 15;
            labelPesanan.Text = "<pesanan>\r\n";
            labelPesanan.TextAlign = ContentAlignment.TopCenter;
            // 
            // targetPenjualanCounter
            // 
            targetPenjualanCounter.AutoSize = true;
            targetPenjualanCounter.Dock = DockStyle.Right;
            targetPenjualanCounter.Font = new Font("Segoe UI", 16F, FontStyle.Bold);
            targetPenjualanCounter.ForeColor = Color.White;
            targetPenjualanCounter.Location = new Point(738, 24);
            targetPenjualanCounter.Name = "targetPenjualanCounter";
            targetPenjualanCounter.RightToLeft = RightToLeft.No;
            targetPenjualanCounter.Size = new Size(194, 60);
            targetPenjualanCounter.TabIndex = 16;
            targetPenjualanCounter.Text = "Target Penjualan:\r\nRp 0 / Rp 100000";
            targetPenjualanCounter.TextAlign = ContentAlignment.TopRight;
            // 
            // progressBar1
            // 
            progressBar1.Location = new Point(700, 109);
            progressBar1.Name = "progressBar1";
            progressBar1.Size = new Size(225, 24);
            progressBar1.TabIndex = 17;
            // 
            // cbRasa1
            // 
            cbRasa1.DropDownStyle = ComboBoxStyle.DropDownList;
            cbRasa1.FormattingEnabled = true;
            cbRasa1.Items.AddRange(new object[] { "Coklat", "Keju" });
            cbRasa1.Location = new Point(519, 279);
            cbRasa1.Name = "cbRasa1";
            cbRasa1.Size = new Size(175, 29);
            cbRasa1.TabIndex = 18;
            cbRasa1.DropDown += cbRasa1_DropDown;
            // 
            // cbBahanUtama
            // 
            cbBahanUtama.DropDownStyle = ComboBoxStyle.DropDownList;
            cbBahanUtama.FormattingEnabled = true;
            cbBahanUtama.Items.AddRange(new object[] { "Roti", "Kue" });
            cbBahanUtama.Location = new Point(276, 277);
            cbBahanUtama.Name = "cbBahanUtama";
            cbBahanUtama.Size = new Size(175, 29);
            cbBahanUtama.TabIndex = 18;
            // 
            // cbRasa2
            // 
            cbRasa2.DropDownStyle = ComboBoxStyle.DropDownList;
            cbRasa2.FormattingEnabled = true;
            cbRasa2.Items.AddRange(new object[] { "Coklat", "Keju" });
            cbRasa2.Location = new Point(516, 366);
            cbRasa2.Name = "cbRasa2";
            cbRasa2.Size = new Size(175, 29);
            cbRasa2.TabIndex = 18;
            cbRasa2.DropDown += cbRasa2_DropDown;
            // 
            // kirimPesanan
            // 
            kirimPesanan.Font = new Font("Segoe UI Semibold", 12F, FontStyle.Bold);
            kirimPesanan.Location = new Point(276, 362);
            kirimPesanan.Name = "kirimPesanan";
            kirimPesanan.Size = new Size(175, 42);
            kirimPesanan.TabIndex = 19;
            kirimPesanan.Text = "Kirim Pesanan";
            kirimPesanan.UseVisualStyleBackColor = true;
            kirimPesanan.Click += kirimPesanan_Click;
            // 
            // buangItems
            // 
            buangItems.Font = new Font("Segoe UI Semibold", 12F, FontStyle.Bold);
            buangItems.Location = new Point(390, 446);
            buangItems.Name = "buangItems";
            buangItems.Size = new Size(175, 42);
            buangItems.TabIndex = 19;
            buangItems.Text = "Buang";
            buangItems.UseVisualStyleBackColor = true;
            buangItems.Click += buangItems_Click;
            // 
            // label7
            // 
            label7.AutoSize = true;
            label7.Font = new Font("Segoe UI", 13F, FontStyle.Bold);
            label7.ForeColor = Color.White;
            label7.Location = new Point(276, 244);
            label7.Name = "label7";
            label7.Size = new Size(132, 25);
            label7.TabIndex = 20;
            label7.Text = "Bahan Utama:";
            // 
            // label8
            // 
            label8.AutoSize = true;
            label8.Font = new Font("Segoe UI", 13F, FontStyle.Bold);
            label8.ForeColor = Color.White;
            label8.Location = new Point(516, 246);
            label8.Name = "label8";
            label8.Size = new Size(133, 25);
            label8.TabIndex = 20;
            label8.Text = "Rasa Pertama:";
            // 
            // label9
            // 
            label9.AutoSize = true;
            label9.Font = new Font("Segoe UI", 13F, FontStyle.Bold);
            label9.ForeColor = Color.White;
            label9.Location = new Point(516, 333);
            label9.Name = "label9";
            label9.Size = new Size(116, 25);
            label9.TabIndex = 20;
            label9.Text = "Rasa Kedua:";
            // 
            // label10
            // 
            label10.AutoSize = true;
            label10.Font = new Font("Segoe UI", 10F);
            label10.ForeColor = Color.White;
            label10.Location = new Point(5, 525);
            label10.Name = "label10";
            label10.Size = new Size(355, 19);
            label10.TabIndex = 21;
            label10.Text = "*Jika pesanan salah, maka pembeli tidak akan membayar";
            // 
            // Form1
            // 
            AutoScaleMode = AutoScaleMode.None;
            BackColor = Color.Sienna;
            ClientSize = new Size(932, 553);
            Controls.Add(panelMainMenu);
            Controls.Add(label10);
            Controls.Add(label9);
            Controls.Add(label8);
            Controls.Add(label7);
            Controls.Add(buangItems);
            Controls.Add(kirimPesanan);
            Controls.Add(cbBahanUtama);
            Controls.Add(cbRasa2);
            Controls.Add(cbRasa1);
            Controls.Add(progressBar1);
            Controls.Add(targetPenjualanCounter);
            Controls.Add(label5);
            Controls.Add(labelDayCount);
            Controls.Add(groupBox2);
            Controls.Add(groupBox1);
            Controls.Add(menuStrip1);
            Controls.Add(labelPesanan);
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
            groupBox2.ResumeLayout(false);
            groupBox2.PerformLayout();
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
        private ToolStripMenuItem simpanGameToolStripMenuItem;
        private GroupBox groupBox1;
        private Button addRoti;
        private Label gudangKue;
        private Label gudangRoti;
        private Label gudangKeju;
        private Label gudangCoklat;
        private Button addKeju;
        private Button addCoklat;
        private Button addKue;
        private GroupBox groupBox2;
        private Label label4;
        private Label label3;
        private Label label2;
        private Label labelDayCount;
        private Label label5;
        private Label labelPesanan;
        private Label targetPenjualanCounter;
        private ProgressBar progressBar1;
        private ComboBox cbRasa1;
        private ComboBox cbBahanUtama;
        private ComboBox cbRasa2;
        private Button kirimPesanan;
        private Button buangItems;
        private Label label7;
        private Label label8;
        private Label label9;
        private Label label10;
    }
}
