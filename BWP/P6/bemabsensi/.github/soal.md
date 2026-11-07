Buatlah website "BEM ABSENSI" menggunakan Laravel dan Blade Templating dengan desain menggunakan bootstrap v5.3.0. Website ini digunakan untuk menampilkan informasi Unit Kegiatan Mahasiswa (UKM) dan Unit Kegiatan Kerohanian (UKK) yang tersedia di kampus, beserta daftar anggota dan catatan kehadiran masing-masing organisasi.

Website ini hanya sebagai tampilan, sehingga tidak memerlukan fitur login, register, atau autentikasi pengguna. Semua data yang ditampilkan diambil dari Controller dan ditampilkan menggunakan Blade Templating.

## Data untuk controller (absensiController.php)

```
[
    'id' => 1,
    'name' => 'UKM Basket',
    'type' => 'UKM',
    'category' => 'Olahraga',
    'icon' => 'bi-dribbble',
    'status' => 'Open Recruitment',
    'description' => 'Organisasi mahasiswa yang bergerak di bidang olahraga basket.',
    'activities' => [
        'Latihan Rutin',
        'Friendly Match',
        'Turnamen Basket'
    ]
],
[
    'id' => 2,
    'name' => 'UKM Musik',
    'type' => 'UKM',
    'category' => 'Seni',
    'icon' => 'bi-music-note-beamed',
    'members' => 38,
    'status' => 'Coming Soon',
    'description' => 'Wadah mahasiswa untuk mengembangkan bakat musik.',
    'activities' => [
        'Latihan Band',
        'Music Workshop',
        'Konser Kampus'
    ]
],
[
    'id' => 3,
    'name' => 'UKM Fotografi',
    'type' => 'UKM',
    'category' => 'Seni',
    'icon' => 'bi-camera',
    'members' => 27,
    'status' => 'Closed',
    'description' => 'Organisasi yang berfokus pada fotografi dan videografi.',
    'activities' => [
        'Photo Hunting',
        'Photography Workshop',
        'Pameran Foto'
    ]
],
[
    'id' => 4,
    'name' => 'UKM Coding',
    'type' => 'UKM',
    'category' => 'Teknologi',
    'icon' => 'bi-code-slash',
    'members' => 64,
    'status' => 'Open Recruitment',
    'description' => 'Komunitas mahasiswa yang tertarik dengan programming.',
    'activities' => [
        'Coding Class',
        'Hackathon',
        'Project Collaboration'
    ]
],
[
    'id' => 5,
    'name' => 'UKK Kerohanian Kristen',
    'type' => 'UKK',
    'category' => 'Kerohanian',
    'icon' => 'bi-people',
    'members' => 80,
    'status' => 'Open Recruitment',
    'description' => 'Organisasi kegiatan kerohanian mahasiswa Kristen.',
    'activities' => [
        'Persekutuan',
        'Retreat',
        'Kegiatan Sosial'
    ]
],
[
    'id' => 6,
    'name' => 'UKK Kerohanian Katolik',
    'type' => 'UKK',
    'category' => 'Kerohanian',
    'icon' => 'bi-heart',
    'members' => 70,
    'status' => 'Coming Soon',
    'description' => 'Organisasi kegiatan kerohanian mahasiswa Katolik.',
    'activities' => [
        'Misa Kampus',
        'Rekoleksi',
        'Bakti Sosial'
    ]
]

-----------------------------------------------------

[
    'organization_id' => 1,
    'nrp' => '1001',
    'name' => 'Andi Pratama',
    'date' => '2026-10-28',
    'check_in' => '08:00',
    'check_out' => '10:15',
    'status' => 'Lengkap',
    'duration' => '2j 15m'
],
[
    'organization_id' => 1,
    'nrp' => '1002',
    'name' => 'Budi Santoso',
    'date' => '2026-10-28',
    'check_in' => '08:05',
    'check_out' => '10:15',
    'status' => 'Lengkap',
    'duration' => '2j 10m'
],
[
    'organization_id' => 1,
    'nrp' => '1003',
    'name' => 'Citra Putri',
    'date' => '2026-10-28',
    'check_in' => '08:10',
    'check_out' => null,
    'status' => 'Belum Check-out',
    'duration' => null
],
[
    'organization_id' => 1,
    'nrp' => '1004',
    'name' => 'Dina Amelia',
    'date' => '2026-10-28',
    'check_in' => null,
    'check_out' => null,
    'status' => 'Tidak Hadir',
    'duration' => null
],
[
    'organization_id' => 2,
    'nrp' => '2001',
    'name' => 'Kevin Wijaya',
    'date' => '2026-10-28',
    'check_in' => '13:00',
    'check_out' => '15:00',
    'status' => 'Lengkap',
    'duration' => '2j 0m'
],
[
    'organization_id' => 2,
    'nrp' => '2002',
    'name' => 'Maria Jessica',
    'date' => '2026-10-28',
    'check_in' => '13:10',
    'check_out' => null,
    'status' => 'Belum Check-out',
    'duration' => null
],
[
    'organization_id' => 3,
    'nrp' => '3001',
    'name' => 'Steven Nathan',
    'date' => '2026-10-28',
    'check_in' => '09:00',
    'check_out' => '11:30',
    'status' => 'Lengkap',
    'duration' => '2j 30m'
],
[
    'organization_id' => 4,
    'nrp' => '4001',
    'name' => 'Felix Alexander',
    'date' => '2026-10-28',
    'check_in' => '10:00',
    'check_out' => '12:00',
    'status' => 'Lengkap',
    'duration' => '2j 0m'
],
[
    'organization_id' => 5,
    'nrp' => '5001',
    'name' => 'Grace Olivia',
    'date' => '2026-10-28',
    'check_in' => '16:00',
    'check_out' => '18:00',
    'status' => 'Lengkap',
    'duration' => '2j 0m'
],
[
    'organization_id' => 6,
    'nrp' => '6001',
    'name' => 'Michael Jonathan',
    'date' => '2026-10-28',
    'check_in' => null,
    'check_out' => null,
    'status' => 'Tidak Hadir',
    'duration' => null
]


------------------------------------------


[
    // UKM Basket (ID 1)
    ['nrp' => '1001', 'name' => 'Andi Pratama', 'organization_id' => 1],
    ['nrp' => '1002', 'name' => 'Budi Santoso', 'organization_id' => 1],
    ['nrp' => '1003', 'name' => 'Citra Putri', 'organization_id' => 1],
    ['nrp' => '1004', 'name' => 'Dina Amelia', 'organization_id' => 1],
    ['nrp' => '1005', 'name' => 'Rizky Saputra', 'organization_id' => 1],

    // UKM Musik (ID 2)
    ['nrp' => '2001', 'name' => 'Kevin Wijaya', 'organization_id' => 2],
    ['nrp' => '2002', 'name' => 'Maria Jessica', 'organization_id' => 2],
    ['nrp' => '2003', 'name' => 'Clara Felicia', 'organization_id' => 2],
    ['nrp' => '2004', 'name' => 'Samuel Wijaya', 'organization_id' => 2],

    // UKM Fotografi (ID 3)
    ['nrp' => '3001', 'name' => 'Steven Nathan', 'organization_id' => 3],
    ['nrp' => '3002', 'name' => 'Rachel Olivia', 'organization_id' => 3],
    ['nrp' => '3003', 'name' => 'Ardi Setiawan', 'organization_id' => 3],

    // UKM Coding (ID 4)
    ['nrp' => '4001', 'name' => 'Felix Alexander', 'organization_id' => 4],
    ['nrp' => '4002', 'name' => 'Bella Christina', 'organization_id' => 4],
    ['nrp' => '4003', 'name' => 'Dimas Pratama', 'organization_id' => 4],
    ['nrp' => '4004', 'name' => 'Ivan Jonathan', 'organization_id' => 4],
    ['nrp' => '4005', 'name' => 'Angela Putri', 'organization_id' => 4],

    // UKK Kerohanian Kristen (ID 5)
    ['nrp' => '5001', 'name' => 'Grace Olivia', 'organization_id' => 5],
    ['nrp' => '5002', 'name' => 'Olivia Patricia', 'organization_id' => 5],
    ['nrp' => '5003', 'name' => 'Daniel Christian', 'organization_id' => 5],

    // UKK Kerohanian Katolik (ID 6)
    ['nrp' => '6001', 'name' => 'Michael Jonathan', 'organization_id' => 6],
    ['nrp' => '6002', 'name' => 'Jonathan Samuel', 'organization_id' => 6],
    ['nrp' => '6003', 'name' => 'Natasha Clarissa', 'organization_id' => 6]
];
```

## Sidebar dan Layout
Sidebar harus ditampilkan pada seluruh halaman website dengan ketentuan:
1. Menampilkan nama website "BEM ABSENSI" beserta tulisan "UKM & UKK Directory".
2. Menggunakan background berwarna hitam dengan menu navigasi Home, Daftar UKM, dan Daftar UKK.
3. Menu yang sedang aktif memiliki background berwarna kuning.
4. Sidebar dibuat pada file terpisah dan dipanggil menggunakan @include.
5. Setiap halaman menggunakan master layout yang sama, dengan header berwarna kuning yang menampilkan judul halaman.

### Detail:
### Panel Navigasi Kiri (Sidebar)
- Posisi: Membentang secara vertikal menempati sekitar 20% sisi paling kiri layar, dari ujung atas hingga bawah.   
- Warna Latar: Abu-abu sangat gelap (mendekati hitam/hitam arang).   
- Header "BEM ABSENSI" & Subteks: Berada di posisi paling atas sidebar, rata kiri. 
- Teks utama berwarna putih dan tebal, sedangkan subteks di bawahnya berwarna putih dengan font yang lebih kecil.
- Dibawah header, terdapat garis tipis 1px berwarna kuning mustard yang membentang secara horizontal, memisahkan header dari menu navigasi dengan jarak padding sekitar 5-10px untuk semua sisi, terutama kiri-kanan.
- Menu Navigasi: Terdiri dari tiga menu utama yang disusun kebawah vertikal, yaitu Home, Daftar UKM, dan Daftar UKK.
- Menu Aktif: Menggunakan warna latar kuning mustard dengan teks dan ikon berwarna hitam.
- Menu Non-aktif: Menggunakan teks dan ikon berwarna abu-abu terang tanpa warna latar.

### Bar Atas (Top Header)

- Posisi: Membentang secara horizontal di bagian paling atas area konten utama (sisi kanan), menghubungkan batas sidebar kiri hingga ujung kanan layar.
- Warna Latar: Kuning mustard (seragam dengan warna menu "Home" yang aktif).


### Area Konten Utama (Main Content)
- Posisi: Menempati sisi kanan layar (sekitar 80% lebar layar) tepat di bawah Top Header kuning.   
- Warna Latar Utama: Abu-abu sangat muda (abu-abu keputihan/ off-white) yang memberikan kontras dengan elemen kartu di atasnya. 


## Halaman Home | route: "/"

Pada halaman ini tampilkan:
1. Welcome Banner yang berisi judul "Welcome to CampusConnect!", deskripsi singkat, dan ikon
yang berkaitan dengan kegiatan kampus.
2. Empat card statistik yang menampilkan:
    - Total UKM: Jumlah seluruh organisasi bertipe UKM.
    - Total UKK: Jumlah seluruh organisasi bertipe UKK.
    - Total Members: Jumlah mahasiswa yang terdaftar pada seluruh organisasi.
    - Open Recruitment: Jumlah organisasi dengan status Open Recruitment.
3. Seluruh statistik harus dihitung berdasarkan data dari Controller, bukan menggunakan angka yang ditulis secara manual pada Blade.
4. Section "Explore Organizations" yang berisi dua card, yaitu Unit Kegiatan Mahasiswa dan Unit Kegiatan Kerohanian.
5. Masing-masing card memiliki deskripsi singkat serta link "Lihat Semua UKM" dan "Lihat Semua
UKK" yang mengarahkan pengguna menuju halaman sesuai kategorinya.

### Detail:
### Bar Atas (Top Header)
- Posisi: Membentang secara horizontal di bagian paling atas area konten utama (sisi kanan), menghubungkan batas sidebar kiri hingga ujung kanan layar.
- Teks "Dashboard Overview": Berada di sisi kiri dalam bar kuning tersebut, menggunakan warna hitam.

### Card "Welcome..."
- Posisi: Berada di area paling atas dalam area konten utama, membentang lebar (horizontal) dari kiri ke kanan.
- Warna Latar: Putih.
- Teks: Judul rata kiri berwarna hitam (font tebal), deskripsi di bawahnya berwarna abu-abu sedang (font light).
- Ikon Topi Toga: Terletak di ujung kanan dalam kartu. Ikon berwarna hitam dengan latar belakang lingkaran berwarna kuning pucat.

### Baris Kartu Statistik (4 Metrik)
- Posisi: Terletak tepat di bawah kartu "Welcome", terdiri dari 4 kotak berukuran sama yang disejajarkan secara horizontal dalam satu baris.
- Warna Latar Kartu: Keempat kartu berwarna latar putih.
- Posisi Konten dalam Kartu: Teks judul dan angka berada di sisi kiri (teks abu-abu, angka hitam), sedangkan ikon berada di sisi kanan masing-masing kartu.   
- Warna Ikon:
    - Kartu 1 (Total UKM): Ikon biru dengan latar lingkaran biru muda/pastel.   
    - Kartu 2 (Total UKK): Ikon biru dengan latar lingkaran biru muda/pastel.
    - Kartu 3 (Total Members): Ikon hijau dengan latar lingkaran hijau muda/pastel.
    - Kartu 4 (Open Recruitment): Ikon ungu dengan latar lingkaran ungu muda/pastel.

## Halaman Daftar UKM | route: "/ukm"

Pada halaman ini, tampilkan seluruh organisasi yang termasuk dalam kategori UKM.
Setiap organisasi ditampilkan dalam bentuk card yang memuat:
1. Ikon organisasi.
2. Nama organisasi.
3. Kategori organisasi, seperti Olahraga, Seni, atau Teknologi.
4. Jumlah anggota yang dihitung berdasarkan data mahasiswa yang terdaftar pada organisasi tersebut.
5. Badge status pendaftaran organisasi.
6. Link "Lihat Detail" yang mengarahkan pengguna menuju halaman detail berdasarkan ID
organisasi.
Di bagian atas daftar, tampilkan judul "Daftar UKM", deskripsi singkat, serta jumlah organisasi UKM
yang sedang ditampilkan.

### Detail:
### Bar Atas (Top Header)
- Posisi & Warna: Membentang secara horizontal di bagian paling atas area konten utama dengan latar belakang berwarna kuning mustard.
- Teks: Terdapat teks "Daftar UKM" berwarna hitam yang diposisikan rata kiri.

### Header Card
- Posisi: Berada tepat di bawah bar atas kuning, membentang penuh dari kiri ke kanan area konten.   Warna Latar: Putih dengan sudut membulat (rounded corners).   
- Teks: Judul utama "Daftar UKM" dicetak tebal berwarna hitam, dengan subteks "Temukan Unit Kegiatan Mahasiswa yang sesuai dengan minat dan bakatmu." berwarna abu-abu di bawahnya.

### Judul Bagian dan Label Jumlah
- Posisi: Terletak di bawah kartu judul halaman, di atas deretan kartu UKM.
- Teks Kiri: Terdapat judul bagian "Semua UKM" berwarna hitam.
- Label Kanan: Di sisi kanan sejajar dengan judul bagian, terdapat badge atau label bertuliskan "4 Organisasi" dengan latar belakang kuning mustard dan teks hitam.

### Grid Kartu Daftar UKM (4 Kartu)
- Posisi & Tata Letak: Kartu-kartu disusun dalam format grid. Baris pertama berisi tiga kartu yang sejajar secara horizontal, dan baris kedua berisi satu kartu di posisi paling kiri.
- Gaya Umum Kartu: Semua kartu memiliki latar belakang putih dengan sudut membulat.   
- Struktur Isi Kartu (Berlaku untuk semua kartu):
    - Ikon: Terletak di pojok kiri atas, berwarna kuning kecokelatan dengan latar belakang kotak melengkung berwarna kuning pucat.
    - Judul & Kategori: Nama UKM dicetak tebal (hitam), di bawahnya terdapat kategori UKM (abu-abu).
    - Jumlah Anggota: Ikon pengguna kecil dan teks jumlah anggota (misal: "5 Members") berwarna abu-abu.
    - Badge Status: Badge yang menunjukkan status pendaftaran organisasi.
    - Tautan: Teks "Lihat Detail →" berwarna biru di bagian kiri bawah.
- Rincian Spesifik Masing-masing Kartu:
    - Kartu 1 (Kiri Atas): Judul "UKM Basket", kategori "Olahraga", ikon bola basket, "5 Members", dan label status "Open Recruitment" dengan teks putih berlatar hijau.   
    - Kartu 2 (Tengah Atas): Judul "UKM Musik", kategori "Seni", ikon tangga nada musik, "4 Members", dan label status "Coming Soon" dengan teks hitam berlatar kuning.  
    - Kartu 3 (Kanan Atas): Judul "UKM Fotografi", kategori "Seni", ikon kamera, "3 Members", dan label status "Closed" dengan teks putih berlatar merah.
    - Kartu 4 (Kiri Bawah): Judul "UKM Coding", kategori "Teknologi", ikon kode </>, "5 Members", dan label status "Open Recruitment" dengan teks putih berlatar hijau. 

## Halaman Daftar UKK | route: "/ukk"

Pada halaman ini, tampilkan seluruh organisasi yang termasuk dalam kategori UKK. Ketentuan tampilan sama seperti halaman Daftar UKM, tetapi data yang ditampilkan hanya organisasi dengan tipe UKK.

Halaman Daftar UKM dan Daftar UKK diperbolehkan menggunakan satu file Blade yang sama dengan data berbeda dari Controller. Status pendaftaran pada kedua halaman ditampilkan menggunakan Blade Conditional dengan ketentuan berikut:

| Status | Warna Badge | Bootstrap Class
|--------|-------------|----------------
| Open Recruitment | Hijau | bg-success
| Coming Soon | Kuning | bg-warning
| Closed | Merah | bg-danger

Seluruh card organisasi harus ditampilkan menggunakan Blade Loop dan bukan ditulis satu per satu.

### Detail:
* **Top Header:** Bar kuning *mustard* membentang horizontal dengan teks "Daftar UKK" berwarna hitam rata kiri.
* **Latar Belakang Utama:** Abu-abu sangat muda (*off-white*).
* **Kartu Judul "Daftar UKK":** Berada di posisi atas dengan latar putih sudut membulat, judul hitam tebal, dan teks deskripsi abu-abu.
* **Header Bagian "Semua UKK":**
    * Teks judul bagian "Semua UKK" berwarna hitam rata kiri.
    * Terdapat *badge* di ujung kanan sejajar dengan judul, menggunakan latar kuning *mustard* dan teks "2 Organisasi" hitam.
* **Grid Kartu Daftar Organisasi:** Terdiri dari 2 kartu berlatar putih yang disejajarkan secara horizontal:
    * **Elemen Umum:** Ikon garis kuning kecokelatan berlatar kuning pucat, judul UKK hitam tebal, kategori "Kerohanian" abu-abu, tautan "Lihat Detail &rarr;" biru.
    * **Kartu UKK Kerohanian Kristen:** Menggunakan ikon grup orang, "3 Members", dan *badge* status "Open Recruitment" (teks putih, latar hijau).
    * **Kartu UKK Kerohanian Katolik:** Menggunakan ikon bentuk hati, "3 Members", dan *badge* status "Coming Soon" (teks hitam, latar kuning).

## Halaman Detail Organisasi | route: "/organizations/{id}"

Halaman ini menampilkan rincian dari suatu organisasi (dalam contoh ini UKM Basket) yang terdiri dari beberapa bagian tabel dan daftar.

* **Top Header:** Bar membentang horizontal berwarna kuning *mustard* dengan teks "Organization Detail" berwarna hitam rata kiri.
* **Latar Belakang Utama:** Abu-abu sangat muda (*off-white*).
* **Tombol Navigasi:** Di bagian kiri atas area konten (di bawah *header* kuning), terdapat tombol putih dengan ikon panah kiri dan teks "Kembali ke Daftar UKM".

### Kartu "Daftar Mahasiswa"
* **Posisi:** Berada paling atas setelah tombol navigasi, dengan latar belakang kotak putih.
* **Header Kartu:** Judul "Daftar Mahasiswa" dicetak tebal berwarna hitam di sebelah kiri, dan terdapat *badge* kuning bertuliskan "5 Members" di ujung kanan.
* **Tabel Mahasiswa:** Menampilkan tabel dengan *header* berlatar abu-abu terang yang berisi tiga kolom: **No**, **NRP**, dan **Nama Mahasiswa**.
* **Isi Tabel:** Terdiri dari 5 baris data nama mahasiswa beserta NRP-nya, dengan warna baris selang-seling (putih dan abu-abu sangat pucat).

### Kartu "Organization Activities"
* **Posisi:** Terletak di tengah, tepat di bawah kartu Daftar Mahasiswa, berlatar belakang kotak putih.
* **Header Kartu:** Judul "Organization Activities" dicetak tebal berwarna hitam rata kiri.
* **Daftar Aktivitas:** Menampilkan daftar kegiatan yang disusun vertikal ke bawah dengan warna baris selang-seling (putih dan abu-abu sangat pucat). Terdapat tiga item aktivitas: "Latihan Rutin", "Friendly Match", dan "Turnamen Basket". Setiap item diawali dengan ikon bulat berwarna hijau.

### Kartu "Attendance Records"
* **Posisi:** Berada di bagian paling bawah halaman, berlatar belakang kotak putih.
* **Header Kartu:** Judul "Attendance Records" hitam tebal dengan subteks abu-abu "Daftar kehadiran anggota UKM Basket" di bawahnya. Di sudut kanan atas sejajar dengan judul, terdapat *badge* kuning bertuliskan "4 Records".
* **Tabel Kehadiran:** Memiliki *header* berlatar abu-abu terang dengan delapan kolom: **No**, **NRP**, **Nama Mahasiswa**, **Tanggal**, **Check-in**, **Check-out**, **Status**, dan **Durasi**.
* **Isi Tabel:** Menampilkan 4 baris data rekam kehadiran dengan berbagai elemen visual untuk status:
    * **Check-in/Check-out:** Menampilkan jam dengan warna hijau untuk *Check-in* dan warna merah untuk *Check-out*.
    * **Status "Lengkap":** Menggunakan *badge* warna hijau (terdapat pada 2 baris pertama).
    * **Status "Belum Check-out":** Menggunakan *badge* warna kuning (pada baris ke-3).
    * **Status "Tidak Hadir":** Menggunakan *badge* warna merah (pada baris ke-4).
    * **Durasi:** Ditampilkan menggunakan *badge* lonjong berwarna biru (untuk status yang sudah lengkap).

Pada halaman ini, tampilkan informasi lengkap organisasi berdasarkan ID yang dipilih dari halaman Daftar UKM atau Daftar UKK.

1. Organization Information

    Tampilkan informasi organisasi yang meliputi:
    - Ikon dan nama organisasi.
    - Tipe dan kategori organisasi.
    - Deskripsi organisasi.
    - Jumlah anggota.
    - Badge status pendaftaran sesuai ketentuan sebelumnya.

2. Organization Activities

    Tampilkan seluruh kegiatan organisasi berdasarkan data array yang tersedia pada Controller. Setiap kegiatan ditampilkan dalam bentuk list menggunakan Blade Loop.

3. Daftar Mahasiswa
Tampilkan daftar mahasiswa yang terdaftar pada organisasi tersebut dalam bentuk tabel dengan kolom:
    - No.
    - NRP.
    - Nama Mahasiswa.

    Nomor urut dapat ditampilkan menggunakan $loop->iteration. Jumlah anggota yang ditampilkan harus sesuai dengan data mahasiswa yang terdaftar pada organisasi tersebut.

4. Attendance Records
Tampilkan catatan kehadiran mahasiswa berdasarkan organisasi yang dipilih dalam bentuk tabel
dengan kolom:
    - No.
    - NRP.
    - Nama Mahasiswa.
    - Tanggal.
    - Check-in.
    - Check-out.
    - Status.
    - Durasi.

    Status kehadiran harus ditampilkan menggunakan Blade Conditional dengan ketentuan:

    | Status Kehadiran | Warna Badge |
    |------------------|-------------|
    | Lengkap          | Hijau (bg-success) |
    | Belum Check-out  | Kuning (bg-warning) |
    | Tidak Hadir      | Merah (bg-danger) |

    Apabila mahasiswa tidak memiliki waktu Check-in, Check-out, atau Durasi, tampilkan tanda "-" pada kolom yang bersangkutan.
    Di bagian atas tabel, tampilkan jumlah Attendance Records berdasarkan data kehadiran organisasi tersebut.

5. Navigasi Kembali
Sediakan tombol kembali dengan ketentuan:
    - Jika organisasi bertipe UKM, tombol mengarah ke halaman /ukm.
    - Jika organisasi bertipe UKK, tombol mengarah ke halaman /ukk.

    Seluruh organisasi harus menggunakan satu halaman Detail Blade yang sama. Jika ID organisasi tidak ditemukan, tampilkan halaman 404 Not Found.