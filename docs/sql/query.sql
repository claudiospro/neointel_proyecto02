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
  d.producto
, d1.nombre producto_nombre 
-- , producto_observacion  
-- fijo  
, d.fijo_numero
, d.fijo_modalidad
, d2.nombre fijo_modalidad_nombre
-- movil
, d.movil_numero
, d.movil_modalidad
, d3.nombre movil_modalidad_nombre
, d.movil_tarifa
-- movil adicional 1
, d.movil_adicional_1_numero
, d.movil_adicional_1_modalidad
, d.movil_adicional_1_tarifa
-- movil adicional 2
, d.movil_adicional_2_numero
, d.movil_adicional_2_modalidad
, d.movil_adicional_2_tarifa
FROM venta_campania_001 d 
JOIN venta v ON v.id = d.id
JOIN venta_producto d1 ON d1.id  = d.producto
JOIN venta_modalidad d2 ON d2.id = d.fijo_modalidad
JOIN venta_modalidad d3 ON d3.id = d.movil_modalidad
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
