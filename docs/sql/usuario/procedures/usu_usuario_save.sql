DROP PROCEDURE IF EXISTS usu_usuario_save;

DROP PROCEDURE IF EXISTS usu_usuario_save;

DELIMITER $$ 

CREATE PROCEDURE usu_usuario_save(
  in_id BIGINT
, in_nombre VARCHAR(500)
, in_nombre_corto VARCHAR(500)
, in_login VARCHAR(500)
, in_comentario VARCHAR(500)
, in_info_status INT
, in_perfil_id BIGINT
, in_fecha VARCHAR(100)
, in_usuario BIGINT
)
BEGIN
  DECLARE ou_id BIGINT DEFAULT 0;
  IF in_id = 0 THEN
     INSERT INTO usu_usuario
     (nombre, nombre_corto, login, comentario, info_status, info_create, info_create_user)
     VALUES(in_nombre, in_nombre_corto, in_login, in_comentario,in_info_status, in_fecha, in_usuario)
     ;
     SELECT last_insert_id() INTO ou_id
     ;
     INSERT INTO usu_usuario_perfil (usuario_id, perfil_id, info_create, info_create_user)
     VALUES (ou_id, in_perfil_id, in_fecha, in_usuario)
     ;
  ELSE
     UPDATE usu_usuario SET 
       nombre = in_nombre
     , nombre_corto = in_nombre_corto
     , login = in_login
     , comentario = in_comentario
     , info_status = in_info_status
     , info_update = in_fecha
     , info_update_user = in_usuario
     WHERE id = in_id
     ;
     UPDATE usu_usuario_perfil SET 
       perfil_id = in_perfil_id
     , info_update = in_fecha
     , info_update_user = in_usuario
     WHERE usuario_id = in_id
     ;
     SET ou_id = in_id;
  END IF
  ;
  SELECT ou_id
  ;
END $$
DELIMITER ;

-- ----------------------------------------------------

-- SET
--   @id = 97
-- , @nombre = 'nombre bb'
-- , @nombre_corto = 'nombre corto bb'
-- , @login = 'login bb'
-- , @comentario = 'comentario bb'
-- , @info_status = '0'
-- , @perfil_id = '2'
-- , @fecha = '2016-06-01 18:30:00'
-- , @usuario = 2
-- ;

-- CALL usu_usuario_save(
--   @id
-- , @nombre
-- , @nombre_corto
-- , @login
-- , @comentario
-- , @info_status
-- , @perfil_id
-- , @fecha
-- , @usuario
-- )
-- ;

-- SELECT p.nombre, u.*    FROM usu_usuario u
-- JOIN usu_usuario_perfil up ON up.usuario_id = u.id
-- JOIN usu_perfil p ON p.id = up.perfil_id
-- ORDER BY u.id DESC
-- LIMIT 3
-- ;



