
-- soal 2

SELECT
    nama_karyawan,
    shift,
    total_transaksi,
    total_revenue_berhasil,
    hitung_insentif_karyawan(
        total_transaksi,
        total_revenue_berhasil,
        shift
    ) AS nominal_insentif
FROM rekap_performa_karyawan;



-- soal 3

SET @budget_saat_ini = 50000000.00;
SET @status_pencairan = '';
SET @id_pegawai = 4;

CALL cairkan_takehome_pay(
    @id_pegawai,
    @status_pencairan,
    @budget_saat_ini
);

SELECT
    @status_pencairan AS Pesan_Sistem,
    @budget_saat_ini AS Sisa_Budget_Perusahaan;

-- buat reset aj
/*
UPDATE employees
SET salary = 4500000
WHERE employee_id = 4;
*/




-- soal 4

SET @total_update = 0;
SET @pesan_status = '';
SET @id_pelanggan = 10;

CALL evaluasi_update_membership(
    @id_pelanggan,
    @pesan_status,
    @total_update
);

SELECT @pesan_status;



-- soal 5

SET @budget_operasional = 5000000.00;
SET @id_produk = 3;
SET @log_pesan = '';

CALL restock_produk(
    @id_produk,
    @log_pesan,
    @budget_operasional
);

SELECT
    @log_pesan AS Laporan_Sistem,
    @budget_operasional AS Sisa_Budget_Toko;

-- buat reset jg
/*
UPDATE stocks
SET quantity = quantity - 100
WHERE product_id = 3;
*/
