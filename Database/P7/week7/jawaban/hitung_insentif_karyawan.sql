DELIMITER $$

CREATE
    /*[DEFINER = { user | CURRENT_USER }]*/
    FUNCTION `db_supermarket`.`hitung_insentif_karyawan`(
	transaksi INT,
	revenue DECIMAL(15,2),
	shift_karyawan VARCHAR(20)
    )
    RETURNS DECIMAL(15,2)
    DETERMINISTIC
    
    /*LANGUAGE SQL
    | [NOT] DETERMINISTIC
    | { CONTAINS SQL | NO SQL | READS SQL DATA | MODIFIES SQL DATA }
    | SQL SECURITY { DEFINER | INVOKER }
    | COMMENT 'string'*/
    BEGIN
    
    DECLARE insentif DECIMAL(15,2);

    IF shift_karyawan = 'night' THEN
        
        IF revenue > 20000000 AND transaksi > 50 THEN
            SET insentif = revenue * 0.10;
        ELSE
            SET insentif = revenue * 0.05;
        END IF;

    ELSE
        
        IF revenue > 50000000 OR transaksi > 100 THEN
            SET insentif = revenue * 0.07;
        ELSE
            SET insentif = revenue * 0.02;
        END IF;

    END IF;

    RETURN insentif;

    END$$

DELIMITER ;