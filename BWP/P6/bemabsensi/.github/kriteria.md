# SCORE KRITERIA

## Route dan Controller (4)

0/2 Seluruh route “/” , “/ukm” , “/ukk” , “/organization{id}” berjalan dengan benar

0/1 Data pada Dashboard berhasil dihitung secara dinamis berdasarkan data organisasi danmahasiswa.

0/1 Data detail organisasi, detail mahasiswa, dan kehadiran berhasil diambil berdasarkan IDorganisasi yang dipilih

## Layout Blade dan Sidebar (5)

0/2 Terdapat satu master layout yang menggunakan @yield('content') dan @yield('title'), serta seluruh halaman menggunakan @extends dan @section.

0/2 Sidebar dibuat pada file terpisah, dipanggil menggunakan @include, serta seluruh navigasi berfungsi dengan benar.

0/1 Tampilan sidebar, menu aktif, dan judul halaman sesuai dengan ketentuan.

## Halaman Home (4)

0/1 Menampilkan Welcome Banner beserta judul, deskripsi, dan ikon.

0/2 Menampilkan 4 card statistik dengan jumlah yang benar berdasarkan data pada Controller.

0/1 Menampilkan 2 card Explorer Organizations beserta navigasi menuju halaman UKM dan UKK

## Halaman Daftar UKM dan UKK (5)

0/2 Halaman UKM hanya menampilkan seluruh UKM dan halaman UKK hanya menampilkan seluruh UKK menggunakan Blade Loop.

0/1 Setiap card menampilkan ikon, nama, kategori, jumlah anggota, serta jumlah organisasi yang ditampilkan sesuai data.

0/1 Badge status recruitment ditampilkan menggunakan Blade Conditional dengan warna yang sesuai.

0/1 Setiap card dapat ditekan dan mengarahkan pengguna menuju halaman detail sesuai ID organisasi.

## Halaman Detail Organisasi (7)

0/2 Menampilkan informasi organisasi secara lengkap beserta daftar kegiatan menggunakan Blade Loop.

0/1 Menampilkan tabel mahasiswa sesuai organisasi beserta nomor urut, NRP, dan nama mahasiswa.

0/2 Menampilkan tabel Attendance Records sesuai organisasi dengan seluruh informasi kehadiran yang lengkap.

0/1 Status kehadiran menggunakan Blade Conditional dengan warna sesuai ketentuan dan menampilkan "-" untuk data yang kosong.

0/1 Tombol kembali mengarah ke halaman Daftar UKM atau Daftar UKK sesuai tipe organisasi.