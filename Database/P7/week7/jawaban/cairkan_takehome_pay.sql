DELIMITER $$

CREATE
    /*[DEFINER = { user | CURRENT_USER }]*/
    PROCEDURE `db_supermarket`.`cairkan_takehome_pay`(
	IN id_pegawai INT,
	OUT STATUS VARCHAR(255),
	INOUT budget DECIMAL(15,2)
    )
    /*LANGUAGE SQL
    | [NOT] DETERMINISTIC
    | { CONTAINS SQL | NO SQL | READS SQL DATA | MODIFIES SQL DATA }
    | SQL SECURITY { DEFINER | INVOKER }
    | COMMENT 'string'*/
BEGIN
	
    DECLARE v_takehome DECIMAL(15,2);
    DECLARE v_count INT;

    SELECT COUNT(*)
    INTO v_count
    FROM kalkulasi_gaji_akhir
    WHERE employee_id = id_pegawai;

    IF v_count = 0 THEN
        SET STATUS = 'Karyawan tidak valid atau belum memiliki transaksi';
    ELSE

        SELECT take_home_pay
        INTO v_takehome
        FROM kalkulasi_gaji_akhir
        WHERE employee_id = id_pegawai;

        IF budget >= v_takehome THEN

            UPDATE employees
            SET salary = v_takehome
            WHERE employee_id = id_pegawai;

            SET budget = budget - v_takehome;

            SET STATUS = CONCAT(
                'Gaji berhasil dicairkan. Budget tersisa: ',
                budget
            );

        ELSE

            SET STATUS = 'Pencairan gagal: Budget perusahaan tidak mencukupi';

        END IF;

    END IF;

END$$

DELIMITER ;