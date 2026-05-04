
-- soal 1

SELECT
	p.payment_method,
	SUM(p.amount_paid) AS total_uang_diterima,
	COUNT(p.payment_id) AS frekuensi_transaksi
FROM payments p
WHERE p.status LIKE 'success'
GROUP BY p.payment_method
HAVING 
	frekuensi_transaksi > 5 AND 
	AVG(p.amount_paid) > 300000;
	

-- soal 2

SELECT
	CONCAT(e.name, ' (SHIFT: ', UPPER(e.shift), ')') AS profil_karyawan,
	CONCAT('Rp ', SUM(s.total_amount)) AS total_penjualan,
	CONCAT(SUM(s.total_items), ' items') AS total_items_terjual,
	ROUND(AVG(s.total_amount), 2) AS rata_rata_penjualan,
	ROUND(AVG(s.total_items), 1) AS rata_rata_items_terjual,
	COUNT(s.sale_id) AS jumlah_transaksi
FROM employees e, sales s
WHERE 
	e.employee_id = s.employee_id AND
	s.status = 'completed'
GROUP BY s.employee_id
HAVING
	SUM(s.total_amount) BETWEEN 1000000 AND 4000000
	AND COUNT(s.sale_id) > 1;


-- soal 3

SELECT
    CONCAT('VND-', UPPER(LEFT(s.supplier_name, 3)), '-', s.supplier_id) AS kode_vendor,
    SUM(st.quantity) AS total_stok_gudang,
    ROUND(SUM(st.quantity * p.unit_price), 2) AS valuasi_stok
FROM suppliers s, supplier_products sp, products p, stocks st
WHERE 
    s.supplier_id = sp.supplier_id
    AND sp.product_id = p.product_id
    AND p.product_id = st.product_id
    AND s.status = 'active'
GROUP BY s.supplier_id
HAVING 
    SUM(st.quantity) > 1000
    OR AVG(p.unit_price) < 15000
ORDER BY valuasi_stok DESC;


-- soal 4

SELECT
    c.category_name,
    COUNT(DISTINCT p.product_id) AS jumlah_varian_produk,
    SUM(st.quantity) AS total_stok_kategori,
    ROUND(MAX(p.unit_price - sp.supply_price), 2) AS margin_tertinggi,
    ROUND(MIN(p.unit_price - sp.supply_price), 2) AS margin_terendah,
    ROUND(AVG(p.unit_price - sp.supply_price), 0) AS rata_rata_margin
FROM categories c, products p, stocks st, supplier_products sp
WHERE 
    c.category_id = p.category_id
    AND p.product_id = st.product_id
    AND p.product_id = sp.product_id
    AND p.is_active = 1
GROUP BY c.category_id
HAVING 
    SUM(st.quantity) < 2000
    AND AVG(p.unit_price - sp.supply_price) > 1000
    AND COUNT(DISTINCT p.product_id) > 1
ORDER BY rata_rata_margin DESC;


-- soal 5

SELECT
    c.category_name,
    p.product_name,
    COUNT(sd.sale_id) AS jumlah_kali_terjual,
    SUM(sd.quantity) AS total_jumlah_terjual,
    ROUND(SUM(sd.quantity * sd.price_at_sale), 2) AS total_omset_produk,
    ROUND(SUM(sd.quantity * sd.price_at_sale) / SUM(sd.quantity), 0) AS harga_rata_rata_aktual
FROM categories c, products p, sale_details sd, sales s
WHERE 
    c.category_id = p.category_id
    AND p.product_id = sd.product_id
    AND sd.sale_id = s.sale_id
    AND s.status = 'completed'
GROUP BY p.product_id
HAVING 
    SUM(sd.quantity) > 10
    AND (SUM(sd.quantity * sd.price_at_sale) / SUM(sd.quantity)) > 15000
ORDER BY total_omset_produk DESC;

