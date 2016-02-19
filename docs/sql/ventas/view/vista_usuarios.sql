CREATE VIEW vista_usuarios AS SELECT 
u.id,
u.nombre,
u.nombre_corto,
u.login,
IF(u.pwd = '$4nkNrBEK8ra2', 'No', 'Si') clave,
p.nombre 'perfil',
(SELECT COUNT(id) FROM usu_usuario_lineal WHERE usuario_id =u.id AND lineal_id = 1) grupo_1,
(SELECT COUNT(id) FROM usu_usuario_lineal WHERE usuario_id =u.id AND lineal_id = 2) grupo_2,
(SELECT COUNT(id) FROM usu_usuario_lineal WHERE usuario_id =u.id AND lineal_id = 3) grupo_3
FROM usu_usuario u
LEFT JOIN usu_usuario_perfil up ON up.usuario_id=u.id
LEFT JOIN usu_perfil p ON p.id=up.perfil_id
ORDER BY 1

