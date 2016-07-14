DELIMITER $$
DROP TRIGGER IF EXISTS ventas_trigger_OK_001
$$
CREATE TRIGGER ventas_trigger_OK_001
BEFORE UPDATE ON venta_campania_001 FOR EACH ROW
BEGIN
   IF NEW.estado_real <> OLD.estado_real THEN
      IF NEW.estado_real != 3 THEN
         UPDATE venta
         SET fecha_OK = '0000-00-00 00:00:00'
         WHERE id = NEW.id
         ;
      ELSE
         UPDATE venta
         SET fecha_OK = NOW()
         WHERE id = NEW.id
         ;        
      END IF
      ;
   END IF
   ;
END
$$
DELIMITER ;
