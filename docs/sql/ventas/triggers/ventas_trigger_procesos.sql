DELIMITER $$
DROP TRIGGER IF EXISTS ventas_trigger_proceso_v_001
$$
CREATE TRIGGER ventas_trigger_proceso_v_001
BEFORE UPDATE ON venta_campania_001 FOR EACH ROW
BEGIN
   IF NEW.aprobado_supervisor <> OLD.aprobado_supervisor THEN
      UPDATE venta SET proceso_aprobar = NOW()
      WHERE id = NEW.id
      ;
   END IF
   ;
   IF NEW.tramitacion_venta_validar <> OLD.tramitacion_venta_validar THEN
      UPDATE venta SET proceso_validar = NOW()
      WHERE id = NEW.id
      ;
   END IF
   ;
   IF NEW.tramitacion_venta_cargar <> OLD.tramitacion_venta_cargar THEN
      UPDATE venta SET proceso_cargar = NOW()
      WHERE id = NEW.id
      ;
   END IF
   ;   
END
$$

DROP TRIGGER IF EXISTS ventas_trigger_proceso_v_002
$$
CREATE TRIGGER ventas_trigger_proceso_v_002
BEFORE UPDATE ON venta_campania_002 FOR EACH ROW
BEGIN
   IF NEW.aprobado_supervisor <> OLD.aprobado_supervisor THEN
      UPDATE venta SET proceso_aprobar = NOW()
      WHERE id = NEW.id
      ;
   END IF
   ;
   IF NEW.tramitacion_venta_validar <> OLD.tramitacion_venta_validar THEN
      UPDATE venta SET proceso_validar = NOW()
      WHERE id = NEW.id
      ;
   END IF
   ;
   IF NEW.tramitacion_venta_cargar <> OLD.tramitacion_venta_cargar THEN
      UPDATE venta SET proceso_cargar = NOW()
      WHERE id = NEW.id
      ;
   END IF
   ;   
END
$$
