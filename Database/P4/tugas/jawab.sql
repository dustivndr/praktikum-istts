# soal 1

SELECT CONCAT('STRUK-', sales.sale_id, ' : Bpk/Ibu ', cstm.name, ' membeli ', prod.product_name, ' seharga Rp', sd.price_at_sale) AS Detail_Struk
FROM customers cstm, sales, sale_details sd, products prod

WHERE sales.status='completed' AND sales.customer_id=cstm.customer_id 
 AND sales.sale_id=sd.sale_id AND sd.product_id=prod.product_id 
 AND prod.unit_price >= 50000
 AND cstm.membership_type NOT LIKE 'regular'

ORDER BY sd.price_at_sale DESC, cstm.name ASC;


# soal 2

SELECT LPAD(emp.employee_id, 4, '0') AS ID_Pegawai,
 UPPER(pay.payment_method) AS Tipe_Bayar,
 RPAD(prod.product_name, 20, '-') AS Nama_Item
 
FROM employees emp, payments pay, sales, sale_details sd, products prod

WHERE emp.shift = 'night'
 AND pay.status = 'Success' AND pay.sale_id = sales.sale_id
 AND sales.employee_id = emp.employee_id AND sales.sale_id = sd.sale_id
 AND sd.product_id = prod.product_id AND sd.quantity >= 3

ORDER BY pay.amount_paid DESC;


# soal 3

SELECT 
 CONCAT(cat.category_name, ' dipasok oleh ', sup.supplier_name) AS Info_Pasokan, 
 DATE_FORMAT(pur.purchase_date ,'%Y/%m/%d') AS Waktu_Beli

FROM 
 products p, 
 suppliers sup, 
 supplier_products sp,
 purchases pur, 
 categories cat

WHERE 
 sup.supplier_id = pur.supplier_id 
 AND sup.supplier_id = sp.supplier_id 
 AND sp.product_id = p.product_id 
 AND p.category_id = cat.category_id 
 AND sup.status = 'active' 
 AND sup.city NOT LIKE 'Jakarta'
 AND pur.total_amount BETWEEN 1500000 AND 5000000 

ORDER BY 
 SUBSTRING_INDEX(sup.supplier_name, ' ', -1), 
 pur.purchase_date DESC;


# soal 4

SELECT CONCAT('Pelanggan ', c.name, ' memborong ', cat.category_name) AS Info_Belanja,
 RPAD(p.product_name, 25, '_') AS Barang,
 pay.amount_paid
  
FROM 
 customers c,
 sales s,
 sale_details sd,
 products p,
 categories cat,
 payments pay

WHERE 
 c.customer_id = s.customer_id
 AND s.sale_id = sd.sale_id
 AND sd.product_id = p.product_id
 AND p.category_id = cat.category_id
 AND s.sale_id = pay.sale_id
 AND c.gender = 'female'
 AND c.membership_type = 'platinum'
 AND cat.category_name IN ('Perawatan Diri', 'Kebutuhan Bayi')
 AND pay.amount_paid > 200000
 AND pay.status = 'Success'
 AND s.status = 'completed'

ORDER BY pay.amount_paid DESC, p.product_name ASC;


# soal 5

SELECT
 CONCAT('INV-2026-', LPAD(s.sale_id, 4, '0')) AS ID_Nota,
 CONCAT(UPPER(c.name), ' (', c.membership_type, ')') AS Profil_Pelanggan,
 CONCAT(LOWER(cat.category_name), '->', p.product_name) AS Detail_Item
 
FROM
 customers c,
 sales s,
 sale_details sd,
 products p,
 categories cat

WHERE
 c.customer_id = s.customer_id
 AND s.sale_id = sd.sale_id
 AND sd.product_id = p.product_id
 AND p.category_id = cat.category_id
 AND c.membership_type IN ('gold', 'platinum')
 AND s.sale_date BETWEEN '2026-03-25' AND '2026-03-31'
 AND cat.category_name NOT IN ('Cemilan', 'Minuman')
 AND s.status = 'completed'

ORDER BY
 LENGTH(c.name) DESC,
 RIGHT(p.product_name, 3) ASC,
 s.sale_date DESC;

