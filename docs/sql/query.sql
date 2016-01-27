SELECT lineal_id FROM usu_usuario_lineal ul
LEFT JOIN usu_usuario_perfil up ON up.usuario_id=ul.usuario_id
WHERE ul.lineal_id= 1 and up.perfil_id=3
;

-- 3 	Tramitacion
-- 4 	Supervisor
-- 5 	Asesor Comercial
-- 6 	Coordinador
