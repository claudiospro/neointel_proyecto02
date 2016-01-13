INSERT INTO campania (id, nombre) VALUES
(1, 'Campania 01'),
(2, 'Campania 02')
;

INSERT INTO lineal (id, nombre, supervisor_id) VALUES
(1, 'Lineal 01', 4),
(2, 'Lineal 02', 0),
(3, 'Lineal 03', 0)
;

INSERT INTO campania_lineal (id, campania_id, lineal_id) VALUES
(1, 1, 1),
(2, 2, 2),
(3, 2, 3)
;

INSERT INTO usu_usuario (id, nombre, login, pwd) VALUES
(1, 'claudio rodriguez', 'crodriguez', '$4M4mpfilkNnU'),
(2, 'juan perez 1', 'jperez1', '$4M4mpfilkNnU'),
(3, 'juan perez 2', 'jperez2', '$4M4mpfilkNnU'),
(4, 'juan perez 3', 'jperez3', '$4M4mpfilkNnU'),
(5, 'juan perez 4', 'jperez4', '$4M4mpfilkNnU')
;

INSERT INTO usu_perfil (id, nombre) VALUES
(1, 'Admin'),
(2, 'Gerencia'),
(3, 'Enlace'),
(4, 'Supervisor'),
(5, 'Asesor Comercial')
;

INSERT INTO usu_recurso (id, nombre) VALUES
(1, 'Ventas'),
(2, 'Usuario')
;

INSERT INTO usu_usuario_lineal(usuario_id, lineal_id) VALUES
(2, 1),
(3, 1),
(3, 2),
(4, 1),
(5, 1)
;

INSERT INTO usu_usuario_perfil(usuario_id, perfil_id) VALUES
(1, 1),
(2, 2),
(3, 3),
(4, 4),
(5, 5)
;

INSERT INTO usu_perfil_recurso(perfil_id, recurso_id) VALUES
(1, 1),
(1, 2),
(2, 1),
(3, 1),
(4, 1),
(5, 1)
;
