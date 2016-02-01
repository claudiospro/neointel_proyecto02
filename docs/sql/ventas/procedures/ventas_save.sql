DROP PROCEDURE IF EXISTS ventas_save;
SELECT 'CREATE PROCEDURE ventas_save' AS 'MENSAJE';
DELIMITER $$ 

CREATE PROCEDURE ventas_save(
  in_id BIGINT
, in_campania VARCHAR(600)
, in_fecha VARCHAR(100)
, in_usuario INT
)
BEGIN
  DECLARE ou_id BIGINT;
  DECLARE pr_lineal_id BIGINT;
  DECLARE pr_asesor_venta_id BIGINT;
  DECLARE pr_tramitacion_id BIGINT;
  DECLARE pr_supervisor_id BIGINT;
  DECLARE pr_coordinador_id BIGINT;

  
  IF in_id=0 THEN
     SELECT lineal_id INTO pr_lineal_id  FROM usu_usuario_lineal WHERE usuario_id= 5 LIMIT 1
     ;
     SELECT ul.usuario_id INTO pr_tramitacion_id FROM usu_usuario_lineal ul
     LEFT JOIN usu_usuario_perfil up ON up.usuario_id=ul.usuario_id
     WHERE ul.lineal_id= pr_lineal_id and up.perfil_id=3
     ;
     SELECT ul.usuario_id INTO pr_supervisor_id FROM usu_usuario_lineal ul
     LEFT JOIN usu_usuario_perfil up ON up.usuario_id=ul.usuario_id
     WHERE ul.lineal_id= pr_lineal_id and up.perfil_id=4
     ;
     SELECT ul.usuario_id INTO pr_coordinador_id FROM usu_usuario_lineal ul
     LEFT JOIN usu_usuario_perfil up ON up.usuario_id=ul.usuario_id
     WHERE ul.lineal_id= pr_lineal_id and up.perfil_id=6
     ;

     INSERT INTO venta
     (info_create_fecha, info_create_user, info_update_fecha,
      asesor_venta_id, tramitacion_id, supervisor_id, coordinador_id,
      campania, lineal_id)
     VALUES
     (in_fecha, in_usuario, in_fecha,
      in_usuario, pr_tramitacion_id, pr_supervisor_id, pr_coordinador_id,
      in_campania, pr_lineal_id)
     ; 
     SELECT last_insert_id() INTO ou_id
     ;
  ELSE
     UPDATE venta SET
     info_update_user=in_usuario, info_update_fecha=in_fecha
     WHERE id=in_id
     ;
     SET ou_id = in_id;
  END IF
  ;
  SELECT ou_id
  ;
END $$
DELIMITER ;

-- SET
--   @id=3
-- , @campania='campania_001'
-- , @fecha='2016-01-30'
-- , @usuario=3
-- ;

-- CALL ventas_save(
--   @id
-- , @campania
-- , @fecha
-- , @usuario
-- )
-- ;

-- SELECT * FROM venta
-- ;

