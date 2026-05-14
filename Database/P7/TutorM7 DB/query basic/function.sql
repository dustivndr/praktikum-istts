DELIMITER $$

CREATE
    /*[DEFINER = { user | CURRENT_USER }]*/
    FUNCTION `limbuscompanydb`.`fn_get_sinner_name`(p_id INT)
    RETURNS VARCHAR(50)
    READS SQL DATA
    /*LANGUAGE SQL
    | [NOT] DETERMINISTIC
    | { CONTAINS SQL | NO SQL | READS SQL DATA | MODIFIES SQL DATA }
    | SQL SECURITY { DEFINER | INVOKER }
    | COMMENT 'string'*/
    BEGIN
	DECLARE v_name VARCHAR(50);
    
	SELECT NAME INTO v_name 
	FROM sinners 
	WHERE sinner_id = p_id;
	    
	RETURN v_name;
    END$$

DELIMITER ;