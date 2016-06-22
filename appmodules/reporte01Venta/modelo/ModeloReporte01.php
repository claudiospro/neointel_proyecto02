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
        WHERE c.venta=1 
        ';
        if ('' != trim($in['lineas'])) {
            $this->q->sql .= ' AND cl.lineal_id IN (' . $in['lineas'] . ')';
        }
        $this->q->data = NULL;
        // Utilidades::printr($this->q->sql);
        $data = $this->q->exe();        
        return $data;
    }
    function getDatos($in) {
         $data['indice'][$in['campania_id']] = 0;
            $data['indice_nombre'][$in['campania_id']] = $in['campania_id'];
        $filtros = '';
        if ($in['dia-ini'] != '00') {
            $filtros .= 'v.info_create_fecha >="' . $in['anio-mes-ini'] . '-' . $in['dia-ini'] . ' 00:00:00" AND 
                        ';
        } else {
            $filtros .= 'v.info_create_fecha >="' . $in['anio-mes-ini'] . '-01 00:00:00" AND
                        ';
        }
        if ($in['dia-end'] != '00') {
            $filtros .= 'v.info_create_fecha <="' . $in['anio-mes-end'] . '-' . $in['dia-end'] . ' 23:59:59" AND
                        ';
        } else {
            $filtros .= 'v.info_create_fecha <="' . $in['anio-mes-end'] . '-31 23:59:59" AND 
                        ';
        }
        
        if ($in['modo'] == 'Estructura') {
            if ($in['supervisor_id'] != '00' && $in['asesor_comercial_id'] == '00') {
                $filtros .= 'v.supervisor_id =  "' . $in['supervisor_id'] . '" AND 
                ';
            }
            if ($in['asesor_comercial_id'] != '00') {
                $filtros .= 'v.asesor_venta_id =  "' . $in['asesor_comercial_id'] . '" AND
                ';
            }
        } elseif ($in['modo'] == 'Supervisor') {
            if ($in['supervisor_id'] != '00') {
                $filtros .= 'v.supervisor_id =  "' . $in['supervisor_id'] . '" AND 
                ';
            }
            if ($in['asesor_comercial_id'] != '00') {
                $filtros .= 'v.asesor_venta_id =  "' . $in['asesor_comercial_id'] . '" AND 
                ';
            }
        }
        $filtros .= '
                    v.info_status=1 AND 
                    d.aprobado_supervisor = 1 AND 
                    d.tramitacion_venta_validar = 1 AND 
                    d.tramitacion_venta_cargar = 1
        ';
        
        if ($in['tipo'] == '01')
        {
            // ---------------------------------------------------- estado
            $this->q->fields = array(
                'estado' => '',
                'estado_id' => '',
                'total' => '',
                'campania' => '',
            );            
            $this->q->sql = '
                (SELECT d.estado, SUM(d.producto_cantidad) total, "' . $in['campania_id'] . '" campania
                FROM venta_' . $in['campania_id'] . ' d
                JOIN venta v ON v.id=d.id
                WHERE ' . $filtros . '
                GROUP by 1)
            ';

            $this->q->sql = 'SELECT e.nombre, t.* FROM (' . $this->q->sql . ') as t 
                             JOIN venta_estado e ON e.id=t.estado';
            // Utilidades::printr($this->q->sql);
            $data['estado'] = $this->q->exe();
        
            // ---------------------------------------------------------------- estado real
            $this->q->fields = array(
                'estado' => '',
                'estado_id' => '',
                'estado_real' => '',
                'estado_real_id' => '',
                'total' => '',
                'campania' => '',
            );          
            

            $this->q->sql = '
                (SELECT d.estado_real, SUM(d.producto_cantidad) total, "' . $in['campania_id'] . '" campania
                FROM venta_' . $in['campania_id'] . ' d
                JOIN venta v ON v.id=d.id
                WHERE ' . $filtros . '
                GROUP by 1)
            ';
            $this->q->sql = 'SELECT e.nombre, er.estado_id, er.nombre, t.* FROM (' . $this->q->sql . ') as t 
                             JOIN venta_estado_real er ON er.id = t.estado_real
                             JOIN venta_estado e ON e.id = er.estado_id
                        ';
            // Utilidades::printr($this->q->sql);
            $data['estado_real'] = $this->q->exe();
        }
        elseif($in['tipo'] == '02')
        {
            // ---------------------------------------------------- tipo de cliente
            $this->q->fields = array(
                'cliente_tipo' => '',
                'cliente_tipo_id' => '',
                'total' => '',
                'campania' => '',
            );
            $this->q->sql = '
                (SELECT d.cliente_tipo, SUM(d.producto_cantidad) total, "' . $in['campania_id'] . '" campania
                FROM venta_' . $in['campania_id'] . ' d
                JOIN venta v ON v.id=d.id
                WHERE ' . $filtros . '
                GROUP by 1)
            ';
            $this->q->sql = 'SELECT e.nombre, t.* FROM (' . $this->q->sql . ') as t 
                             JOIN venta_cliente_tipo e ON e.id=t.cliente_tipo';
            // Utilidades::printr($this->q->sql);
            $data['cliente_tipo'] = $this->q->exe();
            
            // ---------------------------------------------------------------- estado real
            $this->q->fields = array(
                'estado_real'     => '',
                'cliente_tipo'    => '',
                'estado_real_id'  => '',
                'cliente_tipo_id' => '',
                'total'           => '',
                'campania'        => '',
            );
            $this->q->sql = '
                (
                SELECT d.estado_real, d.cliente_tipo, SUM(d.producto_cantidad) total, "' . $in['campania_id'] . '" campania
                FROM venta_' . $in['campania_id'] . ' d
                JOIN venta v ON v.id=d.id
                WHERE ' . $filtros . '
                GROUP by 1,2
                )
            ';
            $this->q->sql = 'SELECT er.nombre, ct.nombre, t.* FROM (' . $this->q->sql . ') as t 
                         JOIN venta_estado_real er ON er.id = t.estado_real
                         JOIN venta_cliente_tipo ct ON t.cliente_tipo = ct.id
                        ';
            // Utilidades::printr($this->q->sql);
            $data['estado_real'] = $this->q->exe();            
        } elseif($in['tipo'] == '03') {
            // ---------------------------------------------------- estados
            $this->q->fields = array (
                'id' => '',
                'nombre' => '',
            );
            $this->q->sql = '
            SELECT id, nombre FROM venta_estado WHERE info_status = 1
            ';
            // Utilidades::printr($this->q->sql);
            $data['estados'] = $this->q->exe();
            // ----------------------------------------------------- estados x asesores (ventas)
            $this->q->fields = array(
                'estado_id'       => '',
                'asesor_venta_id' => '',
                'total'           => '',
                'campania'        => '',
            );
            $this->q->sql = '
            SELECT d.estado, v.asesor_venta_id, SUM(d.producto_cantidad) total, "' . $in['campania_id'] . '" campania
            FROM venta_' . $in['campania_id'] . ' d
            JOIN venta v ON v.id=d.id
            WHERE ' . $filtros . '
            GROUP by 1,2
            ';
            // Utilidades::printr($this->q->sql);
            $data['ventas'] = $this->q->exe();
            // ----------------------------------------------------- asesores
            $this->q->fields = array(
                'id'     => '',
                'nombre' => '',
            );
            $this->q->sql = '
            SELECT u.id, u.nombre 
            FROM usu_usuario u
            JOIN usu_usuario_lineal ul ON ul.usuario_id = u.id
            JOIN campania_lineal cl ON cl.lineal_id = ul.lineal_id
            JOIN campania c ON c.id = cl.campania_id
            JOIN usu_usuario_perfil up ON up.usuario_id = u.id
            WHERE u.info_status = 1
              AND up.perfil_id IN (5)
              AND c.indice = "' . $in['campania_id'] . '"
            ORDER BY 2
            ';
            // Utilidades::printr($this->q->sql);
            $data['asesores'] = $this->q->exe();
            // ----------------------------------------------------- asesores
        } elseif($in['tipo'] == '04') {
            // ---------------------------------------------------- estados
            $this->q->fields = array(
                'id' => '',
                'nombre' => '',
            );
            $this->q->sql = '
            SELECT id, nombre FROM venta_estado WHERE info_status = 1
            ';
            // Utilidades::printr($this->q->sql);
            $data['estados'] = $this->q->exe();
            // ---------------------------------------------------------------- estados x asesores
            $this->q->fields = array(
                'asesor_venta'    => '',
                'estado_id'       => '',
                'asesor_venta_id' => '',
                'total'           => '',
                'campania'        => '',
            );
            $this->q->sql = '
            (
             SELECT d.estado, v.asesor_venta_id, SUM(d.producto_cantidad) total, "' . $in['campania_id'] . '" campania
             FROM venta_' . $in['campania_id'] . ' d
             JOIN venta v ON v.id=d.id
             WHERE ' . $filtros . '
             GROUP by 1,2
            )
            ';
            $this->q->sql = '
            SELECT av.nombre, t.* FROM (' . $this->q->sql . ') as t 
            JOIN usu_usuario av ON av.id = t.asesor_venta_id
            WHERE av.info_status = 0
            ORDER BY 1
            ';
            // Utilidades::printr($this->q->sql);
            $data['asesores'] = $this->q->exe();
        }
        return $data;
    }
    function getSupervisorByFechas($in) {
        $ou = null;
        $filtros = '';
        if ($in['dia-ini'] != '00') {
            $filtros .= 'v.info_create_fecha >="' . $in['anio-mes-ini'] . '-' . $in['dia-ini'] . ' 00:00:00" AND ';
        } else {
            $filtros .= 'v.info_create_fecha >="' . $in['anio-mes-ini'] . '-01 00:00:00" AND ';
        }
        if ($in['dia-end'] != '00') {
            $filtros .= 'v.info_create_fecha <="' . $in['anio-mes-end'] . '-' . $in['dia-end'] . ' 23:59:59" AND ';
        } else {
            $filtros .= 'v.info_create_fecha <="' . $in['anio-mes-end'] . '-31 23:59:59" AND ';
        }
        $filtros .= '
                    v.info_status=1 AND 
                    d.aprobado_supervisor = 1 AND 
                    d.tramitacion_venta_validar = 1 AND 
                    d.tramitacion_venta_cargar = 1
        ';
        $this->q->fields = array(
            'supervisor' => '',
            'supervisor_id' => '',
        );            
        $this->q->sql = '
        SELECT DISTINCT v.supervisor_id
        FROM venta_' . $in['campania_id'] . ' d
        JOIN venta v ON v.id=d.id
        WHERE ' . $filtros . '
        ';
        $this->q->sql = 'SELECT u.nombre, t.* FROM (' . $this->q->sql . ') as t 
                         JOIN usu_usuario u on u.id = t.supervisor_id
                         ORDER BY 1
                        ';
        // Utilidades::printr($this->q->sql);
        $ou = $this->q->exe(); 
        return $ou;
    }
    function getAsesorComercialByFechas($in) {
        $ou = null;
        $filtros = '';
        if ($in['dia-ini'] != '00') {
            $filtros .= 'v.info_create_fecha >="' . $in['anio-mes-ini'] . '-' . $in['dia-ini'] . ' 00:00:00" AND ';
        } else {
            $filtros .= 'v.info_create_fecha >="' . $in['anio-mes-ini'] . '-01 00:00:00" AND ';
        }
        if ($in['dia-end'] != '00') {
            $filtros .= 'v.info_create_fecha <="' . $in['anio-mes-end'] . '-' . $in['dia-end'] . ' 23:59:59" AND ';
        } else {
            $filtros .= 'v.info_create_fecha <="' . $in['anio-mes-end'] . '-31 23:59:59" AND ';
        }
        $filtros .= '
                    v.info_status=1 AND 
                    d.aprobado_supervisor = 1 AND 
                    d.tramitacion_venta_validar = 1 AND 
                    d.tramitacion_venta_cargar = 1 AND
        ';
        $filtros .= 'v.supervisor_id = "' . $in['supervisor_id'] . '"
        ';
        $this->q->fields = array(
            'asesor_venta' => '',
            'asesor_venta_id' => '',
        );            
        $this->q->sql = '
        SELECT DISTINCT v.asesor_venta_id
        FROM venta_' . $in['campania_id'] . ' d
        JOIN venta v ON v.id=d.id
        WHERE ' . $filtros . '                
        ';
        $this->q->sql = 'SELECT u.nombre, t.* FROM (' . $this->q->sql . ') as t 
                         JOIN usu_usuario u on u.id = t.asesor_venta_id
                         ORDER BY 1
                        ';
        // Utilidades::printr($this->q->sql);
        $ou = $this->q->exe(); 
        return $ou;
    }
}
