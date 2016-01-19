DROP TABLE IF EXISTS cms_campo;
CREATE TABLE cms_campo (
   info_status TINYINT(1) DEFAULT 1,
   --
   id BIGINT NOT NULL AUTO_INCREMENT,
   nombre VARCHAR(600) NULL,
   --        
   PRIMARY KEY (id) 
) ENGINE = MYISAM
;
DROP TABLE IF EXISTS cms_campo_campania;
CREATE TABLE cms_campo_campania (
   info_status TINYINT(1) DEFAULT 1,
   --
   id BIGINT NOT NULL AUTO_INCREMENT,
   campo_id BIGINT,
   campania_id BIGINT,
   --        
   PRIMARY KEY (id) 
) ENGINE = MYISAM
;
