DELIMITER $$

CREATE
    /*[DEFINER = { user | CURRENT_USER }]*/
    PROCEDURE `limbuscompanydb`.`sp_tambah_sinner`(
	    IN p_number INT,
	    IN p_name VARCHAR(50),
	    IN p_literature VARCHAR(100)
    )
    /*LANGUAGE SQL
    | [NOT] DETERMINISTIC
    | { CONTAINS SQL | NO SQL | READS SQL DATA | MODIFIES SQL DATA }
    | SQL SECURITY { DEFINER | INVOKER }
    | COMMENT 'string'*/
	BEGIN
		INSERT INTO sinners (sinner_number, NAME, original_literature)
		VALUES (p_number, p_name, p_literature);
	END$$

DELIMITER ;