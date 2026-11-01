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
            label2 = new Label();
            label3 = new Label();
            label4 = new Label();
            labelCopper = new Label();
            labelIron = new Label();
            labelDiamond = new Label();
            button1 = new Button();
            button2 = new Button();
            button3 = new Button();
            listBox1 = new ListBox();
            button4 = new Button();
            button5 = new Button();
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
            // label2
            // 
            label2.AutoSize = true;
            label2.Dock = DockStyle.Top;
            label2.Font = new Font("Segoe UI", 11F, FontStyle.Bold);
            label2.Location = new Point(0, 47);
            label2.Margin = new Padding(5);
            label2.Name = "label2";
            label2.Padding = new Padding(10, 1, 5, 5);
            label2.Size = new Size(195, 31);
            label2.TabIndex = 1;
            label2.Text = "Current Money: $0";
            label2.Click += this.label2_Click;
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
            // button1
            // 
            button1.Location = new Point(231, 142);
            button1.Name = "button1";
            button1.Size = new Size(61, 29);
            button1.TabIndex = 4;
            button1.Text = "Sell";
            button1.UseVisualStyleBackColor = true;
            // 
            // button2
            // 
            button2.Location = new Point(231, 189);
            button2.Name = "button2";
            button2.Size = new Size(61, 29);
            button2.TabIndex = 4;
            button2.Text = "Sell";
            button2.UseVisualStyleBackColor = true;
            // 
            // button3
            // 
            button3.Location = new Point(231, 237);
            button3.Name = "button3";
            button3.Size = new Size(61, 29);
            button3.TabIndex = 4;
            button3.Text = "Sell";
            button3.UseVisualStyleBackColor = true;
            // 
            // listBox1
            // 
            listBox1.FormattingEnabled = true;
            listBox1.Location = new Point(318, 142);
            listBox1.Name = "listBox1";
            listBox1.Size = new Size(323, 124);
            listBox1.TabIndex = 5;
            // 
            // button4
            // 
            button4.Location = new Point(318, 288);
            button4.Name = "button4";
            button4.Size = new Size(92, 29);
            button4.TabIndex = 4;
            button4.Text = "Sell";
            button4.UseVisualStyleBackColor = true;
            // 
            // button5
            // 
            button5.Font = new Font("Segoe UI", 11F, FontStyle.Bold);
            button5.Location = new Point(14, 321);
            button5.Name = "button5";
            button5.Size = new Size(278, 51);
            button5.TabIndex = 4;
            button5.Text = "Buy Win ($100000)";
            button5.UseVisualStyleBackColor = true;
            // 
            // Store
            // 
            AutoScaleDimensions = new SizeF(8F, 20F);
            AutoScaleMode = AutoScaleMode.Font;
            ClientSize = new Size(682, 403);
            Controls.Add(listBox1);
            Controls.Add(button3);
            Controls.Add(button2);
            Controls.Add(button5);
            Controls.Add(button4);
            Controls.Add(button1);
            Controls.Add(labelDiamond);
            Controls.Add(labelIron);
            Controls.Add(labelCopper);
            Controls.Add(label4);
            Controls.Add(label3);
            Controls.Add(label2);
            Controls.Add(label1);
            FormBorderStyle = FormBorderStyle.FixedSingle;
            MaximizeBox = false;
            Name = "Store";
            Text = "Store";
            ResumeLayout(false);
            PerformLayout();
        }

        #endregion

        private Label label1;
        private Label label2;
        private Label label3;
        private Label label4;
        private Label labelCopper;
        private Label labelIron;
        private Label labelDiamond;
        private Button button1;
        private Button button2;
        private Button button3;
        private ListBox listBox1;
        private Button button4;
        private Button button5;
    }
}