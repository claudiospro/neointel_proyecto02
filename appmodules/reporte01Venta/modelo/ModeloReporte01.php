<?php 
class ModeloVenta {
    private $q;
    function __construct() {
        $this->q = new Query();        
    }
    function getCampaniasActivas($in) {
        $this->q->fields = array(
            'indice' => '',
            'nombre' => '',
        );
        $this->q->sql = '
        SELECT DISTINCT c.indice, c.nombre FROM campania c
        JOIN campania_lineal cl ON cl.campania_id = c.id
        WHERE c.info_status=1
        ';
        if ('' != trim($in['lineas'])) {
            $this->q->sql .= ' AND cl.lineal_id IN (' . $in['lineas'] . ')';
        }
        $this->q->data = NULL;
        $data = $this->q->exe();        
        return $data;
    }
    function getDatos($in) {
        $campanias = $this->getCampaniasActivas($in);
        $i = 1;
        foreach($campanias as $row) {
            $data['indice'][$row['indice']] = $i++;
            $data['indice_nombre'][$row['indice']] = $row['nombre'];
        }
        // ---------------------------------------------------- estado
        $this->q->fields = array(
            'estado' => '',
            'estado_id' => '',
            'total' => '',
            'campania' => '',
        );
        $this->q->sql = '';
        foreach($campanias as $row) {
            if ($this->q->sql != '')
                $this->q->sql .= ' UNION ';
            $this->q->sql .= '
            (SELECT d.estado, count(d.id) total, "' . $row['indice'] . '" campania
            FROM venta_' . $row['indice'] . ' d
            JOIN venta v ON v.id=d.id
            WHERE v.info_create_fecha LIKE "' . $in['anio-mes'] . '%"
            GROUP by 1)
            ';
        }
        $this->q->sql = 'SELECT e.nombre, t.* FROM (' . $this->q->sql . ') as t JOIN venta_estado e ON e.id=t.estado';
        $data['estado'] = $this->q->exe();
        
        // ---------------------------------------------------------------- estado real
        $this->q->fields = array(
            'estado_id' => '',
            'estado_real' => '',
            'estado_real_id' => '',
            'total' => '',
            'campania' => '',
        );
        $this->q->sql = '';
        foreach($campanias as $row) {
            if ($this->q->sql != '')
                $this->q->sql .= ' UNION ';
            $this->q->sql .= '
            (SELECT d.estado_real, count(d.id) total, "' . $row['indice'] . '" campania
            FROM venta_' . $row['indice'] . ' d
            JOIN venta v ON v.id=d.id
            WHERE v.info_create_fecha LIKE "' . $in['anio-mes'] . '%"
            GROUP by 1)
            ';
        }
        $this->q->sql = 'SELECT e.estado_id, e.nombre, t.* FROM (' . $this->q->sql . ') as t JOIN venta_estado_real e ON e.id=t.estado_real';
        $data['estado_real'] = $this->q->exe();
        return $data;
    }
}
