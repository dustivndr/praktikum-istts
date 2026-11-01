namespace TempaTambang
{
    partial class Forge
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
            copperAmount = new NumericUpDown();
            ironAmount = new NumericUpDown();
            diamondAmount = new NumericUpDown();
            button1 = new Button();
            ((System.ComponentModel.ISupportInitialize)copperAmount).BeginInit();
            ((System.ComponentModel.ISupportInitialize)ironAmount).BeginInit();
            ((System.ComponentModel.ISupportInitialize)diamondAmount).BeginInit();
            SuspendLayout();
            // 
            // label1
            // 
            label1.AutoSize = true;
            label1.Font = new Font("Segoe UI", 16F, FontStyle.Bold);
            label1.Location = new Point(17, 19);
            label1.Name = "label1";
            label1.Size = new Size(197, 37);
            label1.TabIndex = 0;
            label1.Text = "Forge Artifact";
            // 
            // label2
            // 
            label2.AutoSize = true;
            label2.Font = new Font("Segoe UI", 10F);
            label2.Location = new Point(26, 91);
            label2.Name = "label2";
            label2.Size = new Size(70, 23);
            label2.TabIndex = 1;
            label2.Text = "Copper:";
            // 
            // label3
            // 
            label3.AutoSize = true;
            label3.Font = new Font("Segoe UI", 10F);
            label3.Location = new Point(26, 137);
            label3.Name = "label3";
            label3.Size = new Size(45, 23);
            label3.TabIndex = 1;
            label3.Text = "Iron:";
            // 
            // label4
            // 
            label4.AutoSize = true;
            label4.Font = new Font("Segoe UI", 10F);
            label4.Location = new Point(26, 185);
            label4.Name = "label4";
            label4.Size = new Size(84, 23);
            label4.TabIndex = 1;
            label4.Text = "Diamond:";
            // 
            // copperAmount
            // 
            copperAmount.Font = new Font("Segoe UI", 10F);
            copperAmount.Location = new Point(121, 89);
            copperAmount.Name = "copperAmount";
            copperAmount.Size = new Size(150, 30);
            copperAmount.TabIndex = 2;
            // 
            // ironAmount
            // 
            ironAmount.Font = new Font("Segoe UI", 10F);
            ironAmount.Location = new Point(121, 135);
            ironAmount.Name = "ironAmount";
            ironAmount.Size = new Size(150, 30);
            ironAmount.TabIndex = 2;
            // 
            // diamondAmount
            // 
            diamondAmount.Font = new Font("Segoe UI", 10F);
            diamondAmount.Location = new Point(121, 183);
            diamondAmount.Name = "diamondAmount";
            diamondAmount.Size = new Size(150, 30);
            diamondAmount.TabIndex = 2;
            // 
            // button1
            // 
            button1.Font = new Font("Segoe UI Semibold", 10F, FontStyle.Bold);
            button1.Location = new Point(140, 246);
            button1.Name = "button1";
            button1.Size = new Size(102, 38);
            button1.TabIndex = 3;
            button1.Text = "FORGE";
            button1.UseVisualStyleBackColor = true;
            button1.Click += button1_Click;
            // 
            // Forge
            // 
            AutoScaleDimensions = new SizeF(8F, 20F);
            AutoScaleMode = AutoScaleMode.Font;
            ClientSize = new Size(382, 353);
            Controls.Add(button1);
            Controls.Add(diamondAmount);
            Controls.Add(ironAmount);
            Controls.Add(copperAmount);
            Controls.Add(label4);
            Controls.Add(label3);
            Controls.Add(label2);
            Controls.Add(label1);
            FormBorderStyle = FormBorderStyle.FixedSingle;
            MaximizeBox = false;
            Name = "Forge";
            Text = "Forge";
            ((System.ComponentModel.ISupportInitialize)copperAmount).EndInit();
            ((System.ComponentModel.ISupportInitialize)ironAmount).EndInit();
            ((System.ComponentModel.ISupportInitialize)diamondAmount).EndInit();
            ResumeLayout(false);
            PerformLayout();
        }

        #endregion

        private Label label1;
        private Label label2;
        private Label label3;
        private Label label4;
        private NumericUpDown copperAmount;
        private NumericUpDown ironAmount;
        private NumericUpDown diamondAmount;
        private Button button1;
    }
}