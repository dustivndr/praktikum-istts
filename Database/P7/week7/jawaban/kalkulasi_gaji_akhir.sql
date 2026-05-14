
CREATE
    /*[ALGORITHM = {UNDEFINED | MERGE | TEMPTABLE}]
    [DEFINER = { user | CURRENT_USER }]
    [SQL SECURITY { DEFINER | INVOKER }]*/
    VIEW `db_supermarket`.`kalkulasi_gaji_akhir` 
    AS


SELECT
    e.employee_id,
    e.name AS nama_karyawan,
    e.shift,
    e.salary AS gaji_pokok,
    r.total_transaksi,
    r.total_revenue_berhasil,
    hitung_insentif_karyawan(
        r.total_transaksi,
        r.total_revenue_berhasil,
        r.shift
    ) AS nominal_insentif,
    (
        e.salary +
        hitung_insentif_karyawan(
            r.total_transaksi,
            r.total_revenue_berhasil,
            r.shift
        )
    ) AS take_home_pay

FROM employees e
JOIN rekap_performa_karyawan r ON e.employee_id = r.employee_id;
