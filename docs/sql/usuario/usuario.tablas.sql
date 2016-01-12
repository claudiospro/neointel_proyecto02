DROP TABLE IF EXISTS usu_lineal;
CREATE TABLE usu_lineal (
   info_create TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
   info_create_user INT DEFAULT 1,
   info_update TIMESTAMP,
   info_update_user INT,
   info_status TINYINT(1) DEFAULT 1,
   --
   id INT NOT NULL AUTO_INCREMENT,
   nombre TEXT,
   --        
   PRIMARY KEY (id) 
) ENGINE = MYISAM
;

DROP TABLE IF EXISTS usu_lineal_history;
CREATE TABLE usu_lineal_history (
   info_create TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
   info_create_user INT DEFAULT 1,
   info_status TINYINT(1) DEFAULT 1,
   --
   id INT NOT NULL AUTO_INCREMENT,
   history_id BIGINT,
   nombre TEXT,
   --        
   PRIMARY KEY (id) 
) ENGINE = MYISAM
;

DROP TABLE IF EXISTS usu_usuario;
CREATE TABLE usu_usuario (
   info_create TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
   info_create_user INT DEFAULT 1,
   info_update TIMESTAMP,
   info_update_user INT,
   info_status TINYINT(1) DEFAULT 1,
   --
   id BIGINT NOT NULL AUTO_INCREMENT,
   nombre TEXT,
   imagen TEXT,
   login VARCHAR(100),
   pwd VARCHAR(50),
   --        
   PRIMARY KEY (id) 
) ENGINE = MYISAM
;

DROP TABLE IF EXISTS usu_usuario_history;
CREATE TABLE usu_usuario_history (
   info_create TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
   info_create_user INT DEFAULT 1,
   info_status TINYINT(1) DEFAULT 1,
   --
   id BIGINT NOT NULL AUTO_INCREMENT,
   history_id BIGINT,
   nombre TEXT,
   imagen TEXT,
   login VARCHAR(100),
   pwd VARCHAR(50),
   --        
   PRIMARY KEY (id) 
) ENGINE = MYISAM
;

DROP TABLE IF EXISTS usu_usuario_lineal;
CREATE TABLE usu_usuario_lineal(
   info_create TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
   info_create_user INT DEFAULT 1,
   info_update TIMESTAMP,
   info_update_user INT,
   info_status TINYINT(1) DEFAULT 1,
   --
   id BIGINT NOT NULL AUTO_INCREMENT,
   usuario_id BIGINT NOT NULL,
   lineal_id INT NOT NULL,
   --
   PRIMARY KEY (id)
) ENGINE = MYISAM
;

DROP TABLE IF EXISTS usu_usuario_lineal_history;
CREATE TABLE usu_usuario_lineal_history(
   info_create TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
   info_create_user INT DEFAULT 1,
   info_status TINYINT(1) DEFAULT 1,
   --
   id BIGINT NOT NULL AUTO_INCREMENT,
   history_id BIGINT,
   usuario_id BIGINT NOT NULL,
   lineal_id INT NOT NULL,
   --
   PRIMARY KEY (id)
) ENGINE = MYISAM
;

DROP TABLE IF EXISTS usu_perfil;
CREATE TABLE IF NOT EXISTS usu_perfil (
   --
   id INT NOT NULL AUTO_INCREMENT,
   nombre VARCHAR(100) NOT NULL,
   -- 
   PRIMARY KEY (id)
) ENGINE = MYISAM
;

DROP TABLE IF EXISTS usu_usuario_perfil;
CREATE TABLE usu_usuario_perfil(
   info_create TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
   info_create_user INT DEFAULT 1,
   info_update TIMESTAMP,
   info_update_user INT,
   info_status TINYINT(1) DEFAULT 1,
   --
   id BIGINT NOT NULL AUTO_INCREMENT,
   usuario_id BIGINT NOT NULL,
   perfil_id INT NOT NULL,
   --
   PRIMARY KEY (id)
) ENGINE = MYISAM
;

DROP TABLE IF EXISTS usu_usuario_perfil_history;
CREATE TABLE usu_usuario_perfil_history(
   info_create TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
   info_create_user INT DEFAULT 1,
   info_status TINYINT(1) DEFAULT 1,
   --
   id BIGINT NOT NULL AUTO_INCREMENT,
   history_id BIGINT,
   usuario_id BIGINT NOT NULL,
   perfil_id INT NOT NULL,
   --
   PRIMARY KEY (id)
) ENGINE = MYISAM
;

DROP TABLE IF EXISTS usu_recurso;
CREATE TABLE usu_recurso (
   -- 
   id INT NOT NULL AUTO_INCREMENT,
   nombre VARCHAR(100),
   --
   PRIMARY KEY (id) 
) ENGINE = MYISAM
;

DROP TABLE IF EXISTS usu_perfil_recurso;
CREATE TABLE usu_perfil_recurso(
   id BIGINT NOT NULL AUTO_INCREMENT,
   perfil_id INT NOT NULL,
   recurso_id INT NOT NULL,
   --
   PRIMARY KEY (id) 
) ENGINE = MYISAM
;

