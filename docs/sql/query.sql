SELECT
  ve.info_create
, ve.fecha_venta
, ve.fecha_instalacion
, TIMESTAMPDIFF(DAY, '2016-01-13', ve.fecha_instalacion) dias_instalacion
, es.nombre estado_nombre
, ac.nombre asesor_comercial_nombre
, tr.nombre tramitacion_nombre
, ip.nombre inspector_nombre
, ve.telefono_fijo
, cl.nombre cliente_nombre
, cl.documento cliente_documento
, pr.nombre producto_nombre
, ca.nombre campania_nombre
--
, ve.id venta_id
, ve.estado_id
--
FROM ven_venta ve
LEFT JOIN ven_estado es ON es.id=ve.estado_id
LEFT JOIN cliente cl ON cl.id=ve.cliente_id
LEFT JOIN ven_producto pr ON pr.id=ve.producto_id
LEFT JOIN campania ca ON ca.id=pr.campania_id
LEFT JOIN usu_usuario ac ON ac.id=ve.asesor_comercial_id
LEFT JOIN usu_usuario tr ON tr.id=ve.tramitacion_id
LEFT JOIN usu_usuario ip ON ip.id=ve.supervisor_id
;


SELECT indice FROM campania WHERE info_status=1
;


SELECT
  d1.nombre campania
, d2.nombre producto
, d.cliente_nombre
, d3.nombre estado
, v.info_update_fecha fecha_actualizacion
, d.fecha_instalada
, d4.nombre asesor_venta
, d5.nombre tramitacion
, d6.nombre supervisor
, d7.nombre coordinador
FROM venta v
JOIN  venta_campania_001 d
-- definiciones
LEFT JOIN campania d1 ON d1.indice=v.campania
LEFT JOIN venta_producto d2 ON d2.id=d.producto
LEFT JOIN venta_estado d3 ON d3.id=d.estado
LEFT JOIN usu_usuario d4 ON d4.id=v.asesor_venta_id
LEFT JOIN usu_usuario d5 ON d5.id=v.tramitacion_id
LEFT JOIN usu_usuario d6 ON d6.id=v.supervisor_id
LEFT JOIN usu_usuario d7 ON d7.id=v.coordinador_id
WHERE v.campania = 'campania_001' 
  AND v.lineal_id IN (1) -- usuario
;
