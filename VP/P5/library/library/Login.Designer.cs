namespace library
{
    partial class Login
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
            label2 = new Label();
            label3 = new Label();
            label4 = new Label();
            nameInput = new TextBox();
            passwordInput = new TextBox();
            loginBtn = new Button();
            label6 = new Label();
            openRegisterPagebtn = new Label();
            SuspendLayout();
            // 
            // label1
            // 
            label1.AutoSize = true;
            label1.Font = new Font("Segoe UI", 40F, FontStyle.Bold | FontStyle.Italic);
            label1.Location = new Point(260, 47);
            label1.Name = "label1";
            label1.Size = new Size(263, 89);
            label1.TabIndex = 0;
            label1.Text = "Library";
            // 
            // label2
            // 
            label2.AutoSize = true;
            label2.Font = new Font("Segoe UI", 20F, FontStyle.Bold);
            label2.Location = new Point(336, 136);
            label2.Name = "label2";
            label2.Size = new Size(110, 46);
            label2.TabIndex = 1;
            label2.Text = "Login";
            // 
            // label3
            // 
            label3.AutoSize = true;
            label3.Font = new Font("Segoe UI", 14F, FontStyle.Bold);
            label3.Location = new Point(190, 211);
            label3.Name = "label3";
            label3.Size = new Size(81, 32);
            label3.TabIndex = 1;
            label3.Text = "Name";
            // 
            // label4
            // 
            label4.AutoSize = true;
            label4.Font = new Font("Segoe UI", 14F, FontStyle.Bold);
            label4.Location = new Point(149, 274);
            label4.Name = "label4";
            label4.Size = new Size(122, 32);
            label4.TabIndex = 1;
            label4.Text = "Password";
            // 
            // nameInput
            // 
            nameInput.Font = new Font("Segoe UI", 12F);
            nameInput.Location = new Point(293, 209);
            nameInput.Name = "nameInput";
            nameInput.Size = new Size(242, 34);
            nameInput.TabIndex = 1;
            // 
            // passwordInput
            // 
            passwordInput.Font = new Font("Segoe UI", 12F);
            passwordInput.Location = new Point(293, 274);
            passwordInput.Name = "passwordInput";
            passwordInput.Size = new Size(242, 34);
            passwordInput.TabIndex = 2;
            // 
            // loginBtn
            // 
            loginBtn.Font = new Font("Segoe UI", 12F, FontStyle.Regular, GraphicsUnit.Point, 0);
            loginBtn.Location = new Point(317, 332);
            loginBtn.Name = "loginBtn";
            loginBtn.Size = new Size(149, 44);
            loginBtn.TabIndex = 3;
            loginBtn.Text = "Login";
            loginBtn.UseVisualStyleBackColor = true;
            loginBtn.Click += loginBtn_Click;
            // 
            // label6
            // 
            label6.AutoSize = true;
            label6.Font = new Font("Segoe UI", 10F);
            label6.Location = new Point(239, 401);
            label6.Name = "label6";
            label6.Size = new Size(239, 23);
            label6.TabIndex = 5;
            label6.Text = "Don't have an account? Go to";
            // 
            // openRegisterPagebtn
            // 
            openRegisterPagebtn.AutoSize = true;
            openRegisterPagebtn.Cursor = Cursors.Hand;
            openRegisterPagebtn.Font = new Font("Segoe UI", 10F, FontStyle.Underline);
            openRegisterPagebtn.ForeColor = Color.Cyan;
            openRegisterPagebtn.Location = new Point(473, 401);
            openRegisterPagebtn.Name = "openRegisterPagebtn";
            openRegisterPagebtn.Size = new Size(71, 23);
            openRegisterPagebtn.TabIndex = 4;
            openRegisterPagebtn.Text = "Register";
            openRegisterPagebtn.Click += openRegisterPagebtn_Click;
            // 
            // Login
            // 
            AutoScaleDimensions = new SizeF(8F, 20F);
            AutoScaleMode = AutoScaleMode.Font;
            BackColor = Color.Peru;
            ClientSize = new Size(782, 503);
            Controls.Add(openRegisterPagebtn);
            Controls.Add(label6);
            Controls.Add(loginBtn);
            Controls.Add(passwordInput);
            Controls.Add(nameInput);
            Controls.Add(label4);
            Controls.Add(label3);
            Controls.Add(label2);
            Controls.Add(label1);
            Font = new Font("Segoe UI", 9F, FontStyle.Regular, GraphicsUnit.Point, 0);
            FormBorderStyle = FormBorderStyle.FixedSingle;
            MaximizeBox = false;
            Name = "Login";
            StartPosition = FormStartPosition.CenterScreen;
            Text = "Login";
            ResumeLayout(false);
            PerformLayout();
        }

        #endregion

        private Label label1;
        private Label label2;
        private Label label3;
        private Label label4;
        private TextBox nameInput;
        private TextBox passwordInput;
        private Button loginBtn;
        private Label label6;
        private Label openRegisterPagebtn;
    }
}
