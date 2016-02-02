SELECT id, nombre, login FROM usu_usuario
WHERE nombre LIKE '%juan%'
;

-- creando nuevo usuario
INSERT INTO usu_usuario (nombre, login) values
('temploral', 'nombre.apellido')
;

-- viendo los ids 
SELECT id, nombre, login FROM usu_usuario
order by 1 desc
LIMIT 1
;

-- 

-- lista de perfiles
SELECT * FROM usu_perfil;

-- asignandole permiso al usuario
INSERT INTO usu_usuario_perfil() VALUES
()
