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
   documento VARCHAR(100) NULL,
   documento_tipo VARCHAR(50) NULL,
   correo TEXT NULL,
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
   documento VARCHAR(100) NULL,
   documento_tipo VARCHAR(50) NULL,
   correo TEXT NULL,
   --        
   PRIMARY KEY (id) 
) ENGINE = MYISAM
;

DROP TABLE IF EXISTS cliente_telefono;
CREATE TABLE cliente_telefono (
   info_create TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
   info_create_user INT DEFAULT 1,
   info_update TIMESTAMP,
   info_update_user INT,
   info_status TINYINT(1) DEFAULT 1,
   --
   id BIGINT NOT NULL AUTO_INCREMENT,
   cliente_id BIGINT,
   numero VARCHAR(200),
   tipo VARCHAR(30),
   --        
   PRIMARY KEY (id) 
) ENGINE = MYISAM
;

DROP TABLE IF EXISTS cliente_telefono_history;
CREATE TABLE cliente_telefono_history (
   info_create TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
   info_create_user INT DEFAULT 1,
   info_status TINYINT(1) DEFAULT 1,
   --
   id BIGINT NOT NULL AUTO_INCREMENT,
   history_id BIGINT,
   cliente_id BIGINT,
   numero VARCHAR(200),
   tipo VARCHAR(30),
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
   alta_nueva VARCHAR(300),
   direccion TEXT,
   localidad_id BIGINT,
   provincia_id BIGINT,
   codigo_postal VARCHAR(50),
   telefono_fijo VARCHAR(300),
   telefono_movil VARCHAR(300),
   producto_id BIGINT,
   observaciones TEXT,
   asesor_comercial_id BIGINT,
   fecha_venta TIMESTAMP,
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
   alta_nueva VARCHAR(300),
   direccion TEXT,
   localidad_id BIGINT,
   provincia_id BIGINT,
   codigo_postal VARCHAR(50),
   telefono_fijo VARCHAR(300),
   telefono_movil VARCHAR(300),
   producto_id BIGINT,
   observaciones TEXT,
   asesor_comercial_id BIGINT,
   fecha_venta TIMESTAMP,
   --        
   PRIMARY KEY (id) 
) ENGINE = MYISAM
;
