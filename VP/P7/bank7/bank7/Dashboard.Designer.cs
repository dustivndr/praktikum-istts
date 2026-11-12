namespace bank7
{
    partial class Dashboard
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
            menuStrip1 = new MenuStrip();
            dashboardToolStripMenuItem = new ToolStripMenuItem();
            transactionLogToolStripMenuItem = new ToolStripMenuItem();
            labelNama = new Label();
            labelNorek = new Label();
            labelSaldo = new Label();
            dataGridView1 = new DataGridView();
            label4 = new Label();
            panelDashboard = new Panel();
            panelTransLog = new Panel();
            dataGridView2 = new DataGridView();
            label5 = new Label();
            menuStrip1.SuspendLayout();
            ((System.ComponentModel.ISupportInitialize)dataGridView1).BeginInit();
            panelDashboard.SuspendLayout();
            panelTransLog.SuspendLayout();
            ((System.ComponentModel.ISupportInitialize)dataGridView2).BeginInit();
            SuspendLayout();
            // 
            // menuStrip1
            // 
            menuStrip1.ImageScalingSize = new Size(20, 20);
            menuStrip1.Items.AddRange(new ToolStripItem[] { dashboardToolStripMenuItem, transactionLogToolStripMenuItem });
            menuStrip1.Location = new Point(0, 0);
            menuStrip1.Name = "menuStrip1";
            menuStrip1.Size = new Size(932, 28);
            menuStrip1.TabIndex = 0;
            menuStrip1.Text = "menuStrip1";
            // 
            // dashboardToolStripMenuItem
            // 
            dashboardToolStripMenuItem.Name = "dashboardToolStripMenuItem";
            dashboardToolStripMenuItem.Size = new Size(96, 24);
            dashboardToolStripMenuItem.Text = "Dashboard";
            dashboardToolStripMenuItem.Click += dashboardToolStripMenuItem_Click;
            // 
            // transactionLogToolStripMenuItem
            // 
            transactionLogToolStripMenuItem.Name = "transactionLogToolStripMenuItem";
            transactionLogToolStripMenuItem.Size = new Size(127, 24);
            transactionLogToolStripMenuItem.Text = "Transaction Log";
            transactionLogToolStripMenuItem.Click += transactionLogToolStripMenuItem_Click;
            // 
            // labelNama
            // 
            labelNama.AutoSize = true;
            labelNama.Font = new Font("Segoe UI", 16.2F, FontStyle.Bold, GraphicsUnit.Point, 0);
            labelNama.Location = new Point(20, 1);
            labelNama.Name = "labelNama";
            labelNama.Size = new Size(157, 38);
            labelNama.TabIndex = 1;
            labelNama.Text = "Hello, user";
            // 
            // labelNorek
            // 
            labelNorek.AutoSize = true;
            labelNorek.Font = new Font("Segoe UI", 10F);
            labelNorek.Location = new Point(25, 54);
            labelNorek.Name = "labelNorek";
            labelNorek.Size = new Size(174, 23);
            labelNorek.TabIndex = 2;
            labelNorek.Text = "Account Number: <>";
            // 
            // labelSaldo
            // 
            labelSaldo.AutoSize = true;
            labelSaldo.Font = new Font("Segoe UI", 10F);
            labelSaldo.Location = new Point(25, 77);
            labelSaldo.Name = "labelSaldo";
            labelSaldo.Size = new Size(102, 23);
            labelSaldo.TabIndex = 2;
            labelSaldo.Text = "Balance: <>";
            // 
            // dataGridView1
            // 
            dataGridView1.ColumnHeadersHeightSizeMode = DataGridViewColumnHeadersHeightSizeMode.AutoSize;
            dataGridView1.Location = new Point(22, 173);
            dataGridView1.Name = "dataGridView1";
            dataGridView1.RowHeadersWidth = 51;
            dataGridView1.Size = new Size(884, 324);
            dataGridView1.TabIndex = 3;
            // 
            // label4
            // 
            label4.AutoSize = true;
            label4.Font = new Font("Segoe UI", 12F, FontStyle.Bold, GraphicsUnit.Point, 0);
            label4.Location = new Point(20, 127);
            label4.Name = "label4";
            label4.Size = new Size(237, 28);
            label4.TabIndex = 4;
            label4.Text = "Transfer to Other Users:";
            // 
            // panelDashboard
            // 
            panelDashboard.Controls.Add(label4);
            panelDashboard.Controls.Add(dataGridView1);
            panelDashboard.Controls.Add(labelSaldo);
            panelDashboard.Controls.Add(labelNorek);
            panelDashboard.Controls.Add(labelNama);
            panelDashboard.Location = new Point(2, 44);
            panelDashboard.Name = "panelDashboard";
            panelDashboard.Size = new Size(928, 507);
            panelDashboard.TabIndex = 5;
            // 
            // panelTransLog
            // 
            panelTransLog.Controls.Add(dataGridView2);
            panelTransLog.Controls.Add(label5);
            panelTransLog.Location = new Point(0, 28);
            panelTransLog.Name = "panelTransLog";
            panelTransLog.Size = new Size(930, 520);
            panelTransLog.TabIndex = 6;
            // 
            // dataGridView2
            // 
            dataGridView2.ColumnHeadersHeightSizeMode = DataGridViewColumnHeadersHeightSizeMode.AutoSize;
            dataGridView2.Location = new Point(23, 98);
            dataGridView2.Name = "dataGridView2";
            dataGridView2.RowHeadersWidth = 51;
            dataGridView2.Size = new Size(884, 412);
            dataGridView2.TabIndex = 4;
            // 
            // label5
            // 
            label5.AutoSize = true;
            label5.Font = new Font("Segoe UI", 16.2F, FontStyle.Bold, GraphicsUnit.Point, 0);
            label5.Location = new Point(23, 14);
            label5.Name = "label5";
            label5.Size = new Size(271, 38);
            label5.TabIndex = 2;
            label5.Text = "Transaction History";
            // 
            // Dashboard
            // 
            AutoScaleDimensions = new SizeF(8F, 20F);
            AutoScaleMode = AutoScaleMode.Font;
            ClientSize = new Size(932, 553);
            Controls.Add(panelTransLog);
            Controls.Add(panelDashboard);
            Controls.Add(menuStrip1);
            FormBorderStyle = FormBorderStyle.FixedSingle;
            MainMenuStrip = menuStrip1;
            MaximizeBox = false;
            Name = "Dashboard";
            StartPosition = FormStartPosition.CenterScreen;
            Text = "Banking System";
            Load += Dashboard_Load;
            menuStrip1.ResumeLayout(false);
            menuStrip1.PerformLayout();
            ((System.ComponentModel.ISupportInitialize)dataGridView1).EndInit();
            panelDashboard.ResumeLayout(false);
            panelDashboard.PerformLayout();
            panelTransLog.ResumeLayout(false);
            panelTransLog.PerformLayout();
            ((System.ComponentModel.ISupportInitialize)dataGridView2).EndInit();
            ResumeLayout(false);
            PerformLayout();
        }

        #endregion

        private MenuStrip menuStrip1;
        private ToolStripMenuItem dashboardToolStripMenuItem;
        private ToolStripMenuItem transactionLogToolStripMenuItem;
        private Label labelNama;
        private Label labelNorek;
        private Label labelSaldo;
        private DataGridView dataGridView1;
        private Label label4;
        private Panel panelDashboard;
        private Panel panelTransLog;
        private DataGridView dataGridView2;
        private Label label5;
    }
}