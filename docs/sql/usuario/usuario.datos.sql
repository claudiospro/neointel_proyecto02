INSERT INTO usu_usuario (id, nombre, pwd) VALUES
(1, 'crodriguez', '$4UyGoPH8mfHU')
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

INSERT INTO usu_usuario_perfil(usuario_id, perfil_id) VALUES
(1, 1)
;

INSERT INTO usu_perfil_recurso(perfil_id, recurso_id) VALUES
(1, 1),
(1, 2),
(2, 1),
(3, 1),
(4, 1),
(5, 1)
;
