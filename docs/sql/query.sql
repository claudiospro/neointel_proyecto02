SELECT r.nombre
FROM usu_usuario u
LEFT JOIN usu_usuario_perfil up ON up.usuario_id=u.id
LEFT JOIN usu_perfil_recurso pr ON pr.perfil_id=up.perfil_id
LEFT JOIN usu_recurso r ON r.id=pr.recurso_id
WHERE u.nombre = "crodriguez"
  AND u.pwd ="$4UyGoPH8mfHU"
;
