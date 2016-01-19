DROP TABLE IF EXISTS cliente_nacionalidad;
CREATE TABLE cliente_nacionalidad (
   info_create TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
   info_create_user INT DEFAULT 1,
   info_update TIMESTAMP,
   info_update_user INT,
   info_status TINYINT(1) DEFAULT 1,
   --
   id BIGINT NOT NULL AUTO_INCREMENT,
   nombre VARCHAR(600) NULL,
   --        
   PRIMARY KEY (id) 
) ENGINE = MYISAM
;

DROP TABLE IF EXISTS cliente_nacionalidad_history;
CREATE TABLE cliente_nacionalidad_history (
   info_create TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
   info_create_user INT DEFAULT 1,
   info_status TINYINT(1) DEFAULT 1,
   --
   id BIGINT NOT NULL AUTO_INCREMENT,
   history_id BIGINT,
   nombre VARCHAR(600) NULL,
   --        
   PRIMARY KEY (id) 
) ENGINE = MYISAM
;

DROP TABLE IF EXISTS cliente_documento_tipo;
CREATE TABLE cliente_documento_tipo (
   info_create TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
   info_create_user INT DEFAULT 1,
   info_update TIMESTAMP,
   info_update_user INT,
   info_status TINYINT(1) DEFAULT 1,
   --
   id BIGINT NOT NULL AUTO_INCREMENT,
   nombre VARCHAR(600) NULL,
   --        
   PRIMARY KEY (id) 
) ENGINE = MYISAM
;

DROP TABLE IF EXISTS cliente_documento_tipo_history;
CREATE TABLE cliente_documento_tipo_history (
   info_create TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
   info_create_user INT DEFAULT 1,
   info_status TINYINT(1) DEFAULT 1,
   --
   id BIGINT NOT NULL AUTO_INCREMENT,
   history_id BIGINT,
   nombre VARCHAR(600) NULL,
   --        
   PRIMARY KEY (id) 
) ENGINE = MYISAM
;

DROP TABLE IF EXISTS cliente_tipo;
CREATE TABLE cliente_tipo (
   info_status TINYINT(1) DEFAULT 1,
   --
   id BIGINT NOT NULL AUTO_INCREMENT,
   nombre VARCHAR(600) NULL,
   --        
   PRIMARY KEY (id) 
) ENGINE = MYISAM
;

DROP TABLE IF EXISTS cliente;
CREATE TABLE cliente (
   info_create TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
   info_create_user INT DEFAULT 1,
   info_update TIMESTAMP,
   info_update_user INT,
   info_status TINYINT(1) DEFAULT 1,
   --
   id BIGINT NOT NULL AUTO_INCREMENT,
   nombre VARCHAR(600) NULL,
   tipo_id BIGINT,
   documento VARCHAR(100) NULL,
   documento_tipo_id BIGINT,
   fecha_nacimiento VARCHAR(50),
   nacionalidad_id BIGINT,
   correo TEXT NULL,
   telefono_contacto_fijo VARCHAR(500),
   telefono_contacto_movil VARCHAR(500),
   --        
   PRIMARY KEY (id) 
) ENGINE = MYISAM
;

DROP TABLE IF EXISTS cliente_history;
CREATE TABLE cliente_history (
   info_create TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
   info_create_user INT DEFAULT 1,
   info_status TINYINT(1) DEFAULT 1,
   --
   id BIGINT NOT NULL AUTO_INCREMENT,
   history_id BIGINT NULL,
   nombre VARCHAR(600) NULL,
   tipo_id BIGINT,
   documento VARCHAR(100) NULL,
   documento_tipo_id BIGINT,
   fecha_nacimiento VARCHAR(50),
   nacionalidad_id BIGINT,
   correo TEXT NULL,
   telefono_contacto_fijo VARCHAR(500),
   telefono_contacto_movil VARCHAR(500),
   --        
   PRIMARY KEY (id) 
) ENGINE = MYISAM
;

DROP TABLE IF EXISTS ven_producto;
CREATE TABLE ven_producto (
   info_create TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
   info_create_user INT DEFAULT 1,
   info_update TIMESTAMP,
   info_update_user INT,
   info_status TINYINT(1) DEFAULT 1,
   --
   id BIGINT NOT NULL AUTO_INCREMENT,
   nombre VARCHAR(500),
   campania_id BIGINT,
   --        
   PRIMARY KEY (id) 
) ENGINE = MYISAM
;

DROP TABLE IF EXISTS ven_producto_history;
CREATE TABLE ven_producto_history (
   info_create TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
   info_create_user INT DEFAULT 1,
   info_status TINYINT(1) DEFAULT 1,
   --
   id BIGINT NOT NULL AUTO_INCREMENT,
   history_id BIGINT,
   nombre VARCHAR(500),
   campania_id BIGINT,
   --        
   PRIMARY KEY (id) 
) ENGINE = MYISAM
;

DROP TABLE IF EXISTS ven_estado;
CREATE TABLE ven_estado (
   info_status TINYINT(1) DEFAULT 1,
   --
   id BIGINT NOT NULL AUTO_INCREMENT,
   nombre VARCHAR(400),
   --        
   PRIMARY KEY (id)
) ENGINE = MYISAM
;

DROP TABLE IF EXISTS ven_provincia;
CREATE TABLE ven_provincia (
   info_create TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
   info_create_user INT DEFAULT 1,
   info_update TIMESTAMP,
   info_update_user INT,
   info_status TINYINT(1) DEFAULT 1,
   --
   id BIGINT NOT NULL AUTO_INCREMENT,
   nombre VARCHAR(400),
   --        
   PRIMARY KEY (id) 
) ENGINE = MYISAM
;

DROP TABLE IF EXISTS ven_provincia_history;
CREATE TABLE ven_provincia_history (
   info_create TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
   info_create_user INT DEFAULT 1,
   info_status TINYINT(1) DEFAULT 1,
   --
   id BIGINT NOT NULL AUTO_INCREMENT,
   history_id BIGINT,
   nombre VARCHAR(400),
   --        
   PRIMARY KEY (id) 
) ENGINE = MYISAM
;

DROP TABLE IF EXISTS ven_localidad;
CREATE TABLE ven_localidad (
   info_create TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
   info_create_user INT DEFAULT 1,
   info_update TIMESTAMP,
   info_update_user INT,
   info_status TINYINT(1) DEFAULT 1,
   --
   id BIGINT NOT NULL AUTO_INCREMENT,
   nombre VARCHAR(400),
   provincia_id BIGINT,
   codigo_postal VARCHAR(50),
   --        
   PRIMARY KEY (id) 
) ENGINE = MYISAM
;

DROP TABLE IF EXISTS ven_localidad_history;
CREATE TABLE ven_localidad_history (
   info_create TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
   info_create_user INT DEFAULT 1,
   info_status TINYINT(1) DEFAULT 1,
   --
   id BIGINT NOT NULL AUTO_INCREMENT,
   history_id BIGINT,
   nombre VARCHAR(400),
   provincia_id BIGINT,
   codigo_postal VARCHAR(50),
   --        
   PRIMARY KEY (id) 
) ENGINE = MYISAM
;

DROP TABLE IF EXISTS ven_direccion;
CREATE TABLE ven_direccion (
   info_create TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
   info_create_user INT DEFAULT 1,
   info_update TIMESTAMP,
   info_update_user INT,
   info_status TINYINT(1) DEFAULT 1,
   --
   id BIGINT NOT NULL AUTO_INCREMENT,
   nombre VARCHAR(400),
   localidad_id BIGINT,
   --        
   PRIMARY KEY (id) 
) ENGINE = MYISAM
;

DROP TABLE IF EXISTS ven_direccion_history;
CREATE TABLE ven_direccion_history (
   info_create TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
   info_create_user INT DEFAULT 1,
   info_status TINYINT(1) DEFAULT 1,
   --
   id BIGINT NOT NULL AUTO_INCREMENT,
   history_id BIGINT,
   nombre VARCHAR(400),
   localidad_id BIGINT,
   --        
   PRIMARY KEY (id) 
) ENGINE = MYISAM
;

DROP TABLE IF EXISTS ven_direccion_tipo;
CREATE TABLE ven_direccion_tipo (
   info_create TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
   info_create_user INT DEFAULT 1,
   info_update TIMESTAMP,
   info_update_user INT,
   info_status TINYINT(1) DEFAULT 1,
   --
   id BIGINT NOT NULL AUTO_INCREMENT,
   nombre VARCHAR(400),
   --        
   PRIMARY KEY (id) 
) ENGINE = MYISAM
;

DROP TABLE IF EXISTS ven_direccion_tipo_history;
CREATE TABLE ven_direccion_tipo_history (
   info_create TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
   info_create_user INT DEFAULT 1,
   info_status TINYINT(1) DEFAULT 1,
   --
   id BIGINT NOT NULL AUTO_INCREMENT,
   nombre VARCHAR(400),
   --        
   PRIMARY KEY (id) 
) ENGINE = MYISAM
;

DROP TABLE IF EXISTS ven_targeta_modalidad;
CREATE TABLE ven_targeta_modalidad (
   info_create TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
   info_create_user INT DEFAULT 1,
   info_update TIMESTAMP,
   info_update_user INT,
   info_status TINYINT(1) DEFAULT 1,
   --
   id BIGINT NOT NULL AUTO_INCREMENT,
   nombre VARCHAR(400),
   --        
   PRIMARY KEY (id) 
) ENGINE = MYISAM
;

DROP TABLE IF EXISTS ven_targeta_modalidad_history;
CREATE TABLE ven_targeta_modalidad_history (
   info_create TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
   info_create_user INT DEFAULT 1,
   info_status TINYINT(1) DEFAULT 1,
   --
   id BIGINT NOT NULL AUTO_INCREMENT,
   history_id BIGINT,
   nombre VARCHAR(400),
   --        
   PRIMARY KEY (id) 
) ENGINE = MYISAM
;

DROP TABLE IF EXISTS ven_cuenta_alta;
CREATE TABLE ven_cuenta_alta (
   info_create TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
   info_create_user INT DEFAULT 1,
   info_update TIMESTAMP,
   info_update_user INT,
   info_status TINYINT(1) DEFAULT 1,
   --
   id BIGINT NOT NULL AUTO_INCREMENT,
   nombre VARCHAR(400),
   --        
   PRIMARY KEY (id) 
) ENGINE = MYISAM
;

DROP TABLE IF EXISTS ven_cuenta_alta_history;
CREATE TABLE ven_cuenta_alta_history (
   info_create TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
   info_create_user INT DEFAULT 1,
   info_status TINYINT(1) DEFAULT 1,
   --
   id BIGINT NOT NULL AUTO_INCREMENT,
   history_id BIGINT,
   nombre VARCHAR(400),
   --        
   PRIMARY KEY (id) 
) ENGINE = MYISAM
;

DROP TABLE IF EXISTS ven_venta;
CREATE TABLE ven_venta (
   info_create TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
   info_create_user INT DEFAULT 1,
   info_update TIMESTAMP,
   info_update_user INT,
   info_status TINYINT(1) DEFAULT 1,
   --
   id BIGINT NOT NULL AUTO_INCREMENT,   
   cliente_id BIGINT,
   telefono_contacto_fijo VARCHAR(500),
   telefono_contacto_movil VARCHAR(500),
   -- ubigeo
   provincia_id BIGINT,
   localidad_id BIGINT,
   codigo_postal VARCHAR(50),
   direccion_id BIGINT,
   direccion_tipo_id BIGINT,
   direccion_numero VARCHAR(100),
   direccion_piso VARCHAR(100),
   direccion_puerta VARCHAR(100),
   -- venta
   venta_modalidad_id BIGINT,
   producto_id BIGINT,
   tarjeta_tipo BIGINT,
   tarjeta_modalidad_id BIGINT,
   cuenta_alta_id BIGINT,
   venta_detalles TEXT,
   -- responsables
   asesor_comercial_id BIGINT,
   tramitacion_id BIGINT,
   supervisor_id BIGINT,
   -- fechas
   fecha_agendada TIMESTAMP,
   fecha_venta TIMESTAMP,
   fecha_instalacion TIMESTAMP,
   fecha_cancelacion TIMESTAMP,
   -- estados
   estado_id BIGINT,
   --        
   PRIMARY KEY (id) 
) ENGINE = MYISAM
;

DROP TABLE IF EXISTS ven_venta_history;
CREATE TABLE ven_venta_history (
   info_create TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
   info_create_user INT DEFAULT 1,
   info_status TINYINT(1) DEFAULT 1,
   --
   id BIGINT NOT NULL AUTO_INCREMENT,
   history_id BIGINT,
   cliente_id BIGINT,
   telefono_contacto_fijo VARCHAR(500),
   telefono_contacto_movil VARCHAR(500),   
   -- ubigeo
   provincia_id BIGINT,
   localidad_id BIGINT,
   codigo_postal VARCHAR(50),
   direccion_id BIGINT,
   direccion_tipo_id BIGINT,
   direccion_numero VARCHAR(100),
   direccion_piso VARCHAR(100),
   direccion_puerta VARCHAR(100),
   -- venta
   venta_modalidad_id BIGINT,
   producto_id BIGINT,
   tarjeta_tipo BIGINT,
   tarjeta_modalidad_id BIGINT,
   cuenta_alta_id BIGINT,
   venta_detalles TEXT,
   -- responsables
   asesor_comercial_id BIGINT,
   tramitacion_id BIGINT,
   supervisor_id BIGINT,
   -- fechas
   fecha_agendada TIMESTAMP,
   fecha_venta TIMESTAMP,
   fecha_instalacion TIMESTAMP,
   fecha_cancelacion TIMESTAMP,
   -- estados
   estado_id BIGINT,
   --        
   PRIMARY KEY (id) 
) ENGINE = MYISAM
;

DROP TABLE IF EXISTS ven_venta_telefono_operador;
CREATE TABLE ven_venta_telefono_operador (
   info_create TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
   info_create_user INT DEFAULT 1,
   info_update TIMESTAMP,
   info_update_user INT,
   info_status TINYINT(1) DEFAULT 1,
   --
   id BIGINT NOT NULL AUTO_INCREMENT,
   nombre VARCHAR(400),
   --        
   PRIMARY KEY (id) 
) ENGINE = MYISAM
;

DROP TABLE IF EXISTS ven_venta_telefono_operador_history;
CREATE TABLE ven_venta_telefono_operador_history (
   info_create TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
   info_create_user INT DEFAULT 1,
   info_update TIMESTAMP,
   info_update_user INT,
   info_status TINYINT(1) DEFAULT 1,
   --
   id BIGINT NOT NULL AUTO_INCREMENT,
   history_id BIGINT,
   nombre VARCHAR(400),
   --        
   PRIMARY KEY (id) 
) ENGINE = MYISAM
;

DROP TABLE IF EXISTS ven_venta_telefono;
CREATE TABLE ven_venta_telefono (
   info_create TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
   info_create_user INT DEFAULT 1,
   info_update TIMESTAMP,
   info_update_user INT,
   info_status TINYINT(1) DEFAULT 1,
   --
   id BIGINT NOT NULL AUTO_INCREMENT,
   venta_id BIGINT,
   tipo BIGINT,
   numero VARCHAR(100),
   operador_id BIGINT,
   contacto TINYINT(1),
   aportar TINYINT(1),
   --        
   PRIMARY KEY (id) 
) ENGINE = MYISAM
;

DROP TABLE IF EXISTS ven_venta_telefono_history;
CREATE TABLE ven_venta_telefono_history (
   info_create TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
   info_create_user INT DEFAULT 1,
   info_status TINYINT(1) DEFAULT 1,
   --
   id BIGINT NOT NULL AUTO_INCREMENT,
   history_id BIGINT,
   venta_id BIGINT,
   tipo BIGINT,
   numero VARCHAR(100),
   operador_id BIGINT,
   contacto TINYINT(1),
   aportar TINYINT(1),
   --        
   PRIMARY KEY (id) 
) ENGINE = MYISAM
;
