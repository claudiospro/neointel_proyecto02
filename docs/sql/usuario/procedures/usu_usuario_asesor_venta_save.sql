DROP PROCEDURE IF EXISTS usu_usuario_asesor_venta_save;

SELECT 'CREATE PROCEDURE usu_usuario_asesor_venta_save' AS 'MENSAJE';
DELIMITER $$ 

CREATE PROCEDURE usu_usuario_asesor_venta_save(
  in_nombre TEXT
, in_login VARCHAR(100)
, in_supervisor VARCHAR(100)
)
proc_label:BEGIN
  DECLARE pr_supervisor_perfil_id BIGINT DEFAULT 0;
  DECLARE pr_user_id BIGINT DEFAULT 0;
  DECLARE pr_user_perfil_id BIGINT DEFAULT 0;
  DECLARE pr_perfil_id BIGINT DEFAULT 0;
  DECLARE pr_user_lineal_id BIGINT DEFAULT 0;
  DECLARE pr_lineal_id BIGINT DEFAULT 0;
  
  -- ------------------------------------- SUPERVISOR
  SELECT up.perfil_id INTO pr_supervisor_perfil_id FROM usu_usuario_perfil up
  join usu_usuario u ON u.id=up.usuario_id
  WHERE u.login=in_supervisor
  ;
  IF pr_supervisor_perfil_id != 4  THEN
     SELECT 'No es supervisor';
     LEAVE proc_label;
  END IF
  ;
  -- ---------------------------------------- USUARIO
  SELECT id INTO pr_user_id FROM usu_usuario WHERE login = in_login
  ;
  IF pr_user_id > 0 THEN
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
  SELECT id, perfil_id INTO pr_user_perfil_id, pr_perfil_id
  FROM usu_usuario_perfil WHERE usuario_id = pr_user_id
  ;
  IF pr_user_perfil_id > 0 THEN
     IF pr_perfil_id != 5 THEN
        SELECT 'Perfil Sin Permiso';
     END IF
     ;
  ELSE
     INSERT INTO usu_usuario_perfil(usuario_id, perfil_id)
     VALUES (pr_user_id, 5)
     ;  
  END IF
  ;
  -- ---------------------------------------- LINEAL
  IF pr_perfil_id != 5 THEN
     SELECT ul.lineal_id INTO pr_lineal_id
     FROM usu_usuario_lineal ul
     LEFT JOIN usu_usuario u ON u.id=ul.usuario_id
     WHERE u.login=in_supervisor
     ;
     SELECT id INTO pr_user_lineal_id
     FROM usu_usuario_lineal
     WHERE usuario_id = pr_user_id
     ;
     
     IF pr_user_lineal_id > 0 THEN
        UPDATE usu_usuario_lineal SET lineal_id=pr_lineal_id
        WHERE usuario_id = pr_user_id
        ;
     ELSE
        INSERT INTO usu_usuario_lineal(usuario_id, lineal_id) VALUES
        (pr_user_id, pr_lineal_id)
        ;
     END IF
     ;
  END IF
  ;
END $$
DELIMITER ;

-- SET
--   @nombre = 'Lenny Dias' 
-- , @login  = '44028610'
-- , @supervisor = '44028610'
-- ;

-- CALL usu_usuario_asesor_venta_save(
--   @nombre
-- , @login
-- , @supervisor
-- )
-- ;

-- SELECT id, nombre, login FROM usu_usuario
-- WHERE login = @login COLLATE utf8_unicode_ci
-- ;

-- SELECT u.login, up.perfil_id FROM usu_usuario_perfil up
-- JOIN usu_usuario u ON u.id=up.usuario_id
-- WHERE u.login = @login COLLATE utf8_unicode_ci
-- ;

-- SELECT u.login, ul.lineal_id FROM usu_usuario_lineal ul
-- JOIN usu_usuario u ON u.id=ul.usuario_id
-- WHERE u.login = @login COLLATE utf8_unicode_ci
-- ;
