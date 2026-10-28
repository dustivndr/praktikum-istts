namespace library
{
    partial class Register
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
            registerBtn = new Button();
            passwordInput = new TextBox();
            nameInput = new TextBox();
            label4 = new Label();
            label3 = new Label();
            label2 = new Label();
            label1 = new Label();
            label5 = new Label();
            openLoginPagebtn = new Label();
            label6 = new Label();
            label8 = new Label();
            comboBox1 = new ComboBox();
            SuspendLayout();
            // 
            // registerBtn
            // 
            registerBtn.Font = new Font("Segoe UI", 12F, FontStyle.Regular, GraphicsUnit.Point, 0);
            registerBtn.Location = new Point(317, 368);
            registerBtn.Name = "registerBtn";
            registerBtn.Size = new Size(149, 44);
            registerBtn.TabIndex = 4;
            registerBtn.Text = "Register";
            registerBtn.UseVisualStyleBackColor = true;
            registerBtn.Click += registerBtn_Click;
            // 
            // passwordInput
            // 
            passwordInput.Font = new Font("Segoe UI", 12F);
            passwordInput.Location = new Point(299, 254);
            passwordInput.Name = "passwordInput";
            passwordInput.Size = new Size(242, 34);
            passwordInput.TabIndex = 2;
            // 
            // nameInput
            // 
            nameInput.Font = new Font("Segoe UI", 12F);
            nameInput.Location = new Point(299, 191);
            nameInput.Name = "nameInput";
            nameInput.Size = new Size(242, 34);
            nameInput.TabIndex = 1;
            // 
            // label4
            // 
            label4.AutoSize = true;
            label4.Font = new Font("Segoe UI", 14F, FontStyle.Bold);
            label4.Location = new Point(155, 254);
            label4.Name = "label4";
            label4.Size = new Size(122, 32);
            label4.TabIndex = 5;
            label4.Text = "Password";
            // 
            // label3
            // 
            label3.AutoSize = true;
            label3.Font = new Font("Segoe UI", 14F, FontStyle.Bold);
            label3.Location = new Point(196, 193);
            label3.Name = "label3";
            label3.Size = new Size(81, 32);
            label3.TabIndex = 6;
            label3.Text = "Name";
            // 
            // label2
            // 
            label2.AutoSize = true;
            label2.Font = new Font("Segoe UI", 20F, FontStyle.Bold);
            label2.Location = new Point(316, 106);
            label2.Name = "label2";
            label2.Size = new Size(150, 46);
            label2.TabIndex = 7;
            label2.Text = "Register";
            // 
            // label1
            // 
            label1.AutoSize = true;
            label1.Font = new Font("Segoe UI", 40F, FontStyle.Bold | FontStyle.Italic);
            label1.Location = new Point(250, 17);
            label1.Name = "label1";
            label1.Size = new Size(263, 89);
            label1.TabIndex = 4;
            label1.Text = "Library";
            // 
            // label5
            // 
            label5.AutoSize = true;
            label5.Font = new Font("Segoe UI", 40F, FontStyle.Bold | FontStyle.Italic);
            label5.Location = new Point(260, 17);
            label5.Name = "label5";
            label5.Size = new Size(263, 89);
            label5.TabIndex = 4;
            label5.Text = "Library";
            // 
            // openLoginPagebtn
            // 
            openLoginPagebtn.AutoSize = true;
            openLoginPagebtn.Cursor = Cursors.Hand;
            openLoginPagebtn.Font = new Font("Segoe UI", 10F, FontStyle.Underline);
            openLoginPagebtn.ForeColor = Color.Cyan;
            openLoginPagebtn.Location = new Point(489, 430);
            openLoginPagebtn.Name = "openLoginPagebtn";
            openLoginPagebtn.Size = new Size(52, 23);
            openLoginPagebtn.TabIndex = 5;
            openLoginPagebtn.Text = "Login";
            openLoginPagebtn.Click += openLoginPagebtn_Click;
            // 
            // label6
            // 
            label6.AutoSize = true;
            label6.Font = new Font("Segoe UI", 10F);
            label6.Location = new Point(241, 430);
            label6.Name = "label6";
            label6.Size = new Size(254, 23);
            label6.TabIndex = 11;
            label6.Text = "Already have an account? Go to";
            // 
            // label8
            // 
            label8.AutoSize = true;
            label8.Font = new Font("Segoe UI", 14F, FontStyle.Bold);
            label8.Location = new Point(235, 317);
            label8.Name = "label8";
            label8.Size = new Size(42, 32);
            label8.TabIndex = 5;
            label8.Text = "As";
            // 
            // comboBox1
            // 
            comboBox1.DropDownStyle = ComboBoxStyle.DropDownList;
            comboBox1.Font = new Font("Segoe UI", 12F);
            comboBox1.FormattingEnabled = true;
            comboBox1.Items.AddRange(new object[] { "Patron", "Librarian" });
            comboBox1.Location = new Point(299, 313);
            comboBox1.Name = "comboBox1";
            comboBox1.Size = new Size(242, 36);
            comboBox1.TabIndex = 3;
            // 
            // Register
            // 
            AutoScaleDimensions = new SizeF(8F, 20F);
            AutoScaleMode = AutoScaleMode.Font;
            BackColor = Color.Peru;
            ClientSize = new Size(782, 503);
            Controls.Add(comboBox1);
            Controls.Add(openLoginPagebtn);
            Controls.Add(label6);
            Controls.Add(registerBtn);
            Controls.Add(passwordInput);
            Controls.Add(label8);
            Controls.Add(nameInput);
            Controls.Add(label4);
            Controls.Add(label3);
            Controls.Add(label2);
            Controls.Add(label5);
            Controls.Add(label1);
            MaximizeBox = false;
            Name = "Register";
            StartPosition = FormStartPosition.CenterScreen;
            Text = "Register";
            FormClosed += Register_FormClosed;
            ResumeLayout(false);
            PerformLayout();
        }

        #endregion

        private Button registerBtn;
        private TextBox passwordInput;
        private TextBox nameInput;
        private Label label4;
        private Label label3;
        private Label label2;
        private Label label1;
        private Label label5;
        private Label openLoginPagebtn;
        private Label label6;
        private Label label8;
        private ComboBox comboBox1;
    }
}