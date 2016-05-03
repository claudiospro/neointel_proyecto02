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
   -- ------------------------------- postVenta
   IF NEW.tramitacion_postventa_validar <> OLD.tramitacion_postventa_validar THEN
      UPDATE venta SET proceso_validar_externo= NOW()
      WHERE id = NEW.id
      ;
   END IF
   ;
   IF NEW.tramitacion_postventa_citar <> OLD.tramitacion_postventa_citar THEN
      UPDATE venta SET proceso_cita= NOW()
      WHERE id = NEW.id
      ;
   END IF
   ;
   IF NEW.tramitacion_postventa_intalar <> OLD.tramitacion_postventa_intalar THEN
      UPDATE venta SET proceso_instalacion= NOW()
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
   -- ------------------------------- postVenta
   IF NEW.tramitacion_postventa_validar <> OLD.tramitacion_postventa_validar THEN
      UPDATE venta SET proceso_validar_externo= NOW()
      WHERE id = NEW.id
      ;
   END IF
   ;
   IF NEW.tramitacion_postventa_citar <> OLD.tramitacion_postventa_citar THEN
      UPDATE venta SET proceso_cita= NOW()
      WHERE id = NEW.id
      ;
   END IF
   ;
   IF NEW.tramitacion_postventa_intalar <> OLD.tramitacion_postventa_intalar THEN
      UPDATE venta SET proceso_instalacion= NOW()
      WHERE id = NEW.id
      ;
   END IF
   ;
END
$$
