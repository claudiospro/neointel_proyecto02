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
