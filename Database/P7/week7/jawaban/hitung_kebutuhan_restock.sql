DELIMITER $$

CREATE
    /*[DEFINER = { user | CURRENT_USER }]*/
    FUNCTION `db_supermarket`.`hitung_kebutuhan_restock`(
	total_terjual INT,
	stok INT
    )
    RETURNS INT
    DETERMINISTIC
    
    /*LANGUAGE SQL
    | [NOT] DETERMINISTIC
    | { CONTAINS SQL | NO SQL | READS SQL DATA | MODIFIES SQL DATA }
    | SQL SECURITY { DEFINER | INVOKER }
    | COMMENT 'string'*/
    BEGIN
    
    DECLARE jumlah_pesan INT;

    IF total_terjual >= 100 AND stok <= 20 THEN
        SET jumlah_pesan = 100;

    ELSEIF total_terjual >= 50 AND stok <= 10 THEN
        SET jumlah_pesan = 50;

    ELSEIF total_terjual < 50 AND stok <= 10 THEN
        SET jumlah_pesan = 10;

    ELSE
        SET jumlah_pesan = 0;

    END IF;

    RETURN jumlah_pesan;

    END$$

DELIMITER ;