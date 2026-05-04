
-- Join Biasa --
/* 
   Query ini akan menampilkan daftar Sinner dan Identity mereka. 
   Jika ada Sinner yang belum memiliki Identity di tabel identities, 
   maka nama Sinner tersebut tidak akan muncul sama sekali. Begitu juga sebaliknya. 
   Hasil Join dibawah sama seperti hasil Where ini:
   
	SELECT sinners.name, identities.identity_name
	FROM sinners, identities
	WHERE sinners.sinner_id = identities.sinner_id;
*/
SELECT sinners.name, identities.identity_name
FROM sinners
JOIN identities ON sinners.sinner_id = identities.sinner_id;


-- Inner Join --
/* 
   Istilah aslinya join biasa. Pada SQLyog JOIN == INNER JOIN
*/
SELECT s.name, i.identity_name
FROM sinners s
INNER JOIN identities i ON s.sinner_id = i.sinner_id;


--  Left Join --
/* Query ini menampilkan semua Sinner yang ada di tabel sinners (tabel kiri). */
SELECT s.name, i.identity_name
FROM sinners s
LEFT JOIN identities i ON s.sinner_id = i.sinner_id;


-- Right Join --
/* Query ini akan menampilkan semua Faksi/Asosiasi yang ada di tabel factions (tabel kanan). */
SELECT f.faction_name, i.identity_name
FROM identities i
RIGHT JOIN factions f ON i.faction_id = f.faction_id;


-- Union Join / Full Outer Join --
/* 
   Menggunakan JOIN dan UNION untuk melihat semua Sinner (meskipun tidak punya Identity) 
   DAN semua Faksi (meskipun tidak punya anggota). Tidak ada data yang dibuang.
*/
SELECT s.name, i.identity_name
FROM sinners s
LEFT JOIN identities i ON s.sinner_id = i.sinner_id
UNION
SELECT s.name, i.identity_name
FROM sinners s
RIGHT JOIN identities i ON s.sinner_id = i.sinner_id;



-- Menggunakan untuk mencari null --
/* Kita melakukan LEFT JOIN dari Sinner ke E.G.O, lalu mencari kolom ego_id-nya yang kosong */
SELECT s.name
FROM sinners s
LEFT JOIN ego e ON s.sinner_id = e.sinner_id
WHERE e.ego_id IS NULL;


-- Join lebih dari 1 --
/*  
   Ini adalah cara kita menarik informasi lengkap dari seluruh database.
	1. Ambil nama Sinner (dari tabel sinners).
	2. Cari nama Identity-nya (dari tabel identities).
	3. Cari nama Faksi dari Identity tersebut (dari tabel factions).
*/
SELECT 
    s.name AS 'Sinner', 
    i.identity_name AS 'Identity', 
    f.faction_name AS 'Faction'
FROM sinners s
INNER JOIN identities i ON s.sinner_id = i.sinner_id
INNER JOIN factions f ON i.faction_id = f.faction_id;