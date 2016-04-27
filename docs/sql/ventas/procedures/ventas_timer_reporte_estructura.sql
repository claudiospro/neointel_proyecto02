DROP PROCEDURE IF EXISTS ventas_timer_reporte_estructura;
DELIMITER $$
CREATE PROCEDURE ventas_timer_reporte_estructura(
    in_indice VARCHAR(300),
    in_lineas VARCHAR(100)
)
BEGIN
    DECLARE ou_dato01, ou_dato02, ou_dato03 INT DEFAULT 0;
    -- PROCESS
    SET @sql_text1 = CONCAT('SELECT count(*) INTO @num FROM ', 'venta_', in_indice, ' d JOIN venta v ON v.id=d.id WHERE v.info_status=1 AND d.aprobado_supervisor = 2');
    IF in_lineas != '' THEN
       SET @sql_text1 = CONCAT( @sql_text1, ' AND v.lineal_id IN (', in_lineas , ') ');
    END IF;
    PREPARE stmt FROM @sql_text1;
    EXECUTE stmt;
    SET ou_dato01 = @num;
    DEALLOCATE PREPARE stmt
    ;
    SET @sql_text1 = CONCAT('SELECT count(v.id) INTO @num FROM ', 'venta_', in_indice, ' d JOIN venta v ON v.id=d.id WHERE v.info_status=1 AND d.aprobado_supervisor = 1 AND d.tramitacion_venta_validar = 2');
    IF in_lineas != '' THEN
       SET @sql_text1 = CONCAT( @sql_text1, ' AND v.lineal_id IN (', in_lineas , ') ');
    END IF;
    PREPARE stmt FROM @sql_text1;
    EXECUTE stmt;
    SET ou_dato02 = @num;
    DEALLOCATE PREPARE stmt
    ;
    SET @sql_text1 = CONCAT('SELECT count(*) INTO @num FROM ', 'venta_', in_indice, ' d JOIN venta v ON v.id=d.id WHERE v.info_status=1 AND d.aprobado_supervisor = 1 AND d.tramitacion_venta_validar = 1 AND d.tramitacion_venta_cargar = 2 ');
    IF in_lineas != '' THEN
       SET @sql_text1 = CONCAT( @sql_text1, ' AND v.lineal_id IN (', in_lineas , ') ');
    END IF;
    PREPARE stmt FROM @sql_text1;
    EXECUTE stmt;
    SET ou_dato03 = @num;
    DEALLOCATE PREPARE stmt
    ;
    -- OUT
    SELECT in_indice, ou_dato01, ou_dato02, ou_dato03
    ;
END $$
DELIMITER ;

SET @indice = 'campania_001', @lineas= ' ' ;
CALL ventas_timer_reporte_estructura(
     @indice, @lineas
)
;
