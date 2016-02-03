DROP PROCEDURE IF EXISTS usu_usuario_save;
SELECT 'CREATE PROCEDURE usu_usuario_save' AS 'MENSAJE';
DELIMITER $$ 

CREATE PROCEDURE usu_usuario_save(
  in_nombre TEXT
, in_login VARCHAR(100)
, in_perfil_nombre VARCHAR(200)
)
BEGIN
  DECLARE pr_user_id BIGINT DEFAULT 0;
  DECLARE pr_perfil_id BIGINT DEFAULT 0;
  DECLARE pr_usuario_perfil_id BIGINT DEFAULT 0;

  -- ---------------------------------------- USUARIO
  SELECT id INTO pr_user_id FROM usu_usuario WHERE login = in_login
  ;
  IF pr_user_id > 0 THEN
    IF in_nombre != '' THEN
      UPDATE usu_usuario SET nombre = in_nombre WHERE id = pr_user_id
      ;
    END IF
    ;       
    SELECT 'Usuario Existente';
  ELSE
    INSERT INTO usu_usuario (nombre, login) VALUES(in_nombre, in_login)
    ;
    SELECT last_insert_id() INTO pr_user_id
    ;
    SELECT 'Usuario Nuevo';
  END IF
  ;
  -- ---------------------------------------- PERFIL
  SELECT id INTO pr_perfil_id FROM usu_perfil WHERE nombre = in_perfil_nombre
  ;
  IF pr_perfil_id > 0 THEN
    SELECT 'Perfil OK';
  ELSE
    SELECT 'Perfil No existe';
  END IF
  ;
END $$
DELIMITER ;

SET
  @nombre = 'Claudio Rodriguez Ore' 
, @logins = '44028610'
, @perfil = 'Tramitacion'

;

CALL usu_usuario_save(
  @nombre
, @logins
, @perfil
)
;

SELECT id, nombre, login FROM usu_usuario WHERE login = @logins COLLATE utf8_unicode_ci
;

