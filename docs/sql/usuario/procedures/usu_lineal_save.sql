DROP PROCEDURE IF EXISTS usu_lineal_save;

DELIMITER $$ 

CREATE PROCEDURE usu_lineal_save(
  in_id BIGINT
, in_nombre VARCHAR(500)
, in_info_status INT
, in_campania_id BIGINT
, in_fecha VARCHAR(100)
, in_usuario BIGINT
)
BEGIN
  DECLARE ou_id BIGINT DEFAULT 0;
  IF in_id = 0 THEN
     INSERT INTO lineal
     (nombre, info_status, info_create, info_create_user)
     VALUES(in_nombre, in_info_status, in_fecha, in_usuario)
     ;
     SELECT last_insert_id() INTO ou_id
     ;
     INSERT INTO campania_lineal
     (lineal_id, campania_id, info_create, info_create_user)
     VALUES (ou_id, in_campania_id, in_fecha, in_usuario)
     ;
  ELSE
     UPDATE lineal SET 
       nombre = in_nombre
     , info_status = in_info_status
     , info_update = in_fecha
     , info_update_user = in_usuario
     WHERE id = in_id
     ;
     UPDATE campania_lineal SET 
       campania_id = in_campania_id
     , info_update = in_fecha
     , info_update_user = in_usuario
     WHERE lineal_id = in_id
     ;
     SET ou_id = in_id
     ;
  END IF
  ;
  SELECT ou_id;
END $$
DELIMITER ;

-- ---------------------------------------------------- test

-- SET
--   @id = 8
-- , @nombre = 'nombre bbvv'
-- , @info_status = '0'
-- , @campania_id = '4'
-- , @fecha = '2016-05-06 13:16:20'
-- , @usuario = 2
-- ;

-- CALL usu_lineal_save(
--   @id
-- , @nombre
-- , @info_status
-- , @campania_id
-- , @fecha
-- , @usuario
-- )
-- ;

-- SELECT c.id, c.nombre, l.* FROM lineal l 
-- JOIN campania_lineal cl ON cl.lineal_id = l.id
-- JOIN campania c ON c.id = cl.campania_id
-- ORDER BY l.id DESC
-- LIMIT 3
-- ;

