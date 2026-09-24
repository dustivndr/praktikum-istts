using System.IO;

namespace WarungKue
{
    public partial class Form1 : Form
    {
        public Form1()
        {
            InitializeComponent();
            RandomMenu();

            cbBahanUtama.SelectedIndexChanged += cbBahanUtama_SelectedIndexChanged;
            cbRasa1.SelectedIndexChanged += cbRasa1_SelectedIndexChanged;
            cbRasa2.SelectedIndexChanged += cbRasa2_SelectedIndexChanged;
            this.FormClosing += Form1_FormClosing;
        }

        Random random = new Random();
        int totalRoti, totalKue, totalCoklat, totalKeju;
        int menu, money;
        int day = 1;
        int target = 100000;
        int reward = 0;
        bool autoFillUsed = false;
        int prevBahanIndex = -1;
        int prevRasa1Index = -1;
        int prevRasa2Index = -1;

        public void UpdateGudang()
        {
            gudangRoti.Text = "Roti: " + totalRoti;
            gudangKue.Text = "Kue: " + totalKue;
            gudangCoklat.Text = "Coklat: " + totalCoklat;
            gudangKeju.Text = "Keju: " + totalKeju;
        }

        public void RandomMenu()
        {
            menu = random.Next(0, 10);
            switch (menu)
            {
                case 0:
                    labelPesanan.Text = "Roti Plain";
                    break;
                case 1:
                    labelPesanan.Text = "Roti Coklat";
                    break;
                case 2:
                    labelPesanan.Text = "Roti Keju";
                    break;
                case 3:
                    labelPesanan.Text = "Roti Coklat + Keju";
                    break;
                case 4:
                    labelPesanan.Text = "Roti Keju + Coklat";
                    break;
                case 5:
                    labelPesanan.Text = "Kue Plain";
                    break;
                case 6:
                    labelPesanan.Text = "Kue Coklat";
                    break;
                case 7:
                    labelPesanan.Text = "Kue Keju";
                    break;
                case 8:
                    labelPesanan.Text = "Kue Coklat + Keju";
                    break;
                case 9:
                    labelPesanan.Text = "Kue Keju + Coklat";
                    break;
            }
        }

        public void ResetComboBox()
        {
            prevBahanIndex = -1;
            prevRasa1Index = -1;
            prevRasa2Index = -1;

            autoFillUsed = false;

            cbBahanUtama.SelectedIndex = -1;
            cbRasa1.SelectedIndex = -1;
            cbRasa2.SelectedIndex = -1;
            cbBahanUtama.Enabled = true;
            cbRasa1.Enabled = true;
            cbRasa2.Enabled = true;

            UpdateGudang();
        }

        public void UpdateMoney()
        {
            while (money >= target)
            {
                money -= target;
                day += 1;
                target += 100000;
            }

            targetPenjualanCounter.Text =
                "Target Penjualan:\n" +
                "Rp" + money + " / Rp " + target;

            labelDayCount.Text = "Day " + day;

            if (progressBar1 != null)
            {
                int max = progressBar1.Maximum > 0 ? progressBar1.Maximum : 100;
                double pct = target > 0 ? (double)money / target : 0.0;
                int val = (int)Math.Round(pct * max);
                progressBar1.Value = Math.Max(0, Math.Min(max, val));
            }
        }

        private void newGame_Click(object sender, EventArgs e)
        {
            panelMainMenu.Visible = false;
            totalRoti = 3;
            totalKue = 3;
            totalCoklat = 3;
            totalKeju = 3;

            day = 1;
            target = 100000;
            money = 0;
            progressBar1.Value = 0;
            UpdateGudang();
            UpdateMoney();
        }

        private void continueGame_Click(object sender, EventArgs e)
        {
            if (LoadGame())
            {
                panelMainMenu.Visible = false;
            }
            else
            {
                MessageBox.Show("Tidak ada save yang ditemukan.", "Info", MessageBoxButtons.OK, MessageBoxIcon.Information);
            }

        }

        private void simpanGameToolStripMenuItem_Click(object sender, EventArgs e)
        {
            SaveGame();
        }

        private void SaveGame()
        {
            try
            {
                var path = Path.Combine(AppDomain.CurrentDomain.BaseDirectory, "save.txt");
                using (var sw = new StreamWriter(path, false))
                {
                    sw.WriteLine($"totalRoti={totalRoti}");
                    sw.WriteLine($"totalKue={totalKue}");
                    sw.WriteLine($"totalCoklat={totalCoklat}");
                    sw.WriteLine($"totalKeju={totalKeju}");
                    sw.WriteLine($"day={day}");
                    sw.WriteLine($"target={target}");
                    sw.WriteLine($"money={money}");
                    sw.WriteLine($"progress={progressBar1.Value}");
                    sw.WriteLine($"menu={menu}");
                }

                MessageBox.Show("Game disimpan ke save.txt", "Sukses", MessageBoxButtons.OK, MessageBoxIcon.Information);
            }
            catch (Exception ex)
            {
                MessageBox.Show("Gagal menyimpan: " + ex.Message, "Error", MessageBoxButtons.OK, MessageBoxIcon.Error);
            }
        }

        private bool LoadGame()
        {
            try
            {
                var path = Path.Combine(AppDomain.CurrentDomain.BaseDirectory, "save.txt");
                if (!File.Exists(path)) return false;

                var lines = File.ReadAllLines(path);
                foreach (var line in lines)
                {
                    if (string.IsNullOrWhiteSpace(line)) continue;
                    var parts = line.Split('=', 2);
                    if (parts.Length != 2) continue;
                    var key = parts[0].Trim();
                    var val = parts[1].Trim();
                    int v;
                    int.TryParse(val, out v);
                    switch (key)
                    {
                        case "totalRoti": totalRoti = v; break;
                        case "totalKue": totalKue = v; break;
                        case "totalCoklat": totalCoklat = v; break;
                        case "totalKeju": totalKeju = v; break;
                        case "day": day = v; break;
                        case "target": target = v; break;
                        case "money": money = v; break;
                        case "progress": progressBar1.Value = Math.Max(0, Math.Min(progressBar1.Maximum, v)); break;
                        case "menu": menu = v; break;
                    }
                }

                UpdateGudang();
                UpdateMoney();
                RandomMenu();
                return true;
            }
            catch (Exception ex)
            {
                MessageBox.Show("Gagal memuat save: " + ex.Message, "Error", MessageBoxButtons.OK, MessageBoxIcon.Error);
                return false;
            }
        }

        private void exitGame_Click(object sender, EventArgs e)
        {
            this.Close();
        }

        private void Form1_FormClosing(object? sender, FormClosingEventArgs e)
        {
            SaveGame();
        }

        private void tunjukResepToolStripMenuItem_Click(object sender, EventArgs e)
        {
            MessageBox.Show("" +
                "Roti Coklat = Roti + Coklat\n" +
                "Roti Keju = Roti + Keju\n" +
                "Roti Coklat Keju = Roti + Coklat + Keju\n" +
                "Kue Coklat = Kue + Coklat\n" +
                "Kue Keju = Kue + Keju\n" +
                "Kue Coklat Keju = Kue + Coklat + Keju",
                "Resep",
                MessageBoxButtons.OK,
                MessageBoxIcon.Information
            );
        }

        private void addRoti_Click(object sender, EventArgs e)
        {
            if (money >= 2000)
            {
                money -= 2000;
                progressBar1.Value -= 2;
                totalRoti += 1;
                UpdateGudang();
                UpdateMoney();
            }
            else
            {
                MessageBox.Show("Uang tidak cukup!", "Warning", MessageBoxButtons.OK, MessageBoxIcon.Warning);
                return;
            }
        }

        private void addKue_Click(object sender, EventArgs e)
        {
            if (money >= 3000)
            {
                money -= 3000;
                progressBar1.Value -= 3;
                totalKue += 1;
                UpdateGudang();
                UpdateMoney();
            }
            else
            {
                MessageBox.Show("Uang tidak cukup!", "Warning", MessageBoxButtons.OK, MessageBoxIcon.Warning);
                return;
            }
        }

        private void addCoklat_Click(object sender, EventArgs e)
        {
            if (money >= 5000)
            {
                money -= 5000;
                progressBar1.Value -= 5;
                totalCoklat += 1;
                UpdateGudang();
                UpdateMoney();
            }
            else
            {
                MessageBox.Show("Uang tidak cukup!", "Warning", MessageBoxButtons.OK, MessageBoxIcon.Warning);
                return;
            }
        }

        private void addKeju_Click(object sender, EventArgs e)
        {
            if (money >= 5000)
            {
                money -= 5000;
                progressBar1.Value -= 5;
                totalKeju += 1;
                UpdateGudang();
                UpdateMoney();
            }
            else
            {
                MessageBox.Show("Uang tidak cukup!", "Warning", MessageBoxButtons.OK, MessageBoxIcon.Warning);
                return;
            }
        }

        private void cbRasa1_DropDown(object sender, EventArgs e)
        {
            if (cbBahanUtama.SelectedIndex == -1)
            {
                MessageBox.Show("Pilih bahan utama terlebih dahulu!", "Warning", MessageBoxButtons.OK, MessageBoxIcon.Warning);
                cbRasa1.DroppedDown = false;
                return;
            }
        }

        private void cbRasa2_DropDown(object sender, EventArgs e)
        {
            if (cbBahanUtama.SelectedIndex == -1)
            {
                MessageBox.Show("Pilih bahan utama terlebih dahulu!", "Warning", MessageBoxButtons.OK, MessageBoxIcon.Warning);
                cbRasa2.DroppedDown = false;
                return;
            }
        }

        private void cbBahanUtama_SelectedIndexChanged(object? sender, EventArgs e)
        {
            int idx = cbBahanUtama.SelectedIndex;
            if (idx == -1) return;

            if (prevBahanIndex != -1 && prevBahanIndex != idx)
            {
                if (prevBahanIndex == 0) totalRoti += 1;
                else if (prevBahanIndex == 1) totalKue += 1;
            }

            if (idx == 0)
            {
                if (totalRoti <= 0)
                {
                    MessageBox.Show("Stok roti habis!", "Warning", MessageBoxButtons.OK, MessageBoxIcon.Warning);
                    cbBahanUtama.SelectedIndex = prevBahanIndex;
                    return;
                }
                totalRoti -= 1;
            }
            else if (idx == 1)
            {
                if (totalKue <= 0)
                {
                    MessageBox.Show("Stok kue habis!", "Warning", MessageBoxButtons.OK, MessageBoxIcon.Warning);
                    cbBahanUtama.SelectedIndex = prevBahanIndex;
                    return;
                }
                totalKue -= 1;
            }

            prevBahanIndex = idx;
            UpdateGudang();
        }

        private void cbRasa1_SelectedIndexChanged(object? sender, EventArgs e)
        {
            int idx = cbRasa1.SelectedIndex;
            if (idx == -1) return;

            if (prevBahanIndex == -1)
            {
                MessageBox.Show("Pilih bahan utama terlebih dahulu!", "Warning", MessageBoxButtons.OK, MessageBoxIcon.Warning);
                cbRasa1.SelectedIndex = -1;
                return;
            }

            if (prevRasa1Index != -1 && prevRasa1Index != idx)
            {
                if (prevRasa1Index == 0) totalCoklat += 1;
                else if (prevRasa1Index == 1) totalKeju += 1;
            }

            if (idx == 0)
            {
                if (totalCoklat <= 0)
                {
                    MessageBox.Show("Stok coklat habis!", "Warning", MessageBoxButtons.OK, MessageBoxIcon.Warning);
                    cbRasa1.SelectedIndex = prevRasa1Index;
                    return;
                }
                totalCoklat -= 1;
            }
            else if (idx == 1)
            {
                if (totalKeju <= 0)
                {
                    MessageBox.Show("Stok keju habis!", "Warning", MessageBoxButtons.OK, MessageBoxIcon.Warning);
                    cbRasa1.SelectedIndex = prevRasa1Index;
                    return;
                }
                totalKeju -= 1;
            }

            prevRasa1Index = idx;
            cbBahanUtama.Enabled = false;
            cbRasa1.Enabled = false;
            UpdateGudang();
        }

        private void cbRasa2_SelectedIndexChanged(object? sender, EventArgs e)
        {
            int idx = cbRasa2.SelectedIndex;
            if (idx == -1) return;

            if (prevRasa2Index != -1 && prevRasa2Index != idx)
            {
                if (prevRasa2Index == 0) totalCoklat += 1;
                else if (prevRasa2Index == 1) totalKeju += 1;
            }

            if (idx == 0)
            {
                if (totalCoklat <= 0)
                {
                    MessageBox.Show("Stok coklat habis!", "Warning", MessageBoxButtons.OK, MessageBoxIcon.Warning);
                    cbRasa2.SelectedIndex = prevRasa2Index;
                    return;
                }
                totalCoklat -= 1;
            }
            else if (idx == 1)
            {
                if (totalKeju <= 0)
                {
                    MessageBox.Show("Stok keju habis!", "Warning", MessageBoxButtons.OK, MessageBoxIcon.Warning);
                    cbRasa2.SelectedIndex = prevRasa2Index;
                    return;
                }
                totalKeju -= 1;
            }

            prevRasa2Index = idx;
            cbRasa2.Enabled = false;
            UpdateGudang();
        }

        private void kirimPesanan_Click(object sender, EventArgs e)
        {
            switch (menu)
            {
                case 0: // Roti Plain
                    if (
                        cbBahanUtama.SelectedIndex == 0 &&
                        cbRasa1.SelectedIndex == -1 &&
                        cbRasa2.SelectedIndex == -1
                        )
                    {
                        reward = 6000;
                        if (autoFillUsed) reward = reward / 2;
                        money += reward;
                        RandomMenu();
                        UpdateMoney();
                        ResetComboBox();
                    }
                    else
                    {
                        ResetComboBox();
                        RandomMenu();
                    }
                    break;
                case 1: // Roti Coklat
                    if (
                        cbBahanUtama.SelectedIndex == 0 &&
                        cbRasa1.SelectedIndex == 0 &&
                        cbRasa2.SelectedIndex == -1
                        )
                    {
                        reward = 6000 + 8000;
                        if (autoFillUsed) reward = reward / 2;
                        money += reward;
                        RandomMenu();
                        UpdateMoney();
                        ResetComboBox();
                    }
                    else
                    {
                        ResetComboBox();
                        RandomMenu();
                    }
                    break;
                case 2: // Roti Keju
                    if (
                        cbBahanUtama.SelectedIndex == 0 &&
                        cbRasa1.SelectedIndex == 1 &&
                        cbRasa2.SelectedIndex == -1
                        )
                    {
                        reward = 6000 + 8000;
                        if (autoFillUsed) reward = reward / 2;
                        money += reward;
                        RandomMenu();
                        UpdateMoney();
                        ResetComboBox();
                    }
                    else
                    {
                        ResetComboBox();
                        RandomMenu();
                    }
                    break;
                case 3: // Roti Coklat + Keju
                    if (
                        cbBahanUtama.SelectedIndex == 0 &&
                        cbRasa1.SelectedIndex == 0 &&
                        cbRasa2.SelectedIndex == 1
                        )
                    {
                        reward = 6000 + 16000;
                        if (autoFillUsed) reward = reward / 2;
                        money += reward;
                        RandomMenu();
                        UpdateMoney();
                        ResetComboBox();
                    }
                    else
                    {
                        ResetComboBox();
                        RandomMenu();
                    }
                    break;
                case 4: // Roti Keju + Coklat
                    if (
                        cbBahanUtama.SelectedIndex == 0 &&
                        cbRasa1.SelectedIndex == 1 &&
                        cbRasa2.SelectedIndex == 0
                        )
                    {
                        reward = 6000 + 16000;
                        if (autoFillUsed) reward = reward / 2;
                        money += reward;
                        RandomMenu();
                        UpdateMoney();
                        ResetComboBox();
                    }
                    else
                    {
                        ResetComboBox();
                        RandomMenu();
                    }
                    break;
                case 5: // Kue Plain
                    if (
                        cbBahanUtama.SelectedIndex == 1 &&
                        cbRasa1.SelectedIndex == -1 &&
                        cbRasa2.SelectedIndex == -1
                        )
                    {
                        reward = 6000;
                        if (autoFillUsed) reward = reward / 2;
                        money += reward;
                        RandomMenu();
                        UpdateMoney();
                        ResetComboBox();
                    }
                    else
                    {
                        ResetComboBox();
                        RandomMenu();
                    }
                    break;
                case 6: // Kue Coklat
                    if (
                        cbBahanUtama.SelectedIndex == 1 &&
                        cbRasa1.SelectedIndex == 0 &&
                        cbRasa2.SelectedIndex == -1
                        )
                    {
                        reward = 6000 + 8000;
                        if (autoFillUsed) reward = reward / 2;
                        money += reward;
                        RandomMenu();
                        UpdateMoney();
                        ResetComboBox();
                    }
                    else
                    {
                        ResetComboBox();
                        RandomMenu();
                    }
                    break;
                case 7: // Kue Keju
                    if (
                        cbBahanUtama.SelectedIndex == 1 &&
                        cbRasa1.SelectedIndex == 1 &&
                        cbRasa2.SelectedIndex == -1
                        )
                    {
                        reward = 6000 + 8000;
                        if (autoFillUsed) reward = reward / 2;
                        money += reward;
                        RandomMenu();
                        UpdateMoney();
                        ResetComboBox();
                    }
                    else
                    {
                        ResetComboBox();
                        RandomMenu();
                    }
                    break;
                case 8: // Kue Coklat + Keju
                    if (
                        cbBahanUtama.SelectedIndex == 1 &&
                        cbRasa1.SelectedIndex == 0 &&
                        cbRasa2.SelectedIndex == 1
                        )
                    {
                        reward = 6000 + 16000;
                        if (autoFillUsed) reward = reward / 2;
                        money += reward;
                        RandomMenu();
                        UpdateMoney();
                        ResetComboBox();
                    }
                    else
                    {
                        ResetComboBox();
                        RandomMenu();
                    }
                    break;
                case 9: // Kue Keju + Coklat
                    if (
                        cbBahanUtama.SelectedIndex == 1 &&
                        cbRasa1.SelectedIndex == 1 &&
                        cbRasa2.SelectedIndex == 0
                        )
                    {
                        reward = 6000 + 16000;
                        if (autoFillUsed) reward = reward / 2;
                        money += reward;
                        progressBar1.Value += 22;
                        RandomMenu();
                        UpdateMoney();
                        ResetComboBox();
                    }
                    else
                    {
                        ResetComboBox();
                        RandomMenu();
                    }
                    break;
                default:
                    //MessageBox.Show("Pesanan tidak sesuai!", "Warning", MessageBoxButtons.OK, MessageBoxIcon.Warning);
                    break;
            }
        }

        private void buangItems_Click(object sender, EventArgs e)
        {
            ResetComboBox();
        }

        private void autoFillpenalty50ToolStripMenuItem_Click(object? sender, EventArgs e)
        {
            int b = -1, r1 = -1, r2 = -1;
            switch (menu)
            {
                case 0: // Roti Plain
                    b = 0; break;
                case 1: // Roti Coklat
                    b = 0; r1 = 0; break;
                case 2: // Roti Keju
                    b = 0; r1 = 1; break;
                case 3: // Roti Coklat + Keju
                    b = 0; r1 = 0; r2 = 1; break;
                case 4: // Roti Keju + Coklat
                    b = 0; r1 = 1; r2 = 0; break;
                case 5: // Kue Plain
                    b = 1; break;
                case 6: // Kue Coklat
                    b = 1; r1 = 0; break;
                case 7: // Kue Keju
                    b = 1; r1 = 1; break;
                case 8: // Kue Coklat + Keju
                    b = 1; r1 = 0; r2 = 1; break;
                case 9: // Kue Keju + Coklat
                    b = 1; r1 = 1; r2 = 0; break;
            }

            if (b == 0 && totalRoti <= 0) { MessageBox.Show("Stok roti habis!", "Warning", MessageBoxButtons.OK, MessageBoxIcon.Warning); return; }
            if (b == 1 && totalKue <= 0) { MessageBox.Show("Stok kue habis!", "Warning", MessageBoxButtons.OK, MessageBoxIcon.Warning); return; }
            if (r1 == 0 && totalCoklat <= 0) { MessageBox.Show("Stok coklat habis!", "Warning", MessageBoxButtons.OK, MessageBoxIcon.Warning); return; }
            if (r1 == 1 && totalKeju <= 0) { MessageBox.Show("Stok keju habis!", "Warning", MessageBoxButtons.OK, MessageBoxIcon.Warning); return; }
            if (r2 == 0 && totalCoklat <= 0) { MessageBox.Show("Stok coklat habis!", "Warning", MessageBoxButtons.OK, MessageBoxIcon.Warning); return; }
            if (r2 == 1 && totalKeju <= 0) { MessageBox.Show("Stok keju habis!", "Warning", MessageBoxButtons.OK, MessageBoxIcon.Warning); return; }

            cbBahanUtama.SelectedIndex = b;
            if (r1 != -1) cbRasa1.SelectedIndex = r1;
            if (r2 != -1) cbRasa2.SelectedIndex = r2;

            autoFillUsed = true;
        }


    }
}
