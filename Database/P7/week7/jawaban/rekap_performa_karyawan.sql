
CREATE
    /*[ALGORITHM = {UNDEFINED | MERGE | TEMPTABLE}]
    [DEFINER = { user | CURRENT_USER }]
    [SQL SECURITY { DEFINER | INVOKER }]*/
    VIEW `db_supermarket`.`rekap_performa_karyawan` 
    AS
    
SELECT
    e.employee_id,
    e.name AS nama_karyawan,
    e.shift,
    COUNT(s.sale_id) AS total_transaksi,
    SUM(p.amount_paid) AS total_revenue_berhasil
FROM employees e
JOIN sales s
    ON e.employee_id = s.employee_id
JOIN payments p
    ON s.sale_id = p.sale_id
WHERE p.status = 'Success'
GROUP BY
    e.employee_id,
    e.name,
    e.shift;
