# cara buat dan gunakan database
DROP DATABASE IF EXISTS `db_sawit`
CREATE DATABASE `db_sawit`;
USE `db_sawit`; 

# buat tabel (tabel akan di drop jika sudah ada kemudian akan di create lagi)
DROP TABLE IF EXISTS users;
CREATE TABLE users( 
`id` INT NOT NULL AUTO_INCREMENT, 
`name` VARCHAR(255) NOT NULL, 
`uang` INT NOT NULL DEFAULT 0, 
`created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP, PRIMARY KEY (`id`) ); 

DROP TABLE IF EXISTS sawah;
CREATE TABLE sawah( 
`id` INT NOT NULL AUTO_INCREMENT, 
`user_id` INT NOT NULL, 
`nama_sawah` VARCHAR(255) NOT NULL, 
`luas` DOUBLE NOT NULL, 
`harga_sawah` INT NOT NULL, 
`pajak_sawah` INT, PRIMARY KEY (`id`) , 
FOREIGN KEY (`user_id`) REFERENCES `db_sawit`.`users`(`id`), 
CONSTRAINT `Cek_pajak_sawah` CHECK (pajak_sawah > 1000) );

# cara insert ke database
INSERT INTO `db_sawit`.`users` (`name`, `uang`, `created_at`) VALUES 
('Budi', '10000', '2026-02-02 22:55:46'),
('Jokowi', '484000', '2021-06-16 22:56:54'), 
('Bahlil', '12000', '2025-12-06 22:57:32'); 

INSERT INTO `db_sawit`.`sawah` (`user_id`, `nama_sawah`, `luas`, `harga_sawah`, `pajak_sawah`) VALUES 
('1', 'sawit sawit', '180', '19000', '1500'),
('2', 'sawit kalimantan', '800', '57000', '1500'), 
('3', 'sawit premium', '400', '30000', '2900'),
('2', 'gurun sawit', '225', '100000', '5000'); 

# jenis jenis tipe data
# Varchar (n) jumlah karakter yang di inginkan
# Char (n) sama seperti Varchar kalau tapi sisa panjang akan diganti white space
# Int 
# Float
# Text mirip varchar namun panjang text nya lebih panjang 65535 karakter dan bersifat case insensitive
# Date Data tanggal berformat YYYY-MM-DD
# current_timestamp()tahun-bulan-tanggal atau (YYYY-mm-dd) dan waktunya yang bersifat current

# penggunaan STR_TO_DATE
# %d	(tanggal dalam 2 digit)
# %M 	(nama bulan (januari, februari, dst.))
# %m 	(bulan dalam 2 digit)
# %Y 	(tahun dalam 4 digit)
# %y 	(tahun dalam 2 digit)
# %H 	(jam 00-23)
# %i 	(menit 00-59)
# %s 	(detik 00-59)

# Ngambil semua data dari table yang dipilih
SELECT * FROM users;
SELECT * FROM sawah;

# Ngambil kolom tabel data dari table yang dipilih
SELECT NAME FROM users;
SELECT id, nama_sawah, luas FROM sawah;
SELECT id, luas AS luas_sawah FROM sawah;

#===================================================#
# Operator Lain

# Uppercase
SELECT UPPER(NAME) AS nama_uppercased FROM users;

# Concat
SELECT CONCAT(NAME, ' punya uang ', uang) AS info_user FROM users;

# AND
SELECT * FROM users WHERE uang > 10000 AND NAME = 'Jokowi';

# OR
SELECT * FROM users WHERE NAME = 'Budi' OR NAME = 'Jokowi';

# Operator Perbandingan
SELECT * FROM sawah WHERE luas >= 300;
SELECT * FROM sawah WHERE harga_sawah != 30000;

# Between
SELECT * FROM sawah WHERE luas BETWEEN 200 AND 800;

# Substring
SELECT SUBSTRING(NAME, 1, 3) AS potongan FROM users;

# Substring Index
SELECT SUBSTRING_INDEX(NAME, 'o', 1) FROM users;

# Date Format
SELECT DATE_FORMAT(created_at, '%d-%m-%Y') AS tanggal FROM users; # hasil: 02-02-2026
SELECT 
  DAY(created_at) AS hari,
  MONTH(created_at) AS bulan,
  YEAR(created_at) AS tahun
FROM users;

# Length
SELECT NAME, LENGTH(NAME) AS panjang_nama FROM users;

# In
SELECT * FROM users WHERE NAME IN ('Budi', 'Jokowi');

# Not In
SELECT * FROM users WHERE NAME NOT IN ('Budi', 'Jokowi');

# Select Left 
SELECT LEFT(NAME, 4) FROM users; # Untuk contoh di sini di ambil 4 karakter pertama dari kolom name

# Select Right
SELECT RIGHT(NAME, 3) FROM users; # Untuk contoh di sini di ambil 3 karakter terakhir dari kolom name

# Where
SELECT * FROM sawah WHERE harga_sawah > 50000;

# Order By Ascending
SELECT * FROM users ORDER BY uang ASC;

# Order By Descending
SELECT * FROM users ORDER BY uang DESC;
 
#===================================================#
# Like
SELECT * FROM users WHERE NAME LIKE 'B%'; # yang di cari adalah yang di awali dengan huruf 'B'
SELECT * FROM users WHERE NAME LIKE '%i'; # yang di cari adalah yang di akhiri dengan huruf 'i'
SELECT * FROM sawah WHERE nama_sawah LIKE '%m%'; # yang di cari adalah yang mengandung huruf 'i'

# Contoh NOT LIKE
SELECT * FROM users WHERE NAME NOT LIKE 'B%';

#===================================================#
# Contoh Soal

# 1. Cari user Namanya mengandung huruf “o” atau “i”, Uangnya ≥ 10000, dan Panjang nama lebih dari 4 karakter
SELECT 
  id,
  UPPER(NAME) AS nama_besar,
  LENGTH(NAME) AS panjang,
  CONCAT(NAME, '_', uang) AS kode_user
FROM users
WHERE (NAME LIKE '%o%' OR NAME LIKE '%i%')
  AND uang >= 10000
  AND LENGTH(NAME) > 4
ORDER BY panjang DESC;

# 2. Cari user yang dibuat pada tahun 2022 atau lebih kemudian tampilkan tanggal dengan format dd-mm-yyyy dengan order descending
SELECT 
  id,
  NAME,
  DATE_FORMAT(created_at, '%d-%m-%Y') AS tanggal,
  YEAR(created_at) AS tahun
FROM users
WHERE YEAR(created_at) >= 2022
  AND MONTH(created_at) <= 12
ORDER BY created_at DESC;