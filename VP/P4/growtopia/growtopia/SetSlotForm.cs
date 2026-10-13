using System;
using System.Collections.Generic;
using System.ComponentModel;
using System.Data;
using System.Drawing;
using System.Text;
using System.Windows.Forms;

namespace growtopia
{
    public partial class SetSlotForm : Form
    {
        public int SelectedSlot { get; private set; }
        private NumericUpDown numSlot;

        public SetSlotForm()
        {
            this.Text = "Set Slot (1-3)";
            this.Size = new Size(250, 140);
            this.StartPosition = FormStartPosition.CenterParent;
            this.FormBorderStyle = FormBorderStyle.FixedDialog;
            this.MaximizeBox = false;
            this.MinimizeBox = false;

            numSlot = new NumericUpDown
            {
                Minimum = 1,
                Maximum = 3,
                Value = 1,
                Location = new Point(20, 20),
                Width = 195
            };
            this.Controls.Add(numSlot);

            Button btnOk = new Button
            {
                Text = "OK",
                Location = new Point(20, 60),
                Size = new Size(75, 25),
                DialogResult = DialogResult.OK
            };
            btnOk.Click += (s, e) => { SelectedSlot = (int)numSlot.Value; };
            this.Controls.Add(btnOk);

            Button btnCancel = new Button
            {
                Text = "Cancel",
                Location = new Point(140, 60),
                Size = new Size(75, 25),
                DialogResult = DialogResult.Cancel
            };
            this.Controls.Add(btnCancel);

            this.AcceptButton = btnOk;
            this.CancelButton = btnCancel;
        }
    }
}
