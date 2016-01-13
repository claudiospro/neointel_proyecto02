INSERT INTO cliente(id, nombre, documento, documento_tipo, correo)
VALUES(1, 'Juan Perez', '777777777', 'nif', 'correo@gmail.com')
;

INSERT INTO cliente_telefono(id, cliente_id, numero, tipo)
VALUES(1, 1, '999 999 999', 'movil')
;

INSERT INTO ven_producto(id, nombre, campania_id)
VALUES(1, 'Producto01', 1)
;

INSERT INTO ven_estado(id, nombre)
VALUES (1, 'pendiente'), (2, 'instalada')
;

INSERT INTO ven_provincia(id, nombre)
VALUES(1, 'Provincia 01')
;

INSERT INTO ven_localidad(id, nombre, provincia_id, codigo_postal)
VALUES(1, 'Localidad 01', 1, '1108')
;

INSERT INTO ven_direccion(id, nombre, localidad_id)
VALUES(1, 'Direccion 01', 1)
;

INSERT INTO ven_venta(id, estado_id, cliente_id, alta_nueva, direccion_id, localidad_id, provincia_id, codigo_postal, telefono_fijo, telefono_movil, producto_id, observaciones, asesor_comercial_id, tramitacion_id, supervisor_id, fecha_agendada, fecha_venta, fecha_instalacion, fecha_cancelacion)
VALUES(1, 1, 1, '6777709', 1, 1, 1, '1208', '55555555', '999999999', 1, 'observaciones', 2, 3, 4, '2016-01-13 18:30:00', '2016-01-13', '2016-01-15', '0000-00-00')
;
