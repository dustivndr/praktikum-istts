namespace bank7
{
    partial class Transfer
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
            textBox1 = new TextBox();
            buttonTransfer = new Button();
            buttonCancel = new Button();
            labelError = new Label();
            SuspendLayout();
            // 
            // label1
            // 
            label1.AutoSize = true;
            label1.Font = new Font("Segoe UI", 16.2F, FontStyle.Bold, GraphicsUnit.Point, 0);
            label1.Location = new Point(34, 26);
            label1.Name = "label1";
            label1.Size = new Size(239, 38);
            label1.TabIndex = 0;
            label1.Text = "Transfer Amount";
            // 
            // label2
            // 
            label2.AutoSize = true;
            label2.Font = new Font("Segoe UI", 10.8F, FontStyle.Regular, GraphicsUnit.Point, 0);
            label2.Location = new Point(45, 103);
            label2.Name = "label2";
            label2.Size = new Size(81, 25);
            label2.TabIndex = 1;
            label2.Text = "Amount:";
            // 
            // textBox1
            // 
            textBox1.Font = new Font("Segoe UI", 11F);
            textBox1.Location = new Point(45, 142);
            textBox1.Name = "textBox1";
            textBox1.Size = new Size(442, 32);
            textBox1.TabIndex = 2;
            // 
            // buttonTransfer
            // 
            buttonTransfer.Font = new Font("Segoe UI", 11F);
            buttonTransfer.Location = new Point(45, 191);
            buttonTransfer.Name = "buttonTransfer";
            buttonTransfer.Size = new Size(206, 37);
            buttonTransfer.TabIndex = 3;
            buttonTransfer.Text = "Transfer";
            buttonTransfer.UseVisualStyleBackColor = true;
            buttonTransfer.Click += buttonTransfer_Click;
            // 
            // buttonCancel
            // 
            buttonCancel.Font = new Font("Segoe UI", 11F);
            buttonCancel.Location = new Point(281, 191);
            buttonCancel.Name = "buttonCancel";
            buttonCancel.Size = new Size(206, 37);
            buttonCancel.TabIndex = 3;
            buttonCancel.Text = "Cancel";
            buttonCancel.UseVisualStyleBackColor = true;
            buttonCancel.Click += buttonCancel_Click;
            // 
            // labelError
            // 
            labelError.AutoSize = true;
            labelError.ForeColor = Color.Red;
            labelError.Location = new Point(45, 246);
            labelError.Name = "labelError";
            labelError.Size = new Size(74, 20);
            labelError.TabIndex = 4;
            labelError.Text = "labelError";
            // 
            // Transfer
            // 
            AutoScaleDimensions = new SizeF(8F, 20F);
            AutoScaleMode = AutoScaleMode.Font;
            ClientSize = new Size(532, 333);
            Controls.Add(labelError);
            Controls.Add(buttonCancel);
            Controls.Add(buttonTransfer);
            Controls.Add(textBox1);
            Controls.Add(label2);
            Controls.Add(label1);
            MaximizeBox = false;
            Name = "Transfer";
            StartPosition = FormStartPosition.CenterScreen;
            Text = "Transfer Amount";
            Load += Transfer_Load;
            ResumeLayout(false);
            PerformLayout();
        }

        #endregion

        private Label label1;
        private Label label2;
        private TextBox textBox1;
        private Button buttonTransfer;
        private Button buttonCancel;
        private Label labelError;
    }
}