DROP PROCEDURE IF EXISTS ventas_timer_reporte_estructura;
DELIMITER $$
CREATE PROCEDURE ventas_timer_reporte_estructura(
    in_indice VARCHAR(300),
    in_lineas VARCHAR(100)
)
BEGIN
    DECLARE ou_dato01, ou_dato02, ou_dato03, ou_dato04, ou_dato05, ou_dato06 INT DEFAULT 0;
    -- PROCESS
    -- -------------------------------- 1
    SET @sql_text1 = CONCAT('SELECT count(*) INTO @num FROM ', 'venta_', in_indice, ' d JOIN venta v ON v.id=d.id 
                             WHERE v.info_status=1 
                               AND d.aprobado_supervisor = 2
                               AND d.tramitacion_venta_validar = 2 
                               AND d.tramitacion_venta_cargar = 2 
                               AND d.tramitacion_postventa_validar = 2
                               AND d.tramitacion_postventa_citar = 2
                               AND d.tramitacion_postventa_intalar = 2
                             '                               
                           );
    IF in_lineas != '' THEN
       SET @sql_text1 = CONCAT( @sql_text1, ' AND v.lineal_id IN (', in_lineas , ') ');
    END IF;
    PREPARE stmt FROM @sql_text1;
    EXECUTE stmt;
    SET ou_dato01 = @num;
    DEALLOCATE PREPARE stmt
    ;
    -- -------------------------------- 2
    SET @sql_text1 = CONCAT('SELECT count(v.id) INTO @num FROM ', 'venta_', in_indice, ' d JOIN venta v ON v.id=d.id 
                             WHERE v.info_status=1 
                               AND d.aprobado_supervisor = 1
                               AND d.tramitacion_venta_validar = 2
                               AND d.tramitacion_venta_cargar = 2 
                               AND d.tramitacion_postventa_validar = 2
                               AND d.tramitacion_postventa_citar = 2
                               AND d.tramitacion_postventa_intalar = 2
                            '
                           );
    IF in_lineas != '' THEN
       SET @sql_text1 = CONCAT( @sql_text1, ' AND v.lineal_id IN (', in_lineas , ') ');
    END IF;
    PREPARE stmt FROM @sql_text1;
    EXECUTE stmt;
    SET ou_dato02 = @num;
    DEALLOCATE PREPARE stmt
    ;
    -- -------------------------------- 3
    SET @sql_text1 = CONCAT('SELECT count(*) INTO @num FROM ', 'venta_', in_indice, ' d JOIN venta v ON v.id=d.id 
                             WHERE v.info_status=1 
                               AND d.aprobado_supervisor = 1 
                               AND d.tramitacion_venta_validar = 1 
                               AND d.tramitacion_venta_cargar = 2 
                               AND d.tramitacion_postventa_validar = 2
                               AND d.tramitacion_postventa_citar = 2
                               AND d.tramitacion_postventa_intalar = 2
                            '
                            );
    IF in_lineas != '' THEN
       SET @sql_text1 = CONCAT( @sql_text1, ' AND v.lineal_id IN (', in_lineas , ') ');
    END IF;
    PREPARE stmt FROM @sql_text1;
    EXECUTE stmt;
    SET ou_dato03 = @num;
    DEALLOCATE PREPARE stmt
    ;
    -- -------------------------------- 4
    SET @sql_text1 = CONCAT('SELECT count(*) INTO @num FROM ', 'venta_', in_indice, ' d JOIN venta v ON v.id=d.id 
                             WHERE v.info_status=1 
                               AND d.aprobado_supervisor = 1 
                               AND d.tramitacion_venta_validar = 1 
                               AND d.tramitacion_venta_cargar = 1 
                               AND d.tramitacion_postventa_validar = 2
                               AND d.tramitacion_postventa_citar = 2
                               AND d.tramitacion_postventa_intalar = 2
                            '
                            );
    IF in_lineas != '' THEN
       SET @sql_text1 = CONCAT( @sql_text1, ' AND v.lineal_id IN (', in_lineas , ') ');
    END IF;
    PREPARE stmt FROM @sql_text1;
    EXECUTE stmt;
    SET ou_dato04 = @num;
    DEALLOCATE PREPARE stmt
    ;
    -- -------------------------------- 5
    SET @sql_text1 = CONCAT('SELECT count(*) INTO @num FROM ', 'venta_', in_indice, ' d JOIN venta v ON v.id=d.id 
                             WHERE v.info_status=1 
                               AND d.aprobado_supervisor = 1 
                               AND d.tramitacion_venta_validar = 1 
                               AND d.tramitacion_venta_cargar = 1 
                               AND d.tramitacion_postventa_validar = 1
                               AND d.tramitacion_postventa_citar = 2
                               AND d.tramitacion_postventa_intalar = 2
                            '
                            );
    IF in_lineas != '' THEN
       SET @sql_text1 = CONCAT( @sql_text1, ' AND v.lineal_id IN (', in_lineas , ') ');
    END IF;
    PREPARE stmt FROM @sql_text1;
    EXECUTE stmt;
    SET ou_dato05 = @num;
    DEALLOCATE PREPARE stmt
    ;
    -- -------------------------------- 6
    SET @sql_text1 = CONCAT('SELECT count(*) INTO @num FROM ', 'venta_', in_indice, ' d JOIN venta v ON v.id=d.id 
                             WHERE v.info_status=1 
                               AND d.aprobado_supervisor = 1 
                               AND d.tramitacion_venta_validar = 1 
                               AND d.tramitacion_venta_cargar = 1 
                               AND d.tramitacion_postventa_validar = 1
                               AND d.tramitacion_postventa_citar = 1
                               AND d.tramitacion_postventa_intalar = 2
                            '
                            );
    IF in_lineas != '' THEN
       SET @sql_text1 = CONCAT( @sql_text1, ' AND v.lineal_id IN (', in_lineas , ') ');
    END IF;
    PREPARE stmt FROM @sql_text1;
    EXECUTE stmt;
    SET ou_dato06 = @num;
    DEALLOCATE PREPARE stmt
    ;
    -- ----------------------------------------------------------------------------- OUT
    SELECT in_indice, ou_dato01, ou_dato02, ou_dato03, ou_dato04, ou_dato05, ou_dato06
    ;
END $$
DELIMITER ;

SET @indice = 'campania_001', @lineas= ' ' ;
CALL ventas_timer_reporte_estructura(
     @indice, @lineas
)
;
