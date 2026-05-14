
-- soal 1

SELECT 
    DATE_FORMAT(p.purchase_date, '%M-%Y') AS Bulan_Tahun,
    UPPER(s.supplier_name) AS NAMA_SUPPLIER,
    SUM(pd.quantity * pd.price) AS Total_Transaksi_Rp,
    ROUND(AVG(pd.price), 2) AS Rata_Rata_Harga_Item
FROM suppliers s
JOIN purchases p ON s.supplier_id = p.supplier_id
JOIN purchase_details pd ON p.purchase_id = pd.purchase_id
WHERE s.status = 'active'
GROUP BY 
    DATE_FORMAT(p.purchase_date, '%M-%Y'),
    s.supplier_name
HAVING SUM(pd.quantity * pd.price) > 2000000
ORDER BY Total_Transaksi_Rp DESC;


-- soal 2

SELECT 
    UPPER(c.category_name) AS Kategori,
    p.product_name AS Nama_Produk,
    SUM(pd.quantity) AS Total_Dibeli_Ke_Supplier,
    s.quantity AS Sisa_Stok_Gudang
FROM categories c
JOIN products p ON c.category_id = p.category_id
JOIN purchase_details pd ON p.product_id = pd.product_id
JOIN purchases pu ON pd.purchase_id = pu.purchase_id
JOIN stocks s ON p.product_id = s.product_id
GROUP BY 
    c.category_name,
    p.product_name,
    s.quantity
HAVING SUM(pd.quantity) > 2 * s.quantity
ORDER BY 
    c.category_name ASC,
    (SUM(pd.quantity) - s.quantity) DESC;


-- soal 3

SELECT 
    RPAD(d.courier_name, 20, '.') AS Nama_Kurir_Pad,
    SUM(d.delivery_fee) AS Total_Biaya_Pengiriman,
    COUNT(d.delivery_id) AS Jumlah_Pengiriman
FROM deliveries d
JOIN sales s ON d.sale_id = s.sale_id
JOIN customers c ON s.customer_id = c.customer_id
WHERE 
    d.delivery_status = 'delivered'
    AND c.membership_type IN ('gold', 'platinum')
GROUP BY d.courier_name
HAVING SUM(d.delivery_fee) > 30000
ORDER BY Total_Biaya_Pengiriman ASC;


-- soal 4

SELECT 
    CONCAT(UPPER(pr.promo_name), '-', YEAR(pr.start_date)) AS Kode_Promo,
    LOWER(p.product_name) AS Nama_Produk,
    SUM(sd.quantity) AS Total_Terjual,
    SUM(sd.subtotal) AS Total_Penjualan_Rp
FROM promotions pr
JOIN products p ON pr.product_id = p.product_id
JOIN sale_details sd ON p.product_id = sd.product_id
JOIN sales s ON sd.sale_id = s.sale_id
WHERE 
    s.status = 'completed'
    AND s.sale_date BETWEEN pr.start_date AND pr.end_date
GROUP BY pr.promo_id, p.product_id
HAVING SUM(sd.quantity) >= 5
ORDER BY Total_Penjualan_Rp DESC;


-- soal 5

SELECT 
    LOWER(c.category_name) AS Kategori,
    p.product_name AS Nama_Barang,
    pr.discount_percent AS Persentase_Diskon
FROM products p
JOIN categories c ON p.category_id = c.category_id
LEFT JOIN promotions pr ON p.product_id = pr.product_id
WHERE c.category_name IN ('Sembako', 'Minuman')
ORDER BY 
    c.category_name ASC,
    pr.discount_percent DESC;


-- soal 6

SELECT 
    CONCAT('NOTA-', DATE_FORMAT(s.sale_date, '%Y%m'), '-', 
	LPAD(s.sale_id, 4, '0')) 
	AS Nomor_Nota,
    c.name AS Pembeli,
    e.name AS Kasir_Bertugas,
    s.total_amount AS Nominal_Belanja
    #,d.delivery_id
FROM sales s
JOIN customers c ON s.customer_id = c.customer_id
JOIN employees e ON s.employee_id = e.employee_id
LEFT JOIN deliveries d ON s.sale_id = d.sale_id
WHERE 
    s.status = 'completed'
    AND d.delivery_id IS NULL
ORDER BY s.total_amount DESC;




