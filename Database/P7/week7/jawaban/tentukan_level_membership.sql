DELIMITER $$

CREATE
    /*[DEFINER = { user | CURRENT_USER }]*/
    FUNCTION `db_supermarket`.`tentukan_level_membership`(
	total_spent DECIMAL(15,2),
	jumlah_transaksi INT
    )
    RETURNS VARCHAR(20)
    DETERMINISTIC
    
    /*LANGUAGE SQL
    | [NOT] DETERMINISTIC
    | { CONTAINS SQL | NO SQL | READS SQL DATA | MODIFIES SQL DATA }
    | SQL SECURITY { DEFINER | INVOKER }
    | COMMENT 'string'*/
    BEGIN
    
    DECLARE level_membership VARCHAR(20);

    -- Platinum
    IF total_spent >= 50000000
       AND jumlah_transaksi >= 100 THEN

        SET level_membership = 'platinum';

    -- Gold
    ELSEIF total_spent >= 25000000
       OR jumlah_transaksi >= 50 THEN

        SET level_membership = 'gold';

    -- Regular
    ELSE

        SET level_membership = 'regular';

    END IF;

    RETURN level_membership;

    END$$

DELIMITER ;