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
- Teks "Dashboard Overview": Berada di sisi kiri dalam bar kuning tersebut, menggunakan warna hitam.

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