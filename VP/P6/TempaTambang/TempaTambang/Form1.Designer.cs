namespace TempaTambang
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
            components = new System.ComponentModel.Container();
            labelCID = new Label();
            labelMoney = new Label();
            areaForge = new GroupBox();
            labelForge = new Label();
            areaStore = new GroupBox();
            labelStorage = new Label();
            thePlayer = new PictureBox();
            GameTimer = new System.Windows.Forms.Timer(components);
            spawnTimer = new System.Windows.Forms.Timer(components);
            areaForge.SuspendLayout();
            areaStore.SuspendLayout();
            ((System.ComponentModel.ISupportInitialize)thePlayer).BeginInit();
            SuspendLayout();
            // 
            // labelCID
            // 
            labelCID.AutoSize = true;
            labelCID.Dock = DockStyle.Left;
            labelCID.Font = new Font("Segoe UI", 10F);
            labelCID.ForeColor = Color.White;
            labelCID.Location = new Point(0, 0);
            labelCID.Margin = new Padding(3);
            labelCID.Name = "labelCID";
            labelCID.Padding = new Padding(5);
            labelCID.Size = new Size(259, 33);
            labelCID.TabIndex = 0;
            labelCID.Text = "Copper: 0 | Iron: 0 | Diamond: 0";
            // 
            // labelMoney
            // 
            labelMoney.AutoSize = true;
            labelMoney.Dock = DockStyle.Right;
            labelMoney.Font = new Font("Segoe UI", 12F, FontStyle.Bold);
            labelMoney.ForeColor = Color.White;
            labelMoney.Location = new Point(780, 0);
            labelMoney.Margin = new Padding(3);
            labelMoney.Name = "labelMoney";
            labelMoney.Padding = new Padding(5);
            labelMoney.Size = new Size(52, 38);
            labelMoney.TabIndex = 1;
            labelMoney.Text = "$ 0";
            labelMoney.TextAlign = ContentAlignment.TopRight;
            // 
            // areaForge
            // 
            areaForge.BackColor = Color.Sienna;
            areaForge.Controls.Add(labelForge);
            areaForge.Font = new Font("Segoe UI", 10F, FontStyle.Bold);
            areaForge.Location = new Point(12, 261);
            areaForge.Name = "areaForge";
            areaForge.Size = new Size(260, 200);
            areaForge.TabIndex = 2;
            areaForge.TabStop = false;
            areaForge.Text = "Forge";
            // 
            // labelForge
            // 
            labelForge.AutoSize = true;
            labelForge.Font = new Font("Segoe UI", 10F);
            labelForge.Location = new Point(32, 26);
            labelForge.Name = "labelForge";
            labelForge.Size = new Size(186, 23);
            labelForge.TabIndex = 0;
            labelForge.Text = "[Press E to open Forge]";
            // 
            // areaStore
            // 
            areaStore.BackColor = Color.ForestGreen;
            areaStore.Controls.Add(labelStorage);
            areaStore.Font = new Font("Segoe UI", 10F, FontStyle.Bold);
            areaStore.Location = new Point(560, 261);
            areaStore.Name = "areaStore";
            areaStore.Size = new Size(260, 200);
            areaStore.TabIndex = 2;
            areaStore.TabStop = false;
            areaStore.Text = "Store";
            // 
            // labelStorage
            // 
            labelStorage.AutoSize = true;
            labelStorage.Font = new Font("Segoe UI", 10F);
            labelStorage.Location = new Point(45, 26);
            labelStorage.Name = "labelStorage";
            labelStorage.Size = new Size(182, 23);
            labelStorage.TabIndex = 0;
            labelStorage.Text = "[Press E to open Store]";
            // 
            // thePlayer
            // 
            thePlayer.Image = Properties.Resources.man;
            thePlayer.Location = new Point(385, 349);
            thePlayer.Name = "thePlayer";
            thePlayer.Size = new Size(62, 73);
            thePlayer.TabIndex = 0;
            thePlayer.TabStop = false;
            // 
            // GameTimer
            // 
            GameTimer.Enabled = true;
            GameTimer.Tick += GameTimer_Tick;
            // 
            // spawnTimer
            // 
            spawnTimer.Tick += spawnTimer_Tick;
            // 
            // Form1
            // 
            AutoScaleMode = AutoScaleMode.None;
            BackColor = SystemColors.ControlDarkDark;
            ClientSize = new Size(832, 473);
            Controls.Add(thePlayer);
            Controls.Add(areaStore);
            Controls.Add(areaForge);
            Controls.Add(labelMoney);
            Controls.Add(labelCID);
            FormBorderStyle = FormBorderStyle.FixedSingle;
            MaximizeBox = false;
            Name = "Form1";
            StartPosition = FormStartPosition.CenterScreen;
            Text = "Tempa Tambang";
            Load += Form1_Load;
            KeyDown += Form1_KeyDown;
            areaForge.ResumeLayout(false);
            areaForge.PerformLayout();
            areaStore.ResumeLayout(false);
            areaStore.PerformLayout();
            ((System.ComponentModel.ISupportInitialize)thePlayer).EndInit();
            ResumeLayout(false);
            PerformLayout();
        }

        #endregion

        private Label labelCID;
        private Label labelMoney;
        private GroupBox areaForge;
        private GroupBox areaStore;
        private PictureBox thePlayer;
        private System.Windows.Forms.Timer GameTimer;
        private Label labelForge;
        private Label labelStorage;
        private System.Windows.Forms.Timer spawnTimer;
    }
}
