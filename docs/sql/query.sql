-- cantidad total
SELECT 
  COUNT(v.id)
FROM venta_campania_001 d 
JOIN venta v ON v.id = d.id
WHERE 
    v.info_create_fecha LIKE '2016-04%'
AND v.info_status = 1
AND d.estado = 2 
AND d.aprobado_supervisor = 1 
AND d.tramitacion_venta_validar = 1
AND d.tramitacion_venta_cargar = 1 
AND d.tramitacion_postventa_validar = 1
AND d.tramitacion_postventa_citar = 1
AND d.tramitacion_postventa_intalar = 1
;


SELECT 

FROM venta_campania_001 d 
JOIN venta v ON v.id = d.id
WHERE 
    v.info_create_fecha LIKE '2016-04%'
AND v.info_status = 1
AND d.estado = 2 
AND d.aprobado_supervisor = 1 
AND d.tramitacion_venta_validar = 1
AND d.tramitacion_venta_cargar = 1 
AND d.tramitacion_postventa_validar = 1
AND d.tramitacion_postventa_citar = 1
AND d.tramitacion_postventa_intalar = 1
;
