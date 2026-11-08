Buatlah website BEM ABSENSI menggunakan Laravel untuk mengelola UKM dan UKK, meliputi
organisasi, anggota, jadwal kegiatan, absensi, serta permintaan bergabung. Website memiliki 3 role pengguna,
yaitu Admin, Ketua UKM/UKK, dan Mahasiswa, dengan fitur dan hak akses masing-masing.

Tampilan website menggunakan Blade Templating dengan satu Master Layout, Sidebar gelap, Header kuning,
dan navigasi sesuai role. Terapkan directive @extends, @section, @yield, @include, serta Blade looping dan
conditional untuk menampilkan data secara dinamis.
Seluruh data menggunakan array PHP dan Session, tanpa Model maupun database. Gunakan Form GET dan
POST sesuai kebutuhan, serta batasi pengelolaan data pada fitur Create dan Read tanpa Update dan Delete.

Website menggunakan Bootstrap 5.3.0 untuk desain UI, dengan spesifikasi warna dan gaya visual sesuai ketentuan. Gunakan
komponen Bootstrap seperti Card, Form, Button, dan Table untuk membangun antarmuka pengguna.

Untuk data, sudah ada di DataController.php, gunakan controller, tanpa database.

# Login, Register, dan Logout

Buatlah halaman Login dan Register agar pengguna dapat mengakses website sesuai dengan role masingmasing.

Ketentuan:
1. Halaman Login memiliki input Username dan Password.
2. Sistem memeriksa kesesuaian username dan password berdasarkan data pengguna pada array.
3. Jika Login berhasil, data pengguna disimpan menggunakan Session.
4. Pengguna diarahkan ke Dashboard sesuai dengan role:
    - Admin diarahkan ke Dashboard Admin.
    - Ketua diarahkan ke Dashboard Ketua UKM/UKK.
    - Mahasiswa diarahkan ke Dashboard Mahasiswa.
    - Note : kalau missal budi ketua basket maka waktu budi login akan ada switch dashboard dari ketua dan mahasiswa
5. Jika Login gagal, tampilkan pesan kesalahan.
6. Halaman Register memiliki input Nama, NRP, Username, Password, dan Konfirmasi Password. Akun
yang didaftarkan melalui halaman ini otomatis memiliki role Mahasiswa.
7. Sediakan fitur Logout untuk mengakhiri Session pengguna.
8. Lakukan pengecekan Login dan Role melalui Controller agar pengguna tidak dapat mengakses halaman
role lain.

## Spesifikasi Desain UI: BEM ABSENSI

Buat dua komponen form (Login dan Register) menggunakan Bootstrap 5.3.0, dengan spesifikasi desain UI sebagai berikut:

#### Gaya Visual Utama
*   **Latar Belakang Halaman**: Abu-abu sangat terang.
*   **Card Form**: Latar putih, sudut membulat (rounded), bayangan lembut (drop-shadow), dengan garis batas (border) atas tebal berwarna kuning.
*   **Input Field**: Kotak input dengan border abu-abu terang dan label teks di atasnya.
*   **Tombol Utama**: Warna latar kuning, teks hitam, lebar penuh (full width).
*   **Tautan**: Teks berwarna biru.

#### 1. Komponen Login (Referensi: image_5e3f16.png)
*   **Judul**: "Login BEM ABSENSI" (Teks hitam, tebal).
*   **Sub-judul**: "Masuk menggunakan username dan password akun contoh." (Teks abu-abu).
*   **Daftar Input**: 
    *   Username
    *   Password
*   **Tombol**: Bertuliskan "Login".
*   **Footer**: Teks "Belum punya akun? " diikuti tautan "Register mahasiswa".

#### 2. Komponen Register (Referensi: image_5e3f13.png)
*   **Judul**: "Register Mahasiswa" (Teks hitam, tebal).
*   **Sub-judul**: "Akun yang baru terdaftar hanya memiliki role Mahasiswa." (Teks abu-abu).
*   **Daftar Input**:
    *   Nama Lengkap
    *   NRP
    *   Username
    *   Password
    *   Konfirmasi Password
*   **Tombol**: Bertuliskan "Register".
*   **Footer**: Tautan bertuliskan "Kembali ke Login" di tengah bawah.

# Halaman Admin

Admin memiliki akses untuk melihat seluruh informasi organisasi serta menambahkan data baru.

## Dashboard Admin

Pada Dashboard Admin, tampilkan empat statistik utama, yaitu Total UKM, Total UKK, Total Members,
dan Open Recruitment.
Seluruh statistik harus dihitung secara dinamis berdasarkan data array yang tersedia.
Tampilkan juga ringkasan jadwal kegiatan dan data absensi mahasiswa.

Buat tampilan Dashboard Admin berbasis web dengan tata letak (layout) sidebar navigasi di sebelah kiri dan area konten utama di sebelah kanan.

### Gaya Visual Utama
* **Tata Letak**: Sidebar kiri tetap (fixed), Header atas, dan Area Konten Utama.
* **Skema Warna**:
  * **Sidebar**: Latar belakang hitam/abu-abu sangat gelap dengan teks putih. Item aktif menggunakan latar kuning dengan teks hitam. Teks logout berwarna merah.
  * **Header**: Latar belakang kuning terang dengan teks hitam/gelap.
  * **Area Utama**: Latar belakang abu-abu sangat terang (light gray) dengan card/panel berwarna putih.
* **Badge Status**: Label kecil dengan sudut membulat untuk indikator status (Merah, Kuning, Hijau).

### 1. Header (Top Navigation Bar)
* **Warna Latar**: Kuning terang.
* **Sisi Kiri**: Judul halaman "Dashboard Admin".
* **Sisi Kanan**: Informasi akun pengguna yang sedang login ("Admin BEM / ADMIN BEM").

### 2. Sidebar Navigasi (Left Sidebar)
* **Branding (Atas)**:
  * Judul utama: "BEM ABSENSI" (bold)
  * Sub-judul: "UKM & UKK Attendance System"
* **Menu Navigasi**:
  * **Dashboard** (Aktif: latar kuning, bentuk pill/rounded, teks gelap)
  * **Kelola UKM & UKK**
  * **Daftar UKM**
  * **Daftar UKK**
  * **Jadwal Kegiatan**
* **Menu Bawah**:
  * **Logout** (Teks merah di bagian bawah sidebar)

### 3. Area Konten Utama (Main Content Area)

#### A. Alert / Notification Banner
* Banner di bagian paling atas konten utama dengan latar hijau muda/terang dan teks hitam bertuliskan: `"Login berhasil."`

#### B. Header Konten (Welcome Section)
* **Judul**: "Welcome to Admin Dashboard"
* **Deskripsi**: "Pantau UKM, UKK, keanggotaan dan kehadiran mahasiswa."

#### C. Kartu Statistik (Stat Cards Grid)
Tampilkan 5 kartu ringkasan statistik dalam grid responsif (latar putih, sudut membulat, shadow halus, ikon kecil di kanan atas):
1. **Total UKM**: 4
2. **Total UKK**: 2
3. **Total Members (unik)**: 2
4. **Open Recruitment**: 3
5. **Attendance Records**: 3

#### D. Bagian "Quick Management"
* **Judul**: "Quick Management"
* **Tombol Aksi Kiri**:
  * Tombol outline "Kelola UKM & UKK"
  * Tombol outline "Daftar Jadwal"
* **Tombol Aksi Kanan**:
  * Tombol utama warna kuning "+ Create Schedule"

#### E. Bagian "Jadwal Hari Ini"
* **Judul**: "Jadwal Hari Ini"
* **Kartu Informasi**: Latar putih berisi teks kegiatan:
  * Nama Kegiatan: "Latihan Basket — UKM Basket"
  * Waktu & Lokasi: "15:00-17:00 - GOR Kampus"

#### F. Tabel "Attendance Records"
* **Judul**: "Attendance Records"
* **Struktur Tabel**:
  * **Kolom**: No | NRP | Nama | Organisasi | Kegiatan | Tanggal | Status
  * **Baris Data**:
    1. `1` | `222117001` | Rina Wijaya | UKM Fotografi | Photo Hunting | 2026-11-02 | Badge Merah (`Tidak Hadir`)
    2. `2` | `222117002` | Budi Santoso | UKM Basket | Latihan Basket | 2026-11-01 | Badge Kuning (`Belum Check-out`)
    3. `3` | `222117001` | Rina Wijaya | UKM Basket | Latihan Basket | 2026-11-01 | Badge Hijau (`Lengkap`)

## Daftar UKM dan UKK

Buatlah halaman daftar organisasi dengan fitur berikut:
1. Menampilkan seluruh organisasi UKM dan UKK menggunakan perulangan Blade.
2. Setiap organisasi menampilkan nama, kategori, jumlah anggota, dan status recruitment.
3. Status recruitment terdiri atas Open Recruitment, Coming Soon, dan Closed dengan warna badge
berbeda.
4. Setiap organisasi memiliki tombol Detail untuk menampilkan informasi lengkap.

### Gaya Visual Utama (UKM)
* **Tata Letak**: Sidebar kiri tetap (fixed), Header atas, dan Area Konten Utama berisi grid kartu.
* **Skema Warna**:
  * **Sidebar**: Latar belakang hitam/abu-abu sangat gelap dengan teks putih. Item aktif ("Daftar UKM") menggunakan latar kuning dengan teks hitam. Teks logout berwarna merah.
  * **Header**: Latar belakang kuning terang dengan teks hitam/gelap.
  * **Area Utama**: Latar belakang abu-abu sangat terang (light gray) dengan card/panel berwarna putih.
* **Badge Status**:
  * Badge Tipe (`UKM`): Abu-abu gelap dengan teks putih.
  * Badge Rekrutmen:
    * `Open Recruitment`: Hijau.
    * `Coming Soon`: Kuning/Oranye.
    * `Closed`: Merah.

#### 1. Header (Top Navigation Bar)
* **Warna Latar**: Kuning terang.
* **Sisi Kiri**: Judul halaman "Kelola UKM & UKK".
* **Sisi Kanan**: Informasi akun pengguna ("Admin BEM / Admin BEM").

#### 2. Sidebar Navigasi (Left Sidebar)
* **Branding (Atas)**:
  * Judul utama: "BEM ABSENSI" (bold)
  * Sub-judul: "UKM & UKK Attendance System"
* **Menu Navigasi**:
  * **Dashboard**
  * **Kelola UKM & UKK**
  * **Daftar UKM** (Aktif: latar kuning, bentuk pill/rounded, teks gelap)
  * **Daftar UKK**
  * **Jadwal Kegiatan**
* **Menu Bawah**:
  * **Logout** (Teks merah di bagian bawah sidebar)

### 3. Area Konten Utama (Main Content Area)

#### A. Header Konten & Aksi (Section Header)
* **Sisi Kiri**:
  * **Judul**: "Daftar Organisasi"
  * **Deskripsi/Sub-judul**: "4 organisasi sesuai filter."
* **Sisi Kanan**:
  * Tombol utama warna kuning bertuliskan "+ Tambah Organisasi"

#### B. Grid Kartu Organisasi (Card Grid Layout)
Tampilkan kartu-kartu UKM dalam tata letak grid (3 kolom per baris) dengan spesifikasi tiap kartu:
* **Elemen Kartu**:
  * **Ikon Kategori**: Kotak kecil berlatar kuning muda dengan ikon di bagian kiri atas.
  * **Badge Tipe**: Label `UKM` (badge abu-abu gelap).
  * **Nama UKM**: Teks tebal (bold).
  * **Detail Kategori & Anggota**: Teks abu-abu format `[Kategori] · [Jumlah] anggota`.
  * **Badge Status Recruitment**: Badge warna sesuai status (Open Recruitment / Coming Soon / Closed).
  * **Tombol Aksi**: Tombol outline biru kecil bertuliskan "Detail" di bagian kiri bawah kartu.

* **Daftar Kartu UKM**:
  1. **UKM Basket**
     * Ikon: Bola basket
     * Kategori & Anggota: "Olahraga · 2 anggota"
     * Status: Badge hijau (`Open Recruitment`)
  2. **UKM Musik**
     * Ikon: Nada musik (Music note)
     * Kategori & Anggota: "Seni · 0 anggota"
     * Status: Badge kuning (`Coming Soon`)
  3. **UKM Fotografi**
     * Ikon: Kamera
     * Kategori & Anggota: "Seni · 1 anggota"
     * Status: Badge merah (`Closed`)
  4. **UKM Coding**
     * Ikon: Kode (`</>`)
     * Kategori & Anggota: "Teknologi · 1 anggota"
     * Status: Badge hijau (`Open Recruitment`)

### Gaya Visual Utama (UKK)

* **Tata Letak**: Sidebar kiri tetap (fixed), Header atas, dan Area Konten Utama berisi grid kartu.
* **Skema Warna**:
  * **Sidebar**: Latar belakang hitam/abu-abu sangat gelap dengan teks putih. Item aktif ("Daftar UKK") menggunakan latar kuning dengan teks hitam. Teks logout berwarna merah.
  * **Header**: Latar belakang kuning terang dengan teks hitam/gelap.
  * **Area Utama**: Latar belakang abu-abu sangat terang (light gray) dengan card/panel berwarna putih.
* **Badge Status**:
  * Badge Tipe (`UKK`): Abu-abu gelap dengan teks putih.
  * Badge Rekrutmen:
    * `Open Recruitment`: Hijau.
    * `Coming Soon`: Kuning/Oranye.

#### 1. Header (Top Navigation Bar)
* **Warna Latar**: Kuning terang.
* **Sisi Kiri**: Judul halaman "Kelola UKM & UKK".
* **Sisi Kanan**: Informasi akun pengguna ("Admin BEM / Admin BEM").

#### 2. Sidebar Navigasi (Left Sidebar)
* **Branding (Atas)**:
  * Judul utama: "BEM ABSENSI" (bold)
  * Sub-judul: "UKM & UKK Attendance System"
* **Menu Navigasi**:
  * **Dashboard**
  * **Kelola UKM & UKK**
  * **Daftar UKM**
  * **Daftar UKK** (Aktif: latar kuning, bentuk pill/rounded, teks gelap)
  * **Jadwal Kegiatan**
* **Menu Bawah**:
  * **Logout** (Teks merah di bagian bawah sidebar)

#### 3. Area Konten Utama (Main Content Area)

#### A. Header Konten & Aksi (Section Header)
* **Sisi Kiri**:
  * **Judul**: "Daftar Organisasi"
  * **Deskripsi/Sub-judul**: "2 organisasi sesuai filter."
* **Sisi Kanan**:
  * Tombol utama warna kuning bertuliskan "+ Tambah Organisasi"

#### B. Grid Kartu Organisasi (Card Grid Layout)
Tampilkan kartu-kartu UKK dalam tata letak grid (3 kolom per baris) dengan spesifikasi tiap kartu:
* **Elemen Kartu**:
  * **Ikon Kategori**: Kotak kecil berlatar kuning muda dengan ikon di bagian kiri atas.
  * **Badge Tipe**: Label `UKK` (badge abu-abu gelap).
  * **Nama UKK**: Teks tebal (bold).
  * **Detail Kategori & Anggota**: Teks abu-abu format `[Kategori] · [Jumlah] anggota`.
  * **Badge Status Recruitment**: Badge warna sesuai status (Open Recruitment / Coming Soon).
  * **Tombol Aksi**: Tombol outline biru kecil bertuliskan "Detail" di bagian kiri bawah kartu.

* **Daftar Kartu UKK**:
  1. **UKK Kerohanian Kristen**
     * Ikon: Hati (Heart)
     * Kategori & Anggota: "Kerohanian · 1 anggota"
     * Status: Badge hijau (`Open Recruitment`)
  2. **UKK Kerohanian Katolik**
     * Ikon: Komunitas/Orang (People/Users)
     * Kategori & Anggota: "Kerohanian · 1 anggota"
     * Status: Badge kuning (`Coming Soon`)

## Create Organisasi

Sediakan form untuk menambahkan UKM atau UKK baru menggunakan Form POST.

Data yang diperlukan:
- Jenis Organisasi (UKM/UKK)
- Nama Organisasi
- Kategori
- Deskripsi
- Icon
- Status Recruitment
- Daftar Kegiatan Organisasi
- Nama Ketua
- Username Ketua
- Password Ketua

Ketika organisasi baru berhasil ditambahkan, sistem juga membuat akun Ketua yang terhubung dengan
organisasi tersebut

Buat tampilan halaman formulir "Tambah Organisasi" (Create UKM / UKK) berbasis web dengan tata letak sidebar di sebelah kiri dan form input di sebelah kanan.

### Gaya Visual Utama
* **Tata Letak**: Sidebar kiri tetap (fixed), Header atas, dan Area Konten Utama berupa kartu form putih.
* **Skema Warna**:
  * **Sidebar**: Latar belakang hitam/abu-abu sangat gelap dengan teks putih. Item aktif ("Kelola UKM & UKK") menggunakan latar kuning dengan teks hitam. Teks logout berwarna merah.
  * **Header**: Latar belakang kuning terang dengan teks hitam/gelap.
  * **Area Utama**: Latar belakang abu-abu sangat terang (light gray) dengan card/panel form berwarna putih.
* **Komponen Form**:
  * Input text, dropdown select, dan textarea menggunakan border abu-abu terang dengan placeholder teks.
  * Tombol navigasi "← Kembali" bertipe outline/ghost di atas form.
  * Tombol submit berwarna kuning di bagian kiri bawah form.

### 1. Header (Top Navigation Bar)
* **Warna Latar**: Kuning terang.
* **Sisi Kiri**: Judul halaman "Tambah Organisasi".
* **Sisi Kanan**: Informasi akun pengguna ("Admin BEM / Admin BEM").

### 2. Sidebar Navigasi (Left Sidebar)
* **Branding (Atas)**:
  * Judul utama: "BEM ABSENSI" (bold)
  * Sub-judul: "UKM & UKK Attendance System"
* **Menu Navigasi**:
  * **Dashboard**
  * **Kelola UKM & UKK** (Aktif: latar kuning, bentuk pill/rounded, teks gelap)
  * **Daftar UKM**
  * **Daftar UKK**
  * **Jadwal Kegiatan**
* **Menu Bawah**:
  * **Logout** (Teks merah di bagian bawah sidebar)

### 3. Area Konten Utama (Main Content Area)

#### A. Navigation & Card Container
* **Tombol Navigasi**: Tombol kecil "← Kembali" terletak di luar/atas kartu form.
* **Form Container**: Card putih besar dengan sudut membulat dan padding tebal.
* **Judul Form**: "Create UKM / UKK" (Teks tebal/bold).

#### B. Grid Input Form (2 Kolom Layout)
Formulir menggunakan tata letak 2 kolom sejajar untuk input standar:

* **Baris 1**:
  * **Tipe Organisasi**: Select/Dropdown (`UKM`)
  * **Nama Organisasi**: Input text
* **Baris 2**:
  * **Kategori**: Input text (Placeholder: `Olahraga / Seni / Kerohanian`)
  * **Icon Bootstrap**: Input text (Placeholder: `bi-people`)
* **Baris 3**:
  * **Status Recruitment**: Select/Dropdown (`Open Recruitment`)
  * **Nama Ketua UKM / UKK**: Input text (Placeholder: `Nama ketua organisasi`)
* **Baris 4**:
  * **Username Ketua**: Input text (Placeholder: `contoh: ketua_basket`)
  * **Password Akun Ketua**: Input password (Placeholder: `Minimal 6 karakter`)
    * *Teks Bantuan (Helper text bawah input)*: "Akun Ketua otomatis dibuat saat organisasi ditambahkan."

#### C. Input Form Lebar Penuh (Full-Width Textarea)
* **Deskripsi**: Textarea multi-line.
* **Kegiatan Rutin (satu kegiatan per baris)**: Textarea multi-line.

#### D. Tombol Aksi (Form Action)
* **Tombol Submit**: Button warna kuning di sudut kiri bawah bertuliskan "Tambah Organisasi".


## Detail Organisasi dan Tambah Anggota

Halaman Detail Organisasi menampilkan informasi organisasi, kegiatan rutin, nama Ketua, jumlah anggota,
daftar mahasiswa yang tergabung, jadwal kegiatan, serta catatan absensi.
Sediakan form Tambah Anggota agar Admin dapat memasukkan mahasiswa yang sudah terdaftar sebagai
anggota UKM/UKK.
Satu mahasiswa diperbolehkan mengikuti lebih dari satu organisasi.

### Gaya Visual Utama
* **Tata Letak**: Header atas full-width dan Area Konten Utama berisi serangkaian kartu/panel terpisah secara vertikal.
* **Skema Warna**:
  * **Header**: Latar belakang kuning terang dengan teks hitam/gelap.
  * **Area Utama**: Latar belakang abu-abu sangat terang (light gray) dengan card/panel berwarna putih.
* **Badge Status**:
  * Status Rekrutmen (`Open Recruitment`): Badge hijau.
  * Status Absensi:
    * `Belum Check-out`: Badge kuning/oranye.
    * `Lengkap`: Badge hijau.
* **Komponen Interaktif**:
  * Tombol navigasi "← Kembali ke Daftar" bertipe outline/ghost di bagian atas luar card.
  * Select dropdown dan tombol utama kuning ("Tambah Anggota") untuk penambahan anggota.
  * Tombol aksi outline kecil ("Catat / Lihat Absensi") pada tabel jadwal.

### 1. Header (Top Navigation Bar)
* **Warna Latar**: Kuning terang.
* **Sisi Kiri**: Judul halaman "Detail Organisasi".
* **Sisi Kanan**: Informasi akun pengguna ("Admin BEM / Admin BEM").

### 2. Area Konten Utama (Main Content Area)

#### A. Tombol Navigasi
* Tombol outline kecil "← Kembali ke Daftar" terletak di sudut kiri atas sebelum section card utama.

#### B. Card Informasi Organisasi (Header Detail Panel)
Panel putih berisi detail profil organisasi:
* **Profil Utama**:
  * Ikon Kategori: Kotak berlatar kuning muda dengan ikon di kiri atas.
  * Nama Organisasi: "UKM Basket" (Teks tebal).
  * Sub-detail: "UKM · Olahraga" (Teks abu-abu).
  * Deskripsi: "Komunitas olahraga basket yang rutin berlatih dan mengikuti kompetisi."
  * Status Rekrutmen: Badge hijau `Open Recruitment`.
* **Seksi Ketua Organisasi**:
  * Label: "Ketua Organisasi" (Teks tebal).
  * Nama Ketua: "Rizky Pratama".
  * Keterangan: "Ketua dapat login untuk melihat notifikasi calon anggota."
* **Seksi Kegiatan Rutin**:
  * Label: "Kegiatan Rutin" (Teks tebal).
  * Unordered List (bullet points):
    * Latihan Rutin
    * Friendly Match
    * Turnamen Basket

#### C. Card "Calon Anggota Menghubungi Ketua"
Panel khusus pendaftaran calon anggota:
* **Judul**: "Calon Anggota Menghubungi Ketua (0)" (disertai ikon lonceng/notifikasi di sebelah kiri).
* **Keterangan**: "Ketua menerima notifikasi saat login. Admin dapat memasukkan calon anggota melalui form Tambah Anggota di bawah."
* **Tabel Pendaftaran**:
  * **Kolom**: No | NRP | Mahasiswa | Waktu Permintaan
  * **Pesan Kosong**: Teks abu-abu di tengah baris bertuliskan "Belum ada permintaan bergabung."

#### D. Card "Daftar Mahasiswa / Anggota"
Panel manajemen keanggotaan organisasi:
* **Judul Panel**: "Daftar Mahasiswa / Anggota (2)"
* **Form Tambah Anggota (Baris Atas Tabel)**:
  * Dropdown Select: Placeholder `"Pilih mahasiswa yang terdaftar"` (mengambil sisa lebar area).
  * Tombol Submit: Warna kuning bertuliskan "Tambah Anggota".
* **Tabel Anggota**:
  * **Kolom**: No | NRP | Nama
  * **Baris Data**:
    1. `1` | `222117001` | Rina Wijaya
    2. `2` | `222117002` | Budi Santoso

#### E. Card "Jadwal Kegiatan"
Panel daftar agenda/kegiatan organisasi:
* **Judul Panel**: "Jadwal Kegiatan"
* **Tabel Kegiatan**:
  * **Kolom**: Kegiatan | Tanggal | Jam | Aksi
  * **Baris Data**:
    * `Latihan Basket` | `2026-11-01` | `15:00-17:00` | Tombol outline `"Catat / Lihat Absensi"`

#### F. Card "Attendance Records"
Panel rekap absensi kehadiran anggota:
* **Judul Panel**: "Attendance Records (2)"
* **Tabel Absensi**:
  * **Kolom**: No | NRP | Nama | Tanggal | Check-in | Check-out | Status
  * **Baris Data**:
    1. `1` | `222117002` | Budi Santoso | `2026-11-01` | `15:10` | `-` | Badge Kuning (`Belum Check-out`)
    2. `2` | `222117001` | Rina Wijaya | `2026-11-01` | `15:00` | `17:00` | Badge Hijau (`Lengkap`)

## Create Schedule

Buat form untuk menambahkan jadwal kegiatan organisasi dengan data:
- Organisasi
- Nama Kegiatan
- Tanggal Kegiatan
- Jam Mulai
- Jam Selesai
- Lokasi
- Deskripsi

Jadwal yang berhasil ditambahkan harus muncul pada halaman Admin dan pada halaman Mahasiswa yang
mengikuti organisasi terkait.

### Gaya Visual Utama
* **Tata Letak**: Sidebar kiri tetap (fixed), Header atas, dan Area Konten Utama berupa kartu form putih.
* **Skema Warna**:
  * **Sidebar**: Latar belakang hitam/abu-abu sangat gelap dengan teks putih. Item aktif ("Jadwal Kegiatan") menggunakan latar kuning dengan teks hitam. Teks logout berwarna merah.
  * **Header**: Latar belakang kuning terang dengan teks hitam/gelap.
  * **Area Utama**: Latar belakang abu-abu sangat terang (light gray) dengan card/panel form berwarna putih.
* **Komponen Form**:
  * Input text, date picker, time picker, dropdown select, dan textarea menggunakan border abu-abu terang.
  * Tombol navigasi "← Kembali" bertipe outline/ghost di atas form.
  * Tombol submit berwarna kuning di bagian kiri bawah form.

### 1. Header (Top Navigation Bar)
* **Warna Latar**: Kuning terang.
* **Sisi Kiri**: Judul halaman "Create Schedule".
* **Sisi Kanan**: Informasi akun pengguna ("Admin BEM / Admin BEM").

### 2. Sidebar Navigasi (Left Sidebar)
* **Branding (Atas)**:
  * Judul utama: "BEM ABSENSI" (bold)
  * Sub-judul: "UKM & UKK Attendance System"
* **Menu Navigasi**:
  * **Dashboard**
  * **Kelola UKM & UKK**
  * **Daftar UKM**
  * **Daftar UKK**
  * **Jadwal Kegiatan** (Aktif: latar kuning, bentuk pill/rounded, teks gelap)
* **Menu Bawah**:
  * **Logout** (Teks merah di bagian bawah sidebar)

### 3. Area Konten Utama (Main Content Area)

#### A. Navigation & Card Container
* **Tombol Navigasi**: Tombol kecil "← Kembali" terletak di luar/atas kartu form.
* **Form Container**: Card putih besar dengan sudut membulat dan padding tebal.
* **Judul Form**: "Create Schedule" (Teks tebal/bold).

#### B. Grid Input Form
Formulir menggunakan kombinasi tata letak grid untuk input jadwal:

* **Baris 1 (2 Kolom Sejajar)**:
  * **UKM / UKK**: Select/Dropdown (Placeholder: `Pilih Organisasi`)
  * **Nama Kegiatan**: Input text
* **Baris 2 (3 Kolom Sejajar)**:
  * **Tanggal**: Input date (Placeholder/Format: `dd/mm/yyyy` dengan ikon kalender)
  * **Jam Mulai**: Input time (Placeholder/Format: `--:--` dengan ikon jam)
  * **Jam Selesai**: Input time (Placeholder/Format: `--:--` dengan ikon jam)
* **Baris 3 (Lebar Penuh)**:
  * **Lokasi**: Input text

#### C. Input Form Lebar Penuh (Full-Width Textarea)
* **Deskripsi**: Textarea multi-line.

#### D. Tombol Aksi (Form Action)
* **Tombol Submit**: Button warna kuning di sudut kiri bawah bertuliskan "Buat Jadwal".

## Attendance Records

Admin dapat mencatat kehadiran mahasiswa berdasarkan jadwal kegiatan yang tersedia.
Status kehadiran terdiri atas:
- Lengkap
- Belum Check-out
- Tidak Hadir

Tampilkan waktu Check-in dan Check-out sesuai status kehadiran. Data yang tidak tersedia ditampilkan
menggunakan tanda -.
Catatan absensi yang sudah disimpan hanya dapat dilihat dan tidak dapat diubah atau dihapus.

### Gaya Visual Utama
* **Tata Letak**: Panel-panel terpisah secara vertikal dengan latar belakang putih, sudut membulat (rounded), dan bayangan halus (drop-shadow).
* **Skema Warna**:
  * **Latar Belakang**: Abu-abu sangat terang (light gray).
  * **Kartu/Panel**: Putih.
  * **Tombol Utama**: Warna kuning dengan teks hitam.
  * **Badge Status**: Red badge (`Tidak Hadir`) dengan latar merah dan teks putih.
* **Tabel**: Desain clean minimalis tanpa garis vertikal, hanya garis pembatas horizontal antar baris.

### 1. Card "Daftar Mahasiswa / Anggota"
* **Judul Panel**: "Daftar Mahasiswa / Anggota (1)" (Teks tebal/bold).
* **Form Tambah Anggota (Baris Atas Tabel)**:
  * Dropdown Select: Placeholder `"Pilih mahasiswa yang terdaftar"` (mengambil sisa lebar area).
  * Tombol Submit: Warna kuning bertuliskan "Tambah Anggota".
* **Tabel Anggota**:
  * **Kolom**: No | NRP | Nama
  * **Baris Data**:
    1. `1` | `222117001` | Rina Wijaya

### 2. Card "Jadwal Kegiatan"
* **Judul Panel**: "Jadwal Kegiatan" (Teks tebal/bold).
* **Tabel Kegiatan**:
  * **Kolom**: Kegiatan | Tanggal | Jam | Aksi
  * **Baris Data**:
    * `Photo Hunting` | `2026-11-02` | `09:00–11:00` | Tombol outline `"Catat / Lihat Absensi"`

### 3. Card "Attendance Records"
* **Judul Panel**: "Attendance Records (1)" (Teks tebal/bold).
* **Tabel Absensi**:
  * **Kolom**: No | NRP | Nama | Tanggal | Check-in | Check-out | Status
  * **Baris Data**:
    1. `1` | `222117001` | Rina Wijaya | `2026-11-02` | `-` | `-` | Badge Merah (`Tidak Hadir`)

# Halaman Mahasiswa

Mahasiswa memiliki Dashboard pribadi yang menampilkan informasi organisasi serta kehadirannya.

## Dashboard Mahasiswa

Tampilkan empat statistik kehadiran berdasarkan akun mahasiswa yang sedang Login:
1.	Total Absensi
2.	Hadir Lengkap
3.	Tidak Hadir
4.	Belum Check-out

Statistik tidak boleh mengambil data seluruh mahasiswa, melainkan hanya data milik pengguna yang sedang Login.

### Gaya Visual Utama
* **Tata Letak**: Sidebar kiri tetap (fixed), Header atas, dan Area Konten Utama berisi statistik, daftar jadwal, serta galeri organisasi.
* **Skema Warna**:
  * **Sidebar**: Latar belakang hitam/abu-abu sangat gelap dengan teks putih. Item aktif ("Dashboard") menggunakan latar kuning dengan teks hitam. Teks logout berwarna merah.
  * **Header**: Latar belakang kuning terang dengan teks hitam/gelap.
  * **Area Utama**: Latar belakang abu-abu sangat terang (light gray) dengan card/panel berwarna putih.
* **Elemen Switcher**: Box kontainer gelap di sidebar ("Pilih Tampilan") berisi dua tombol mode role: "Dashboard Ketua" dan "Dashboard Mahasiswa" (aktif dengan latar kuning).

### 1. Header (Top Navigation Bar)
* **Warna Latar**: Kuning terang.
* **Sisi Kiri**: Judul halaman "Dashboard Mahasiswa".
* **Sisi Kanan**: Informasi akun pengguna ("Budi Santoso | NRP: 222117002 - Mode Mahasiswa").

### 2. Sidebar Navigasi (Left Sidebar)
* **Branding (Atas)**:
  * Judul utama: "BEM ABSENSI" (bold)
  * Sub-judul: "UKM & UKK Attendance System"
* **Role Switcher ("Pilih Tampilan")**:
  * Tombol 1: "Dashboard Ketua" (outline/dark)
  * Tombol 2: "Dashboard Mahasiswa" (Aktif: latar kuning, teks hitam)
* **Menu Navigasi**:
  * **Dashboard** (Aktif: latar kuning, bentuk pill/rounded, teks gelap)
  * **Organisasi Saya**
  * **Jelajahi UKM & UKK**
  * **Jadwal Kegiatan**
  * **Riwayat Absensi**
* **Menu Bawah**:
  * **Logout** (Teks merah di bagian bawah sidebar)

### 3. Area Konten Utama (Main Content Area)

#### A. Header Konten (Welcome Section)
* **Judul**: "Selamat Datang, Budi Santoso!"
* **Deskripsi**: "Pantau kehadiran dan kegiatan UKM/UKK Anda. NRP: 222117002"

#### B. Kartu Statistik Kehadiran (Stat Cards Grid)
4 kartu ringkasan statistik (latar putih, sudut membulat, ikon di kanan atas):
1. **Total Absensi**: 1 (Ikon dokumen)
2. **Hadir Lengkap**: 0 (Ikon centang biru)
3. **Tidak Hadir**: 0 (Ikon silang biru)
4. **Belum Check-out**: 1 (Ikon jam biru)

#### C. Bagian "Jadwal Hari Ini"
* **Judul**: "Jadwal Hari Ini"
* **Kartu Informasi**: Latar putih/abu-abu terang berisi:
  * Nama Kegiatan: "Latihan Basket" (Teks tebal)
  * Sub-detail: "UKM Basket · 15:00–17:00 · GOR Kampus"

#### D. Bagian "Jadwal Mendatang"
* **Judul**: "Jadwal Mendatang"
* **Tabel Jadwal**:
  * **Kolom**: Organisasi | Kegiatan | Tanggal | Waktu
  * **Baris Data**:
    1. UKM Basket | Latihan Basket | `2026-11-01` | `15:00–17:00`
    2. UKM Coding | Coding Class | `2026-11-02` | `13:00–15:00`
    3. UKK Kerohanian Kristen | Persekutuan | `2026-11-03` | `18:00–19:30`
* **Tombol Aksi**: Tombol outline di kiri bawah tabel bertuliskan "Lihat Semua Jadwal".

#### E. Banner Call-to-Action "Ingin Bergabung dengan UKM / UKK?"
Card khusus di bagian tengah:
* **Sisi Kiri**:
  * Judul: "Ingin Bergabung dengan UKM / UKK?"
  * Sub-judul: "Pilih organisasi dan hubungi ketuanya melalui WhatsApp."
  * Catatan Tambahan: "Menghubungi ketua tidak otomatis membuat kamu menjadi anggota. Admin akan mencatat keanggotaan setelah proses pendaftaran."
* **Sisi Kanan**: Tombol utama kuning bertuliskan "Jelajahi Organisasi".

#### F. Bagian "UKM & UKK yang Saya Ikuti"
* **Judul**: "UKM & UKK yang Saya Ikuti"
* **Grid Kartu Organisasi (2 Kolom Layout)**:
  1. **UKM Basket**
     * Ikon: Bola basket (berlatar kuning muda)
     * Kategori: `UKM · Olahraga`
     * Bullet Points: Latihan Rutin, Friendly Match, Turnamen Basket
  2. **UKM Coding**
     * Ikon: Kode (`</>`) (berlatar kuning muda)
     * Kategori: `UKM · Teknologi`
     * Bullet Points: Coding Class, Hackathon, Project Collaboration
  3. **UKK Kerohanian Kristen**
     * Ikon: Hati (berlatar kuning muda)
     * Kategori: `UKK · Kerohanian`
     * Bullet Points: Persekutuan, Retreat, Kegiatan Sosial

#### G. Bagian "Riwayat Kehadiran Terakhir"
* **Judul**: "Riwayat Kehadiran Terakhir"
* **Tabel Riwayat**:
  * **Kolom**: Kegiatan | Tanggal | Status
  * **Baris Data**:
    * `Latihan Basket` | `2026-11-01` | Badge Kuning (`Belum Check-out`)
* **Tombol Aksi**: Tombol outline di kiri bawah tabel bertuliskan "Seluruh Riwayat".

## UKM & UKK saya

Buat halaman yang menampilkan daftar organisasi yang sedang diikuti mahasiswa.
Setiap organisasi menampilkan nama, kategori, kegiatan rutin, dan informasi terkait.

### Gaya Visual Utama
* **Tata Letak**: Sidebar kiri tetap (fixed), Header atas, dan Area Konten Utama berisi grid kartu organisasi.
* **Skema Warna**:
  * **Sidebar**: Latar belakang hitam/abu-abu sangat gelap dengan teks putih. Item aktif ("Organisasi Saya") menggunakan latar kuning dengan teks hitam. Teks logout berwarna merah.
  * **Header**: Latar belakang kuning terang dengan teks hitam/gelap.
  * **Area Utama**: Latar belakang abu-abu sangat terang (light gray) dengan card/panel berwarna putih.
* **Badge Tipe**:
  * Label `UKM`: Badge abu-abu gelap dengan teks putih.
  * Label `UKK`: Badge abu-abu gelap dengan teks putih.

### 1. Header (Top Navigation Bar)
* **Warna Latar**: Kuning terang.
* **Sisi Kiri**: Judul halaman "Organisasi Saya".
* **Sisi Kanan**: Informasi akun pengguna ("Budi Santoso | NRP: 222117002 - Mode Mahasiswa").

### 2. Sidebar Navigasi (Left Sidebar)
* **Branding (Atas)**:
  * Judul utama: "BEM ABSENSI" (bold)
  * Sub-judul: "UKM & UKK Attendance System"
* **Role Switcher ("Pilih Tampilan")**:
  * Tombol 1: "Dashboard Ketua" (outline/dark)
  * Tombol 2: "Dashboard Mahasiswa" (Aktif: latar kuning, teks hitam)
* **Menu Navigasi**:
  * **Dashboard**
  * **Organisasi Saya** (Aktif: latar kuning, bentuk pill/rounded, teks gelap)
  * **Jelajahi UKM & UKK**
  * **Jadwal Kegiatan**
  * **Riwayat Absensi**
* **Menu Bawah**:
  * **Logout** (Teks merah di bagian bawah sidebar)

### 3. Area Konten Utama (Main Content Area)

#### A. Header Konten & Tombol Aksi (Section Header)
* **Panel Atas (Sisi Kiri)**:
  * **Judul**: "UKM & UKK yang Saya Ikuti"
  * **Sub-judul/Keterangan**: "Terdaftar di 3 organisasi."
* **Tombol Aksi (Sisi Kanan)**:
  * Tombol utama warna kuning bertuliskan "+ Cari UKM & UKK Lain".

#### B. Grid Kartu Organisasi (2 Kolom Layout)
Tampilkan kartu-kartu organisasi yang diikuti mahasiswa dalam tata letak grid dengan spesifikasi tiap kartu:
* **Elemen Kartu**:
  * **Ikon Kategori**: Kotak kecil berlatar kuning muda dengan ikon di bagian kiri atas.
  * **Badge Tipe**: Label `UKM` atau `UKK` (badge abu-abu gelap).
  * **Nama Organisasi**: Teks tebal (bold).
  * **Deskripsi**: Teks penjelasan singkat di bawah nama organisasi.
  * **Ketua**: Teks abu-abu format `Ketua: [Nama Ketua]`.
  * **Kegiatan Rutin**: Sub-heading "Kegiatan Rutin" diikuti bullet points.

* **Daftar Kartu Organisasi**:
  1. **UKM Basket**
     * Ikon: Bola basket
     * Tipe: Badge `UKM`
     * Deskripsi: "Komunitas olahraga basket yang rutin berlatih dan mengikuti kompetisi."
     * Ketua: Budi Santoso
     * Kegiatan Rutin:
       * Latihan Rutin
       * Friendly Match
       * Turnamen Basket
  2. **UKM Coding**
     * Ikon: Kode (`</>`)
     * Tipe: Badge `UKM`
     * Deskripsi: "Komunitas belajar pemrograman dan pengembangan aplikasi."
     * Ketua: Fajar Ramadhan
     * Kegiatan Rutin:
       * Coding Class
       * Hackathon
       * Project Collaboration
  3. **UKK Kerohanian Kristen**
     * Ikon: Hati (Heart)
     * Tipe: Badge `UKK`
     * Deskripsi: "Kegiatan pembinaan dan kebersamaan mahasiswa Kristen."
     * Ketua: Clara Wijaya
     * Kegiatan Rutin:
       * Persekutuan
       * Retreat
       * Kegiatan Sosial

## Jadwal dan Riwayat Absensi

Tampilkan seluruh jadwal kegiatan dari organisasi yang diikuti mahasiswa, beserta tanggal, jam, dan lokasi kegiatan.
Sediakan halaman Riwayat Absensi yang menampilkan tanggal kegiatan, nama kegiatan, Check-in, Check-out, dan status kehadiran.

### Gaya Visual Utama
* **Tata Letak**: Header atas full-width dan Area Konten Utama berisi kartu/panel putih terpusat.
* **Skema Warna**:
  * **Header**: Latar belakang kuning terang dengan teks hitam/gelap.
  * **Area Utama**: Latar belakang abu-abu sangat terang (light gray) dengan card/panel berwarna putih.
  * **Badge Status**: `Belum Check-out` menggunakan badge berwarna kuning/oranye dengan teks hitam/gelap.
* **Tabel**: Desain clean minimalis tanpa garis vertikal, hanya garis pembatas horizontal tipis abu-abu terang antar baris.

### 1. Komponen Halaman "Jadwal Saya" (Referensi: image_5b9ae1.png)

#### A. Header (Top Navigation Bar)
* **Warna Latar**: Kuning terang.
* **Sisi Kiri**: Judul halaman "Jadwal Saya".
* **Sisi Kanan**: Informasi akun pengguna ("Budi Santoso | NRP: 222117002 - Mode Mahasiswa").

#### B. Area Konten Utama (Main Content Area)
* **Card Container**: Panel putih berujung membulat (rounded) dengan padding internal.
* **Judul Panel**: "Jadwal Kegiatan UKM & UKK" (Teks tebal/bold).
* **Tabel Jadwal**:
  * **Kolom**: No | Organisasi | Kegiatan | Tanggal | Jam | Lokasi
  * **Baris Data**:
    1. `1` | UKM Basket | Latihan Basket | `2026-11-01` | `15:00–17:00` | GOR Kampus
    2. `2` | UKM Coding | Coding Class | `2026-11-02` | `13:00–15:00` | Lab Komputer
    3. `3` | UKK Kerohanian Kristen | Persekutuan | `2026-11-03` | `18:00–19:30` | Ruang Serbaguna

### 2. Komponen Halaman "Riwayat Absensi" 

#### A. Header (Top Navigation Bar)
* **Warna Latar**: Kuning terang.
* **Sisi Kiri**: Judul halaman "Riwayat Absensi".
* **Sisi Kanan**: Informasi akun pengguna ("Budi Santoso | NRP: 222117002 - Mode Mahasiswa").

#### B. Area Konten Utama (Main Content Area)
* **Card Container**: Panel putih berujung membulat (rounded) dengan padding internal.
* **Judul Panel**: "Riwayat Kehadiran Saya" (Teks tebal/bold).
* **Tabel Riwayat**:
  * **Kolom**: No | UKM / UKK | Kegiatan | Tanggal | Check-in | Check-out | Status
  * **Baris Data**:
    1. `1` | UKM Basket | Latihan Basket | `2026-11-01` | `15:10` | `-` | Badge Kuning (`Belum Check-out`)

## Jelajahi UKM & UKK

Mahasiswa dapat melihat seluruh organisasi yang tersedia, termasuk organisasi yang belum diikuti.
Pada setiap organisasi, tampilkan salah satu kondisi berikut:
- Sudah Bergabung: Jika mahasiswa sudah menjadi anggota.
- Permintaan Terkirim: Jika mahasiswa telah mengirim permintaan bergabung.
- Hubungi Ketua: Jika mahasiswa belum menjadi anggota dan belum mengirim permintaan.

Ketika tombol Hubungi Ketua ditekan, sistem mengirimkan permintaan bergabung melalui Form POST. Permintaan tersebut disimpan dalam Session, bukan dikirim melalui WhatsApp.

### Gaya Visual Utama
* **Tata Letak**: Header atas full-width, Bar Filter Pencarian, dan Area Konten Utama berisi grid 2 kolom kartu organisasi.
* **Skema Warna**:
  * **Header**: Latar belakang kuning terang dengan teks hitam/gelap.
  * **Area Utama**: Latar belakang abu-abu sangat terang (light gray) dengan card/panel berwarna putih.
* **Badge Status**:
  * Badge Tipe (`UKM` / `UKK`): Badge abu-abu gelap di sudut kanan atas kartu.
  * Badge Rekrutmen:
    * `Open Recruitment`: Hijau.
    * `Coming Soon`: Kuning/Oranye.
    * `Closed`: Merah.
  * Badge Keanggotaan (`Sudah Bergabung`): Biru.
* **Komponen Interaktif**:
  * Form Filter & Pencarian: Select dropdown, Text input, dan Tombol Cari (gelap).
  * Tombol Aksi Utama: Tombol kuning " Hubungi Ketua" (dengan ikon lonceng) atau Tombol Outline Biru "Lihat di Organisasi Saya" untuk organisasi yang sudah diikuti.

### 1. Header (Top Navigation Bar)
* **Warna Latar**: Kuning terang.
* **Sisi Kiri**: Judul halaman "Jelajahi UKM & UKK".
* **Sisi Kanan**: Informasi akun pengguna ("Budi Santoso / 222117002").

### 2. Area Konten Utama (Main Content Area)

#### A. Header Konten & Penjelasan
* **Card Header**: Panel putih dengan padding internal.
  * **Judul**: "Jelajahi UKM & UKK" (Teks tebal/bold).
  * **Deskripsi**: "Temukan organisasi yang sesuai minatmu. Klik Hubungi Ketua untuk mengirim permintaan bergabung lewat website."

#### B. Bar Filter & Pencarian (Search Bar)
* **Tata Letak Grid**: 3 elemen sejajar dalam satu baris.
  * **Select Filter**: Dropdown `Semua UKM & UKK`.
  * **Input Search**: Text input dengan placeholder `Cari nama UKM atau UKK`.
  * **Tombol Submit**: Button latar hitam/abu-abu gelap dengan teks putih "Cari".

#### C. Grid Kartu Organisasi (2 Kolom Layout)
Setiap kartu organisasi memiliki struktur komponen:
* **Ikon Kategori**: Kotak berlatar kuning muda di kiri atas.
* **Badge Tipe**: Label `UKM` / `UKK` di kanan atas.
* **Nama Organisasi**: Teks tebal (bold).
* **Detail Kategori & Anggota**: Teks abu-abu format `[Kategori] · [Jumlah] anggota`.
* **Deskripsi**: Penjelasan singkat tujuan organisasi.
* **Status Badges**: Kombinasi status rekrutmen dan keanggotaan.
* **Box Informasi Ketua**: Panel abu-abu terang di dalam kartu:
  * Nama Ketua: `Ketua: [Nama Ketua]` (Teks tebal).
  * Catatan: `Permintaan masuk ke notifikasi Dashboard Ketua.`
* **Tombol Aksi & Helper Text**:
  * Jika **Belum Bergabung**: Tombol warna kuning bertuliskan " Hubungi Ketua" dan teks bantuan kecil di bawahnya: *"Mengirim notifikasi kepada ketua, bukan langsung menjadi anggota."*
  * Jika **Sudah Bergabung**: Tombol outline biru full-width bertuliskan "Lihat di Organisasi Saya".

#### D. Daftar Kartu Organisasi:
1. **UKM Basket**
   * Ikon: Bola basket | Tipe: `UKM`
   * Detail: "Olahraga · 2 anggota"
   * Deskripsi: "Komunitas olahraga basket yang rutin berlatih dan mengikuti kompetisi."
   * Status: Badge Hijau (`Open Recruitment`) + Badge Biru (`Sudah Bergabung`)
   * Ketua: Rizky Pratama
   * Aksi: Tombol Outline Biru `"Lihat di Organisasi Saya"`

2. **UKM Musik**
   * Ikon: Nada musik | Tipe: `UKM`
   * Detail: "Seni · 0 anggota"
   * Deskripsi: "Tempat pengembangan bakat musik mahasiswa."
   * Status: Badge Kuning (`Coming Soon`)
   * Ketua: Nadia Putri
   * Aksi: Tombol Kuning `" Hubungi Ketua"`

3. **UKM Fotografi**
   * Ikon: Kamera | Tipe: `UKM`
   * Detail: "Seni · 1 anggota"
   * Deskripsi: "Wadah mahasiswa yang berminat dalam fotografi."
   * Status: Badge Merah (`Closed`)
   * Ketua: Dimas Santoso
   * Aksi: Tombol Kuning `" Hubungi Ketua"`

4. **UKM Coding**
   * Ikon: Kode (`</>`) | Tipe: `UKM`
   * Detail: "Teknologi · 1 anggota"
   * Deskripsi: "Komunitas belajar pemrograman dan pengembangan aplikasi."
   * Status: Badge Hijau (`Open Recruitment`) + Badge Biru (`Sudah Bergabung`)
   * Ketua: Fajar Ramadhan
   * Aksi: Tombol Outline Biru `"Lihat di Organisasi Saya"`

5. **UKK Kerohanian Kristen**
   * Ikon: Hati | Tipe: `UKK`
   * Detail: "Kerohanian · 1 anggota"
   * Deskripsi: "Kegiatan pembinaan dan kebersamaan mahasiswa Kristen."
   * Status: Badge Hijau (`Open Recruitment`) + Badge Biru (`Sudah Bergabung`)
   * Ketua: Clara Wijaya
   * Aksi: Tombol Outline Biru `"Lihat di Organisasi Saya"`

6. **UKK Kerohanian Katolik**
   * Ikon: Komunitas | Tipe: `UKK`
   * Detail: "Kerohanian · 1 anggota"
   * Deskripsi: "Kegiatan pembinaan dan kebersamaan mahasiswa Katolik."
   * Status: Badge Kuning (`Coming Soon`)
   * Ketua: Maria Anastasia
   * Aksi: Tombol Kuning `" Hubungi Ketua"`

## Halaman Ketua UKM & UKK

Pengguna yang memiliki role Ketua dan NRP mahasiswa dapat mengakses Dashboard Ketua maupun Dashboard Mahasiswa melalui fitur Switch Dashboard pada Sidebar tanpa harus Logout. Pengguna dengan role Mahasiswa biasa hanya dapat mengakses Dashboard Mahasiswa. Setiap Ketua memiliki akun Login yang terhubung dengan organisasi tertentu.
Buat Dashboard Ketua dengan ketentuan:
1.	Menampilkan informasi organisasi yang dipimpin.
2.	Menampilkan jumlah anggota organisasi.
3.	Menampilkan daftar jadwal kegiatan organisasi.
4.	Menampilkan notifikasi permintaan bergabung dari mahasiswa.
5.	Setiap notifikasi menampilkan nama mahasiswa, NRP, dan waktu permintaan.
6.	Ketua hanya dapat melihat permintaan yang ditujukan kepada organisasinya.
7.	Sistem tidak boleh menyimpan permintaan yang sama berulang kali dari mahasiswa untuk organisasi yang sama.
8.	Ketika Admin telah menambahkan mahasiswa sebagai anggota, permintaan mahasiswa tersebut otomatis tidak ditampilkan lagi sebagai permintaan yang menunggu.

Ketua hanya bertugas melihat informasi dan notifikasi. Penambahan anggota tetap dilakukan melalui Admin.

### Gaya Visual Utama
* **Tata Letak**: Sidebar kiri tetap (fixed), Header atas, dan Area Konten Utama berisi kartu statistik, notifikasi, serta tabel jadwal.
* **Skema Warna**:
  * **Sidebar**: Latar belakang hitam/abu-abu sangat gelap dengan teks putih. Item aktif ("Notifikasi Permintaan") menggunakan latar kuning dengan teks hitam. Teks logout berwarna merah.
  * **Header**: Latar belakang kuning terang dengan teks hitam/gelap.
  * **Area Utama**: Latar belakang abu-abu sangat terang (light gray) dengan card/panel berwarna putih.
* **Elemen Switcher**: Box kontainer gelap di sidebar ("Pilih Tampilan") berisi dua tombol mode role: "Dashboard Ketua" (aktif berlatar kuning) dan "Dashboard Mahasiswa".

### 1. Header (Top Navigation Bar)
* **Warna Latar**: Kuning terang.
* **Sisi Kiri**: Judul halaman "Dashboard Ketua UKM / UKK".
* **Sisi Kanan**: Informasi akun pengguna ("Budi Santoso / Mode Ketua Organisasi").

### 2. Sidebar Navigasi (Left Sidebar)
* **Branding (Atas)**:
  * Judul utama: "BEM ABSENSI" (bold)
  * Sub-judul: "UKM & UKK Attendance System"
* **Role Switcher ("Pilih Tampilan")**:
  * Tombol 1: "Dashboard Ketua" (Aktif: latar kuning, teks hitam)
  * Tombol 2: "Dashboard Mahasiswa" (outline/dark)
* **Menu Navigasi**:
  * **Notifikasi Permintaan** (Aktif: latar kuning, bentuk pill/rounded, teks gelap)
* **Menu Bawah**:
  * **Logout** (Teks merah di bagian bawah sidebar)

### 3. Area Konten Utama (Main Content Area)

#### A. Header Konten (Welcome Section)
* **Judul**: "Halo, Budi Santoso!"
* **Deskripsi**: "Dashboard Ketua UKM Basket. Di sini notifikasi mahasiswa yang ingin bergabung akan muncul."

#### B. Kartu Statistik (Stat Cards Grid)
2 kartu ringkasan statistik (latar putih, sudut membulat, shadow halus, ikon berlatar bundar di kanan atas):
1. **Permintaan Bergabung**: `0` (Ikon lonceng kuning)
2. **Anggota Organisasi**: `2` (Ikon orang/grup hijau)

#### C. Card "Notifikasi Calon Anggota"
Panel khusus untuk pemantauan pendaftaran calon anggota:
* **Judul Panel**: "Notifikasi Calon Anggota" (disertai ikon lonceng di sebelah kiri).
* **Keterangan**: "Permintaan berikut dikirim mahasiswa melalui tombol Hubungi Ketua. Hubungi Admin untuk proses penambahan anggota. Saat Admin menambahkan mahasiswa sebagai anggota, permintaan otomatis tidak ditampilkan lagi."
* **Empty State (Tampilan Kosong)**:
  * Ikon lonceng dicoret di bagian tengah.
  * Teks abu-abu: `"Belum ada permintaan bergabung untuk organisasi Anda."`

#### D. Card "Jadwal Kegiatan UKM Basket"
Panel daftar agenda/kegiatan organisasi yang dipimpin:
* **Judul Panel**: "Jadwal Kegiatan UKM Basket" (Teks tebal/bold).
* **Tabel Kegiatan**:
  * **Kolom**: Nama Kegiatan | Tanggal | Jam | Lokasi
  * **Baris Data**:
    * `Latihan Basket` | `2026-11-01` | `15:00–17:00` | `GOR Kampus`