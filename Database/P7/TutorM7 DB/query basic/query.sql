-- VIEW --
SELECT * FROM view_identity_lengkap;



-- PROC --
-- Menambah Sinner ke-7: Outis Menggunakan Proc--
CALL sp_tambah_sinner(7, 'Outis', 'Odyssey');

-- Cek apakah data masuk --
SELECT * FROM sinners;





-- Function --
-- Mengambil nama sinner dengan ID 1 --
SELECT fn_get_sinner_name(1) AS nama_sinner;

-- Menggabungkan dengan tabel lain --
SELECT ego_name, fn_get_sinner_name(sinner_id) AS pemilik FROM ego;