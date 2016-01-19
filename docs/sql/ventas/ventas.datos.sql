INSERT INTO cliente_nacionalidad(id, nombre)
VALUES(1, 'Española')
;

INSERT INTO cliente_documento_tipo(id, nombre)
VALUES(1, 'NIF')
;

-- no cambia
INSERT INTO cliente_tipo(id, nombre)
VALUES(1, 'Recidencial'), (2, 'Autonomo o Empresa')
;

INSERT INTO cliente(id, nombre, tipo_id, documento, documento_tipo_id, fecha_nacimiento, nacionalidad_id, correo)
VALUES(1, 'Juan Perez', 2, '777777777', 1, '1986-12-21', 1, 'correo@gmail.com')
;

INSERT INTO ven_producto(id, nombre, campania_id)
VALUES(1, 'Producto01', 1)
;

INSERT INTO ven_estado(id, nombre)
VALUES
( 1, 'Pendiente'),
( 2, 'Pendiente de Instalación'),
( 3, 'Pendiente de Documentación'),
( 4, 'En Tramitación'),
( 5, 'Cancelada'),
( 6, 'AutoInstalable'),
( 7, 'OK Tramitado')
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

INSERT INTO ven_direccion_tipo(id, nombre)
VALUES(1, 'Calle')
;

INSERT INTO ven_targeta_modalidad(id, nombre)
VALUES (1, 'Al tecnico'), (2, 'Verificacion')
;

INSERT INTO ven_cuenta_alta(id, nombre)
VALUES (1, 'Finacido'), (2, 'Un solo pago')
;

INSERT INTO ven_venta(
       id, cliente_id,
       telefono_contacto_fijo, telefono_contacto_movil,
       localidad_id, provincia_id, codigo_postal,
       direccion_id, direccion_tipo_id, direccion_numero, direccion_piso, direccion_puerta,  
       producto_id,
       tarjeta_tipo, tarjeta_modalidad_id, cuenta_alta_id,
       venta_detalles,
       asesor_comercial_id, tramitacion_id, supervisor_id,
       estado_id
       )
VALUES(
      1, 1,
      '9999999', '6666666',
      1, 1, '1101',
      1, 1, '12', '1', 'c2',
      1,
      1, 1, 1,
      'detalles de venta',
      5, 3, 4,
      2
)
;

-- No cambiara

INSERT INTO ven_venta_telefono_operador(id, nombre)
VALUES
(1, 'Euskaltel'),
(2, 'Movistar'),
(3, 'Orange'),
(4, 'R(Telecomunicaciones)'),
(5, 'Telecable'),
(6, 'Vodafone'),
(7, 'Yoigo'),
(8, 'Telecom'),
(9, 'Jazztel')
;

INSERT INTO ven_venta_telefono(
       id, venta_id, tipo,
       numero, operador_id,
       contacto, aportar
       )
VALUES (
       1, 1, 1,
       '99999', 1,
       1, 0
       )
;
