DELIMITER $$

CREATE
    /*[DEFINER = { user | CURRENT_USER }]*/
    PROCEDURE `limbuscompanydb`.`sp_status_sinner`(
	IN p_sinner_id INT,           -- ID yang mau dicek
	OUT p_total_id INT,           -- Akan berisi jumlah ID
	OUT p_status VARCHAR(20)      -- Akan berisi status 'Veteran'/'Newbie'
    )
    /*LANGUAGE SQL
    | [NOT] DETERMINISTIC
    | { CONTAINS SQL | NO SQL | READS SQL DATA | MODIFIES SQL DATA }
    | SQL SECURITY { DEFINER | INVOKER }
    | COMMENT 'string'*/
	BEGIN
	    -- Menggunakan SET untuk mengisi variabel internal
	    DECLARE v_count INT;
	    
	    -- Menghitung jumlah identity sinner tersebut
	    SELECT COUNT(*) INTO v_count 
	    FROM identities 
	    WHERE sinner_id = p_sinner_id;
	    
	    -- Memasukkan hasil hitungan ke parameter OUT
	    SET p_total_id = v_count;
	    
	    -- Logika IF-ELSE
	    IF v_count >= 2 THEN
		SET p_status = 'VETERAN';
	    ELSE
		SET p_status = 'NEWBIE';
	    END IF;
	END$$

DELIMITER ;