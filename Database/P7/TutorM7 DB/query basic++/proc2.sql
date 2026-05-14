DELIMITER $$

CREATE
    /*[DEFINER = { user | CURRENT_USER }]*/
    PROCEDURE `limbuscompanydb`.`sp_generate_stars`(
	INOUT p_star_string VARCHAR(100), -- Input text awal, Output bintangnya
	IN p_rarity INT                   -- Berapa kali looping dilakukan
    )
    /*LANGUAGE SQL
    | [NOT] DETERMINISTIC
    | { CONTAINS SQL | NO SQL | READS SQL DATA | MODIFIES SQL DATA }
    | SQL SECURITY { DEFINER | INVOKER }
    | COMMENT 'string'*/
	BEGIN
	    DECLARE v_counter INT DEFAULT 1; -- Inisialisasi variabel counter
    
	    -- Pakai SET untuk mengosongkan string awal (opsional)
	    SET p_star_string = '';
	    
	    -- Logika WHILE Loop
	    WHILE v_counter <= p_rarity DO
		SET p_star_string = CONCAT(p_star_string, '★'); -- Gabung string bintang
		SET v_counter = v_counter + 1;                  -- Tambah counter (increment)
	    END WHILE;
	END$$

DELIMITER ;