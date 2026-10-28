namespace library
{
    partial class BookCatalog
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
            bookNameInput = new TextBox();
            genreCB = new ComboBox();
            languageCB = new ComboBox();
            label3 = new Label();
            label4 = new Label();
            searchBtn = new Button();
            clearBtn = new Button();
            backBtn = new Button();
            dataGridView1 = new DataGridView();
            ((System.ComponentModel.ISupportInitialize)dataGridView1).BeginInit();
            SuspendLayout();
            // 
            // label1
            // 
            label1.AutoSize = true;
            label1.Font = new Font("Segoe UI", 16F, FontStyle.Bold);
            label1.Location = new Point(10, 6);
            label1.Name = "label1";
            label1.Size = new Size(190, 37);
            label1.TabIndex = 0;
            label1.Text = "Book Catalog";
            // 
            // label2
            // 
            label2.AutoSize = true;
            label2.Font = new Font("Segoe UI", 12F, FontStyle.Bold, GraphicsUnit.Point, 0);
            label2.Location = new Point(12, 51);
            label2.Name = "label2";
            label2.Size = new Size(127, 28);
            label2.TabIndex = 1;
            label2.Text = "Book Name:";
            // 
            // bookNameInput
            // 
            bookNameInput.Font = new Font("Segoe UI", 10F);
            bookNameInput.Location = new Point(12, 82);
            bookNameInput.Name = "bookNameInput";
            bookNameInput.Size = new Size(220, 30);
            bookNameInput.TabIndex = 2;
            // 
            // genreCB
            // 
            genreCB.DropDownStyle = ComboBoxStyle.DropDownList;
            genreCB.Font = new Font("Segoe UI", 10F);
            genreCB.FormattingEnabled = true;
            genreCB.Location = new Point(283, 81);
            genreCB.Name = "genreCB";
            genreCB.Size = new Size(220, 31);
            genreCB.TabIndex = 3;
            // 
            // languageCB
            // 
            languageCB.DropDownStyle = ComboBoxStyle.DropDownList;
            languageCB.Font = new Font("Segoe UI", 10F);
            languageCB.FormattingEnabled = true;
            languageCB.Location = new Point(550, 81);
            languageCB.Name = "languageCB";
            languageCB.Size = new Size(220, 31);
            languageCB.TabIndex = 3;
            // 
            // label3
            // 
            label3.AutoSize = true;
            label3.Font = new Font("Segoe UI", 12F, FontStyle.Bold, GraphicsUnit.Point, 0);
            label3.Location = new Point(283, 51);
            label3.Name = "label3";
            label3.Size = new Size(73, 28);
            label3.TabIndex = 1;
            label3.Text = "Genre:";
            // 
            // label4
            // 
            label4.AutoSize = true;
            label4.Font = new Font("Segoe UI", 12F, FontStyle.Bold, GraphicsUnit.Point, 0);
            label4.Location = new Point(550, 50);
            label4.Name = "label4";
            label4.Size = new Size(108, 28);
            label4.TabIndex = 1;
            label4.Text = "Language:";
            // 
            // searchBtn
            // 
            searchBtn.Location = new Point(12, 132);
            searchBtn.Name = "searchBtn";
            searchBtn.Size = new Size(94, 29);
            searchBtn.TabIndex = 4;
            searchBtn.Text = "Search";
            searchBtn.UseVisualStyleBackColor = true;
            searchBtn.Click += SearchBtn_Click;
            // 
            // clearBtn
            // 
            clearBtn.Location = new Point(121, 132);
            clearBtn.Name = "clearBtn";
            clearBtn.Size = new Size(94, 29);
            clearBtn.TabIndex = 4;
            clearBtn.Text = "Clear";
            clearBtn.UseVisualStyleBackColor = true;
            clearBtn.Click += ClearBtn_Click;
            // 
            // backBtn
            // 
            backBtn.Location = new Point(231, 132);
            backBtn.Name = "backBtn";
            backBtn.Size = new Size(94, 29);
            backBtn.TabIndex = 4;
            backBtn.Text = "Back";
            backBtn.UseVisualStyleBackColor = true;
            backBtn.Click += backBtn_Click;
            // 
            // dataGridView1
            // 
            dataGridView1.ColumnHeadersHeightSizeMode = DataGridViewColumnHeadersHeightSizeMode.AutoSize;
            dataGridView1.Location = new Point(10, 192);
            dataGridView1.Name = "dataGridView1";
            dataGridView1.RowHeadersWidth = 51;
            dataGridView1.Size = new Size(760, 299);
            dataGridView1.TabIndex = 5;
            // 
            // BookCatalog
            // 
            AutoScaleDimensions = new SizeF(8F, 20F);
            AutoScaleMode = AutoScaleMode.Font;
            BackColor = Color.Peru;
            ClientSize = new Size(782, 503);
            Controls.Add(dataGridView1);
            Controls.Add(backBtn);
            Controls.Add(clearBtn);
            Controls.Add(searchBtn);
            Controls.Add(languageCB);
            Controls.Add(genreCB);
            Controls.Add(bookNameInput);
            Controls.Add(label4);
            Controls.Add(label3);
            Controls.Add(label2);
            Controls.Add(label1);
            MaximizeBox = false;
            Name = "BookCatalog";
            Text = "Book Catalog";
            FormClosed += BookCatalog_FormClosed;
            Load += BookCatalog_Load;
            ((System.ComponentModel.ISupportInitialize)dataGridView1).EndInit();
            ResumeLayout(false);
            PerformLayout();
        }

        #endregion

        private Label label1;
        private Label label2;
        private TextBox bookNameInput;
        private ComboBox genreCB;
        private ComboBox languageCB;
        private Label label3;
        private Label label4;
        private Button searchBtn;
        private Button clearBtn;
        private Button backBtn;
        private DataGridView dataGridView1;
    }
}