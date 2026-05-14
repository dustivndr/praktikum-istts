
-- Proc sp_status_sinner dengan logika IN, OUT, dan SET --
-- Siapkan variabel penampung untuk OUT --
SET @jumlah = 0;
SET @stat = '';

-- Panggil procedure (Sinner ID 1 adalah Yi Sang) --
CALL sp_status_sinner(1, @jumlah, @stat);

-- Lihat hasilnya --
SELECT @jumlah AS total_id, @stat AS status_sinner;




-- Proc sp_generate_stars memakai WHILE LOOP --
-- Siapkan variabel awal --
SET @bintang = 'Bintangnya: ';

-- Panggil procedure untuk rarity 3 --
CALL sp_generate_stars(@bintang, 3);

-- Lihat hasilnya --
SELECT @bintang AS hasil_gacha; -- Output: ★★★