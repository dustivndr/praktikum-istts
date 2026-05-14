DELIMITER $$

CREATE
    /*[DEFINER = { user | CURRENT_USER }]*/
    PROCEDURE `db_supermarket`.`evaluasi_update_membership`(
	IN id_pelanggan INT,
	OUT STATUS VARCHAR(255),
	INOUT jumlah_update INT
    )
    /*LANGUAGE SQL
    | [NOT] DETERMINISTIC
    | { CONTAINS SQL | NO SQL | READS SQL DATA | MODIFIES SQL DATA }
    | SQL SECURITY { DEFINER | INVOKER }
    | COMMENT 'string'*/
BEGIN
	
    DECLARE v_total_spent DECIMAL(15,2);
    DECLARE v_jumlah_transaksi INT;
    DECLARE v_membership_lama VARCHAR(20);
    DECLARE v_membership_baru VARCHAR(20);
    DECLARE v_count INT;
    
    SELECT
        c.total_spent,
        COUNT(s.sale_id),
        c.membership_type
    INTO
        v_total_spent,
        v_jumlah_transaksi,
        v_membership_lama
    FROM customers c
    LEFT JOIN sales s
        ON c.customer_id = s.customer_id
        AND s.status = 'completed'
    WHERE c.customer_id = id_pelanggan
    GROUP BY
        c.customer_id,
        c.total_spent,
        c.membership_type;

    -- cek customer valid
    IF v_total_spent IS NULL THEN

        SET STATUS = 'Customer tidak ditemukan';

    ELSE

        SET v_membership_baru =
            tentukan_level_membership(
                v_total_spent,
                v_jumlah_transaksi
            );

        IF v_membership_lama NOT LIKE v_membership_baru THEN

            UPDATE customers
            SET membership_type = v_membership_baru
            WHERE customer_id = id_pelanggan;

            SET jumlah_update = jumlah_update + 1;

            SET STATUS = CONCAT(
                'Berhasil! Membership diupdate dari ',
                v_membership_lama,
                ' menjadi: ',
                v_membership_baru
            );

        ELSE

            SET STATUS = CONCAT(
                'Membership tetap: ',
                v_membership_lama
            );

        END IF;

    END IF;

END$$

DELIMITER ;