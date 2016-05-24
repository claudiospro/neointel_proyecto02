<?php 
class ModeloComision {
    private $q;
    function __construct() {
        $this->q = new Query();        
    }
    function campaniasXusuario($in) {
        $this->q->fields = array(
            'id' => '',
            'nombre' => '',
        );
        $this->q->sql = '
        SELECT DISTINCT c.id, c.nombre FROM `campania` c
        JOIN campania_lineal cl ON cl.campania_id = c.id
        WHERE c.info_status = 1 AND venta = 1
        ';
        if ($in['lineas'] != '')
            $this->q->sql.= '            
            AND cl.lineal_id IN (' . $in['lineales'] . ')
            ';
        // Utilidades::printr($this->q->sql);
        $this->q->data = NULL;
        $data = $this->q->exe();
        return $data;
    }
    function campania_info($id) {
        $this->q->fields = array(
            'indice' => '',
            'nombre' => '',
        );
        $this->q->sql = '
        SELECT indice, nombre FROM campania 
        WHERE id = "' . $id . '"
        ';
        // Utilidades::printr($this->q->sql);
        $this->q->data = NULL;
        $data = $this->q->exe();
        return $data[0];
    }
    function campania_001_Vodafon_one($in) {
        $this->q->fields = array(
            'id' => '',
            'producto' => '',
            'producto_observacion' => '',
            'con_television' => '',
            'asesor_venta_id' => '',
            'asesor_venta' => '',
            'supervisor_id' => '',
            'supervisor' => '',
            'fijo_numero' => '',
            'fijo_modalidad' => '',
            'movil_numero' => '',
            'movil_modalidad' => '',
            'movil_tarifa' => '',
            'movil_adicional_1_numero' => '',
            'movil_adicional_1_modalidad' => '',
            'movil_adicional_1_tarifa' => '',
            'movil_adicional_2_numero' => '',
            'movil_adicional_2_modalidad' => '',
            'movil_adicional_2_tarifa' => '',
        );
        $this->q->sql = '
SELECT 
  d.id
, d.producto
, d.producto_observacion
, d.con_television
, v.asesor_venta_id
, ase.nombre "asesor_venta"
, v.supervisor_id
, sup.nombre "supervisor"
-- numeros
, d.fijo_numero
, d.fijo_modalidad
, d.movil_numero
, d.movil_modalidad
, d.movil_tarifa
, d.movil_adicional_1_numero
, d.movil_adicional_1_modalidad
, d.movil_adicional_1_tarifa
, d.movil_adicional_2_numero
, d.movil_adicional_2_modalidad
, d.movil_adicional_2_tarifa

FROM venta_campania_001 d
JOIN  venta v ON v.id = d.id
JOIN usu_usuario ase ON ase.id = v.asesor_venta_id
JOIN usu_usuario sup ON sup.id = v.supervisor_id
WHERE 
    v.info_status = 1
AND v.info_create_fecha LIKE "' . $in['anio-mes'] . '%"
AND d.estado = 2
AND d.aprobado_supervisor = 1
AND d.tramitacion_venta_validar = 1
AND d.tramitacion_venta_cargar = 1
AND d.tramitacion_postventa_validar = 1
AND d.tramitacion_postventa_citar = 1
AND d.tramitacion_postventa_intalar = 1
        ';
        // Utilidades::printr($this->q->sql);
        $this->q->data = NULL;
        $data['datos'] = $this->q->exe();
        // --------------------------------------
        $this->q->fields = array(
            'id' => '',
            'nombre' => '',
        );
        $this->q->sql = '
        SELECT id, nombre FROM venta_modalidad
        ';
        // Utilidades::printr($this->q->sql);
        $this->q->data = NULL;
        $d = $this->q->exe();
        $data['modalidad'][0] = '';
        foreach($d  as $r) {
            $data['modalidad'][$r['id']] = $r['nombre'];               
        }        
        // --------------------------------------
        $this->q->fields = array(
            'id' => '',
            'nombre' => '',
        );
        $this->q->sql = '
        SELECT id, nombre FROM venta_tarifa_movil 
        WHERE campania = "campania_001"
        ';
        // Utilidades::printr($this->q->sql);
        $this->q->data = NULL;
        $d = $this->q->exe();
        $data['tarifa'][0] = '';
        foreach($d  as $r) {
            $data['tarifa'][$r['id']] = $r['nombre'];               
        }        
        return $data;
    }
    function campania_001_Vodafon_one_process($data) {
        $total = array();
        $supervisor= array();
        $asesor = array();
        
        $ou['total'] = array();        
        $ou['supervisor'] = array();
        $ou['asesor_venta']=  array();
        /*
          +----+-------------------------------+
          | id | nombre                        |
          +----+-------------------------------+
          | 13 | ADSL Max vellocidad(Autonomo) |
          +----+-------------------------------+
          |  2 | Duo Fibra 50Mb                |
          |  3 | Vodafone One S 50Mb           |
          |  4 | Vodafone One M 50Mb           |
          |  5 | Vodafone One L 50Mb           |
          +----+-------------------------------+            
          |  6 | Duo Fibra 120Mb               |
          |  7 | Vodafone One S 120Mb          |
          |  8 | Vodafone One M 120Mb          |
          |  9 | Vodafone One L 120Mb          |
          +----+-------------------------------+            
          | 10 | Duo Fibra 300Mb               |
          | 11 | Vodafone One S 300Mb          |
          | 14 | Vodafone One M 300Mb          |
          |  1 | Vodafone One L 300Mb          |
          +----+-------------------------------+
        */
        /* TARIFA
          +----+--------+
          | id | nombre |
          +----+--------+
          |  1 | S      |
          |  2 | M      |
          |  3 | L      |
          |  4 | Mini   |
          +----+--------+
        */
        foreach($data['datos'] as $r) {           
            $ou['data'][$r['id']] = $r;
            // ----------------------------------------------- las tarifa
            if ($r['producto'] == '13')
            {                
                $ou['fibra']['total']['autonomo']['adsl']
                    [] = $r['id'];
                $ou['fibra']['supervisor'][$r['supervisor']]['autonomo']['adsl']
                    [] = $r['id'];
                $ou['fibra']['asesor_venta'][$r['asesor_venta']]['autonomo']['adsl']
                    [] = $r['id'];
                $tipo = 'autonomo';
            }
            if (
                $r['producto'] == '2'  ||
                $r['producto'] == '6'  ||
                $r['producto'] == '10'
            )
            {
                if ($r['producto'] == '2' ) $mb = '50MB';
                if ($r['producto'] == '6' ) $mb = '120MB';
                if ($r['producto'] == '10') $mb = '300MB';
                
                $ou['fibra']['total']['autonomo']['fibra']
                    [$mb][] = $r['id'];
                $ou['fibra']['supervisor'][$r['supervisor']]['autonomo']['fibra']
                    [$mb][] = $r['id'];
                $ou['fibra']['asesor_venta'][$r['asesor_venta']]['autonomo']['fibra']
                    [$mb][] = $r['id'];
                $tipo = 'autonomo';
            }
            if (
                $r['producto'] == '3'  || $r['producto'] == '4'  || $r['producto'] == '5' ||
                $r['producto'] == '7'  || $r['producto'] == '8'  || $r['producto'] == '9' ||
                $r['producto'] == '11' || $r['producto'] == '14' || $r['producto'] == '1' 
            )
            {
                if ($r['con_television'] == '2' || $r['con_television'] == '3') $p = '3P';
                else $p = '2P';
                
                if ($r['producto'] == '3' || $r['producto'] == '4' || $r['producto'] == '5') $mb = '50MB';
                if ($r['producto'] == '7' || $r['producto'] == '8' || $r['producto'] == '9' ) $mb = '120MB';
                if ($r['producto'] == '11' || $r['producto'] == '14' || $r['producto'] == '1' ) $mb = '300MB';
                
                $ou['fibra']['total']['residencial'][$p]
                    [$mb][] = $r['id'];
                $ou['fibra']['supervisor'][$r['supervisor']]['residencial'][$p]
                    [$mb][] = $r['id'];
                $ou['fibra']['asesor_venta'][$r['asesor_venta']]['residencial'][$p]
                    [$mb][] = $r['id'];
                $tipo = 'residencial';
            }
            // ----------------------------------------------- las lineas
            /*
              [fijo_numero] => 968524549
              [fijo_modalidad] => 2
              [movil_numero] => 607518241
              [movil_modalidad] => 2
              [movil_tarifa] => 2
              [movil_adicional_1_numero] => 610720890
              [movil_adicional_1_modalidad] => 2
              [movil_adicional_1_tarifa] => 4
              [movil_adicional_2_numero] => 
              [movil_adicional_2_modalidad] => 0
              [movil_adicional_2_tarifa] => 0
            */
            if ('' != trim($r['movil_numero']) && $r['movil_modalidad'] != '0' && $r['movil_modalidad'] != '4')
            {
                if ($r['movil_tarifa'] == '1') $m = 'S';
                if ($r['movil_tarifa'] == '2') $m = 'M';
                if ($r['movil_tarifa'] == '3') $m = 'L';
                
                $ou['movil']['total'][$tipo][$m][] = $r['id'];
                $ou['movil']['supervisor'][$r['supervisor']][$tipo][$m][] = $r['id'];
                $ou['movil']['asesor_venta'][$r['asesor_venta']][$tipo][$m][] = $r['id'];
            }
            if ('' != trim($r['movil_adicional_1_numero']) && $r['movil_adicional_1_modalidad'] != '0' && $r['movil_adicional_1_modalidad'] != '4')
            {
                if ($r['movil_adicional_1_tarifa'] == '1') $m = 'S';
                if ($r['movil_adicional_1_tarifa'] == '2') $m = 'M';
                if ($r['movil_adicional_1_tarifa'] == '3') $m = 'L';
                
                $ou['movil']['total'][$tipo][$m][] = $r['id'];
                $ou['movil']['supervisor'][$r['supervisor']][$tipo][$m][] = $r['id'];
                $ou['movil']['asesor_venta'][$r['asesor_venta']][$tipo][$m][] = $r['id'];
            }
            if ('' != trim($r['movil_adicional_2_numero']) && $r['movil_adicional_2_modalidad'] != '0' && $r['movil_adicional_2_modalidad'] != '4')
            {
                if ($r['movil_adicional_2_tarifa'] == '1') $m = 'S';
                if ($r['movil_adicional_2_tarifa'] == '2') $m = 'M';
                if ($r['movil_adicional_2_tarifa'] == '3') $m = 'L';
                
                $ou['movil']['total'][$tipo][$m][] = $r['id'];
                $ou['movil']['supervisor'][$r['supervisor']][$tipo][$m][] = $r['id'];
                $ou['movil']['asesor_venta'][$r['asesor_venta']][$tipo][$m][] = $r['id'];
            }
        }
        return $ou;
    }
    function campania_001_Vodafon_one_imprimir($fibra, $movil) {
        echo '<div class="tablas-comisiones">';
        echo '<table>';
        echo '<caption>Residencial</caption>';
        echo '<thead>
               <tr>
                <th></th>
                <th><a title=" (Fibra + Telf)">2P</a></th>
                <th><a title="(Fibra + Telf + TV extra)">3P</a></th>
                <th><a title="Small">S</a></th>
                <th><a title="Medium">M</a></th>
                <th><a title="Large">L</a></th>
               </tr>
              </thead>
             ';
        echo '<tbody>';

        if (!isset($fibra['residencial']['2P']['300MB']))
            $fibra['residencial']['2P']['300MB'] = array();
        if (!isset($fibra['residencial']['3P']['300MB']))
            $fibra['residencial']['3P']['300MB'] = array();
        if (!isset($movil['residencial']['S']))
            $movil['residencial']['S'] = array();
        if (!isset($movil['residencial']['M']))
            $movil['residencial']['M'] = array();
        if (!isset($movil['residencial']['L']))
            $movil['residencial']['L'] = array();        
        echo '<tr>
               <th>300MB</th>
               <td>' . count($fibra['residencial']['2P']['300MB']) . '</td>
               <td>' . count($fibra['residencial']['3P']['300MB']) . '</td>
               <td rowspan="3">' . count($movil['residencial']['S']) . '</td>
               <td rowspan="3">' . count($movil['residencial']['M']) . '</td>
               <td rowspan="3">' . count($movil['residencial']['L']) . '</td>
              </tr>
             ';
        
        if (!isset($fibra['residencial']['2P']['120MB']))
            $fibra['residencial']['2P']['120MB'] = array();
        if (!isset($fibra['residencial']['3P']['120MB']))
            $fibra['residencial']['3P']['120MB'] = array();        
        echo '<tr>
               <th>120MB</th>
               <td>' . count($fibra['residencial']['2P']['120MB']) . '</td>
               <td>' . count($fibra['residencial']['3P']['120MB']) . '</td>
              </tr>
             ';

        if (!isset($fibra['residencial']['2P']['50MB']))
            $fibra['residencial']['2P']['50MB'] = array();
        if (!isset($fibra['residencial']['3P']['50MB']))
            $fibra['residencial']['3P']['50MB'] = array();        
        echo '<tr>
               <th>50MB</th>
               <td>' . count($fibra['residencial']['2P']['50MB']) . '</td>
               <td>' . count($fibra['residencial']['3P']['50MB']) . '</td>
              </tr>
             ';
        
        echo '</tr>';
        echo '</tbody>';
        echo '</table>';

        
        echo '<table class="end">';
        echo '<caption>Autonomos</caption>';
        echo '<thead>
               <tr>
                <th colspan="2"></th>
                <th><a title="Small">S</a></th>
                <th><a title="Medium">M</a></th>
                <th><a title="Large">L</a></th>
               </tr>
              </thead>
             ';
        echo '<tbody>';
        
        if (!isset($fibra['autonomo']['fibra']['300MB']))
            $fibra['autonomo']['fibra']['300MB'] = array();
        if (!isset($movil['autonomo']['S']))
            $movil['autonomo']['S'] = array();
        if (!isset($movil['autonomo']['M']))
            $movil['autonomo']['M'] = array();
        if (!isset($movil['autonomo']['L']))
            $movil['autonomo']['L'] = array();        
        echo '<tr>
               <th>Fibra 300 MB</th>
               <td>' . count($fibra['autonomo']['fibra']['300MB']) . '</td>
               <td rowspan="4">' . count($movil['autonomo']['S']) . '</td>
               <td rowspan="4">' . count($movil['autonomo']['M']) . '</td>
               <td rowspan="4">' . count($movil['autonomo']['L']) . '</td>
              </tr>
             ';

        if (!isset($fibra['autonomo']['fibra']['120MB']))
            $fibra['autonomo']['fibra']['120MB'] = array();   
        echo '<tr>
               <th>Fibra 120 MB</th>
               <td>' . count($fibra['autonomo']['fibra']['120MB']) . '</td>
              </tr>
             ';

        if (!isset($fibra['autonomo']['fibra']['50MB']))
            $fibra['autonomo']['fibra']['50MB'] = array();        
        echo '<tr>
               <th>Fibra 50 MB</th>
               <td>' . count($fibra['autonomo']['fibra']['50MB']) . '</td>
              </tr>
             ';
        if (!isset($fibra['autonomo']['adsl']))
            $fibra['autonomo']['adsl'] = array();        
        echo '<tr>
               <th>ADSL</th>
               <td>' . count($fibra['autonomo']['adsl']) . '</td>
              </tr>
             ';
        
        echo '</tbody>';
        echo '</table>';
        echo '<div style="clear:both;"></div>';
        echo '</div>';
        
    }
}
