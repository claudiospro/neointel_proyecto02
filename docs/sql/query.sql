CREATE TEMPORARY TABLE dd
SELECT * FROM (
SELECT l.nombre, c.nombre campania, l.info_status vigente,
       l.id
FROM lineal l 
JOIN campania_lineal cp ON cp.lineal_id=l.id
JOIN campania c ON c.id = cp.campania_id
) unido01
WHERE 1=1
ORDER BY 1 asc
;


SELECT * FROM (
   SELECT *, @rownum:=@rownum+1 row_num  FROM (
     SELECT * FROM dd
   ) unido1, (SELECT @rownum:=0) R
) unido2
WHERE id = 5
;

DROP TEMPORARY TABLE dd
;
