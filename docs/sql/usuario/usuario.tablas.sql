DROP TABLE IF EXISTS usu_usuario;
CREATE TABLE usu_usuario (
   info_create TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
   info_create_user INT DEFAULT 1,
   info_update TIMESTAMP,
   info_update_user INT,
   info_status TINYINT(1) DEFAULT 1,
   --
   id BIGINT NOT NULL AUTO_INCREMENT,
   nombre VARCHAR(300) NULL,
   pwd VARCHAR(50) NULL,
   --        
   PRIMARY KEY (id) 
) ENGINE = MYISAM
;

DROP TABLE IF EXISTS usu_perfil;
CREATE TABLE IF NOT EXISTS usu_perfil (
   info_create TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
   info_create_user INT DEFAULT 1,
   info_update TIMESTAMP,
   info_update_user INT,
   info_status TINYINT(1) DEFAULT 1,
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
   id INT NOT NULL AUTO_INCREMENT,
   usuario_id INT NOT NULL ,
   perfil_id INT NOT NULL ,
   --
   PRIMARY KEY (id)
) ENGINE = MYISAM
;

DROP TABLE IF EXISTS usu_recurso;
CREATE TABLE usu_recurso (
   info_create TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
   info_create_user INT DEFAULT 1,
   info_update TIMESTAMP,
   info_update_user INT,
   info_status TINYINT(1) DEFAULT 1,
   -- 
   id INT NOT NULL AUTO_INCREMENT,
   nombre VARCHAR(100),
   --
   PRIMARY KEY (id) 
) ENGINE = MYISAM
;

DROP TABLE IF EXISTS usu_perfil_recurso;
CREATE TABLE usu_perfil_recurso(
   id INT NOT NULL AUTO_INCREMENT,
   perfil_id INT NOT NULL,
   recurso_id INT NOT NULL,
   --
   PRIMARY KEY (id) 
) ENGINE = MYISAM
;
