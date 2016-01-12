SELECT distinct r.nombre
FROM usu_usuario u
LEFT JOIN usu_usuario_perfil up ON up.usuario_id=u.id
LEFT JOIN usu_perfil_recurso pr ON pr.perfil_id=up.perfil_id
LEFT JOIN usu_recurso r ON r.id=pr.recurso_id
WHERE u.nombre = "crodriguez"
;

SELECT ul.lineal_id
FROM usu_usuario u
LEFT JOIN usu_usuario_lineal ul ON ul.usuario_id=u.id
WHERE u.id=3
;

SELECT ul.lineal_id
FROM usu_usuario u
LEFT JOIN usu_usuario_perfil up ON up.usuario_id=u.id
LEFT JOIN usu_perfil p ON p.id=u.perfil_id
WHERE u.id=3
;
