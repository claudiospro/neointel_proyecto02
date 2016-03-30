DROP PROCEDURE IF EXISTS ventas_timer_reporte_estructura;
DELIMITER $$
CREATE PROCEDURE ventas_timer_reporte_estructura(
    in_campania_id BIGINT,
    in_lineas VARCHAR(100)
)
BEGIN
    DECLARE ou_campania, ou_indice VARCHAR(300) DEFAULT '';
    DECLARE ou_dato01, ou_dato02, ou_dato03 INT DEFAULT 0;
    -- PROCESS
    SELECT nombre, indice INTO ou_campania, ou_indice
    FROM campania WHERE id = in_campania_id
    ;
    SET @sql_text1 = CONCAT('SELECT count(*) INTO @num FROM ', 'venta_', ou_indice, ' d JOIN venta v ON v.id=d.id WHERE v.info_status=1 AND d.estado = 1 AND d.estado_tramitacion = 1');
    IF in_lineas != '' THEN
       SET @sql_text1 = CONCAT( @sql_text1, ' AND v.lineal_id IN ("', in_lineas , '") ');
    END IF;
    PREPARE stmt FROM @sql_text1;
    EXECUTE stmt;
    SET ou_dato01 = @num;
    DEALLOCATE PREPARE stmt
    ;
    SET @sql_text1 = CONCAT('SELECT count(*) INTO @num FROM ', 'venta_', ou_indice, ' d JOIN venta v ON v.id=d.id WHERE v.info_status=1 AND d.estado = 1 AND d.estado_tramitacion = 2');
    IF in_lineas != '' THEN
       SET @sql_text1 = CONCAT( @sql_text1, ' AND v.lineal_id IN ("', in_lineas , '") ');
    END IF;
    PREPARE stmt FROM @sql_text1;
    EXECUTE stmt;
    SET ou_dato02 = @num;
    DEALLOCATE PREPARE stmt
    ;
    SET @sql_text1 = CONCAT('SELECT count(*) INTO @num FROM ', 'venta_', ou_indice, ' d JOIN venta v ON v.id=d.id WHERE v.info_status=1 AND d.estado = 1 AND v.info_create_fecha >= "2016-03-07 00:00:00" AND d.estado_tramitacion = 3 ');
    IF in_lineas != '' THEN
       SET @sql_text1 = CONCAT( @sql_text1, ' AND v.lineal_id IN ("', in_lineas , '") ');
    END IF;
    PREPARE stmt FROM @sql_text1;
    EXECUTE stmt;
    SET ou_dato03 = @num;
    DEALLOCATE PREPARE stmt
    ;
    -- OUT
    SELECT ou_campania, ou_dato01, ou_dato02, ou_dato03
    ;
END $$
DELIMITER ;

-- SET @campania_id = 3, @lineas= '6' ;
-- CALL ventas_timer_reporte_estructura(
--      @campania_id, @lineas
-- )
-- ;

