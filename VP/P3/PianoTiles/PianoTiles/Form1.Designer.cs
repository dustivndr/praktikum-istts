namespace PianoTiles
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
            panel2 = new Panel();
            panel3 = new Panel();
            panel4 = new Panel();
            button1 = new Button();
            button2 = new Button();
            button3 = new Button();
            button4 = new Button();
            button5 = new Button();
            SuspendLayout();
            // 
            // panel1
            // 
            panel1.BackColor = SystemColors.ActiveCaption;
            panel1.BorderStyle = BorderStyle.FixedSingle;
            panel1.ForeColor = Color.Black;
            panel1.Location = new Point(2, 1);
            panel1.Name = "panel1";
            panel1.Size = new Size(106, 413);
            panel1.TabIndex = 0;
            // 
            // panel2
            // 
            panel2.BackColor = SystemColors.ActiveCaption;
            panel2.BorderStyle = BorderStyle.FixedSingle;
            panel2.ForeColor = Color.Black;
            panel2.Location = new Point(107, 1);
            panel2.Name = "panel2";
            panel2.Size = new Size(113, 409);
            panel2.TabIndex = 1;
            // 
            // panel3
            // 
            panel3.BackColor = SystemColors.ActiveCaption;
            panel3.BorderStyle = BorderStyle.FixedSingle;
            panel3.ForeColor = Color.Black;
            panel3.Location = new Point(217, 1);
            panel3.Name = "panel3";
            panel3.Size = new Size(114, 405);
            panel3.TabIndex = 2;
            // 
            // panel4
            // 
            panel4.BackColor = SystemColors.ActiveCaption;
            panel4.BorderStyle = BorderStyle.FixedSingle;
            panel4.ForeColor = Color.Black;
            panel4.Location = new Point(328, 1);
            panel4.Name = "panel4";
            panel4.Size = new Size(114, 401);
            panel4.TabIndex = 3;
            // 
            // button1
            // 
            button1.BackColor = SystemColors.ActiveCaption;
            button1.FlatAppearance.BorderColor = Color.Black;
            button1.Location = new Point(2, 452);
            button1.Name = "button1";
            button1.Size = new Size(106, 124);
            button1.TabIndex = 0;
            button1.TabStop = false;
            button1.Text = "D";
            button1.UseVisualStyleBackColor = false;
            // 
            // button2
            // 
            button2.BackColor = SystemColors.ActiveCaption;
            button2.Location = new Point(101, 452);
            button2.Name = "button2";
            button2.Size = new Size(119, 124);
            button2.TabIndex = 0;
            button2.TabStop = false;
            button2.Text = "F";
            button2.UseVisualStyleBackColor = false;
            // 
            // button3
            // 
            button3.BackColor = SystemColors.ActiveCaption;
            button3.Location = new Point(217, 452);
            button3.Name = "button3";
            button3.Size = new Size(114, 124);
            button3.TabIndex = 0;
            button3.TabStop = false;
            button3.Text = "J";
            button3.UseVisualStyleBackColor = false;
            // 
            // button4
            // 
            button4.BackColor = SystemColors.ActiveCaption;
            button4.Location = new Point(328, 452);
            button4.Name = "button4";
            button4.Size = new Size(114, 124);
            button4.TabIndex = 0;
            button4.TabStop = false;
            button4.Text = "K";
            button4.UseVisualStyleBackColor = false;
            // 
            // button5
            // 
            button5.BackColor = SystemColors.ActiveCaption;
            button5.Location = new Point(2, 393);
            button5.Name = "button5";
            button5.Size = new Size(440, 68);
            button5.TabIndex = 1;
            button5.TabStop = false;
            button5.Text = "Score: ";
            button5.UseVisualStyleBackColor = false;
            // 
            // Form1
            // 
            AutoScaleMode = AutoScaleMode.None;
            BackColor = Color.Black;
            ClientSize = new Size(442, 576);
            Controls.Add(button4);
            Controls.Add(button3);
            Controls.Add(button2);
            Controls.Add(button1);
            Controls.Add(button5);
            Controls.Add(panel4);
            Controls.Add(panel3);
            Controls.Add(panel2);
            Controls.Add(panel1);
            FormBorderStyle = FormBorderStyle.FixedSingle;
            KeyPreview = true;
            Name = "Form1";
            Text = "Piano Tiles";
            ResumeLayout(false);
        }

        #endregion

        private Panel panel1;
        private Panel panel2;
        private Panel panel3;
        private Panel panel4;
        private Button button1;
        private Button button2;
        private Button button3;
        private Button button4;
        private Button button5;
    }
}
