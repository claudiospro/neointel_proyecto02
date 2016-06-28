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
            AND cl.lineal_id IN (' . $in['lineas'] . ')
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
            'cliente_tipo' => '',
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
, d.cliente_tipo
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
AND d.estado_real = 3
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
        
        $ou = array();        
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
        /* MODALIDAD
          +----+--------------+
          | id | nombre       |
          +----+--------------+
          |  1 | Alta Nueva   |
          |  2 | Portabilidad |
          +----+--------------+
         */
        foreach($data['datos'] as $r) {           
            $ou['data'][$r['id']] = $r;
            // ----------------------------------------------- las tarifa
            if ($r['producto'] == '13')
            {
                if ($r['cliente_tipo'] == '2') {
                    $tipo = 'autonomo';                    
                    
                    $mo = 'Alta Nueva';                    
                    if ($r['fijo_modalidad'] == '1') $mo = 'Alta Nueva';
                    if ($r['fijo_modalidad'] == '2') $mo = 'Portabilidad';
                    
                    $ou['fibra']['total']['autonomo']
                        ['adsl'][$mo][] = $r['id'];
                    $ou['fibra']['supervisor'][$r['supervisor']]['autonomo']
                        ['adsl'][$mo][] = $r['id'];
                    $ou['fibra']['asesor_venta'][$r['asesor_venta']]['autonomo']
                        ['adsl'][$mo][] = $r['id'];
                    
                } elseif ($r['cliente_tipo'] == '1') {
                    $tipo = 'residencial';
                    
                    if ($r['con_television'] == '2' || $r['con_television'] == '3') $p = '3P';
                    else $p = '2P';

                    $ou['fibra']['total']['residencial'][$p]
                        ['adsl'][] = $r['id'];
                    $ou['fibra']['supervisor'][$r['supervisor']]['residencial'][$p]
                        ['adsl'][] = $r['id'];
                    $ou['fibra']['asesor_venta'][$r['asesor_venta']]['residencial'][$p]
                        ['adsl'][] = $r['id'];
                }
            } else
            {
                if ($r['cliente_tipo'] == '2')
                { // autonomo
                    if ($r['producto'] == '2'  || $r['producto'] == '3'  || $r['producto'] == '4'  || $r['producto'] == '5' ) $mb = '50MB';
                    if ($r['producto'] == '6'  || $r['producto'] == '7'  || $r['producto'] == '8'  || $r['producto'] == '9' ) $mb = '120MB';
                    if ($r['producto'] == '10' || $r['producto'] == '11' || $r['producto'] == '14' || $r['producto'] == '1' ) $mb = '300MB';

                    $mo = 'Alta Nueva';
                    if ($r['fijo_modalidad'] == '1') $mo = 'Alta Nueva';
                    if ($r['fijo_modalidad'] == '2') $mo = 'Portabilidad';
                
                    $ou['fibra']['total']['autonomo']['fibra']
                        [$mb][$mo][] = $r['id'];
                    $ou['fibra']['supervisor'][$r['supervisor']]['autonomo']['fibra']
                        [$mb][$mo][] = $r['id'];
                    $ou['fibra']['asesor_venta'][$r['asesor_venta']]['autonomo']['fibra']
                        [$mb][$mo][] = $r['id'];
                    $tipo = 'autonomo';
                }
                elseif($r['cliente_tipo'] == '1')
                { // residencial
                    if ($r['con_television'] == '2' || $r['con_television'] == '3') $p = '3P';
                    else $p = '2P';
                
                    if ($r['producto'] == '2'  || $r['producto'] == '3'  || $r['producto'] == '4'  || $r['producto'] == '5' ) $mb = '50MB';
                    if ($r['producto'] == '6'  || $r['producto'] == '7'  || $r['producto'] == '8'  || $r['producto'] == '9' ) $mb = '120MB';
                    if ($r['producto'] == '10' || $r['producto'] == '11' || $r['producto'] == '14' || $r['producto'] == '1' ) $mb = '300MB';
                
                    $ou['fibra']['total']['residencial'][$p]
                        [$mb][] = $r['id'];
                    $ou['fibra']['supervisor'][$r['supervisor']]['residencial'][$p]
                        [$mb][] = $r['id'];
                    $ou['fibra']['asesor_venta'][$r['asesor_venta']]['residencial'][$p]
                        [$mb][] = $r['id'];
                    $tipo = 'residencial';
                }
            }
            // ----------------------------------------------- las lineas
            
            
            
            if ('' != trim($r['movil_numero']) && $r['movil_modalidad'] != '0' && $r['movil_modalidad'] != '4')
            {
                if ($r['movil_tarifa'] == '1') $m = 'S';
                if ($r['movil_tarifa'] == '2') $m = 'M';
                if ($r['movil_tarifa'] == '3') $m = 'L';

                if ($tipo == 'autonomo')
                {
                    $ou['movil']['total'][$tipo]['linea 1'][$m][] = $r['id'];
                    $ou['movil']['supervisor'][$r['supervisor']][$tipo]['linea 1'][$m][] = $r['id'];
                    $ou['movil']['asesor_venta'][$r['asesor_venta']][$tipo]['linea 1'][$m][] = $r['id'];                    
                }
                elseif ($tipo == 'residencial')
                {
                    $ou['movil']['total'][$tipo][$m][] = $r['id'];
                    $ou['movil']['supervisor'][$r['supervisor']][$tipo][$m][] = $r['id'];
                    $ou['movil']['asesor_venta'][$r['asesor_venta']][$tipo][$m][] = $r['id'];
                }
            }
            if ('' != trim($r['movil_adicional_1_numero']) && $r['movil_adicional_1_modalidad'] != '0' && $r['movil_adicional_1_modalidad'] != '4')
            {
                if ($r['movil_adicional_1_tarifa'] == '1') $m = 'S';
                if ($r['movil_adicional_1_tarifa'] == '2') $m = 'M';
                if ($r['movil_adicional_1_tarifa'] == '3') $m = 'L';

                if ($tipo == 'autonomo')
                {
                    $ou['movil']['total'][$tipo]['linea 2'][$m][] = $r['id'];
                    $ou['movil']['supervisor'][$r['supervisor']][$tipo]['linea 2'][$m][] = $r['id'];
                    $ou['movil']['asesor_venta'][$r['asesor_venta']][$tipo]['linea 2'][$m][] = $r['id'];
                }
                elseif ($tipo == 'residencial')
                {
                    $ou['movil']['total'][$tipo][$m][] = $r['id'];
                    $ou['movil']['supervisor'][$r['supervisor']][$tipo][$m][] = $r['id'];
                    $ou['movil']['asesor_venta'][$r['asesor_venta']][$tipo][$m][] = $r['id'];                    
                }
            }
            if ('' != trim($r['movil_adicional_2_numero']) && $r['movil_adicional_2_modalidad'] != '0' && $r['movil_adicional_2_modalidad'] != '4')
            {
                if ($r['movil_adicional_2_tarifa'] == '1') $m = 'S';
                if ($r['movil_adicional_2_tarifa'] == '2') $m = 'M';
                if ($r['movil_adicional_2_tarifa'] == '3') $m = 'L';
                
                if ($tipo == 'autonomo')
                {
                    $ou['movil']['total'][$tipo]['linea 2'][$m][] = $r['id'];
                    $ou['movil']['supervisor'][$r['supervisor']][$tipo]['linea 2'][$m][] = $r['id'];
                    $ou['movil']['asesor_venta'][$r['asesor_venta']][$tipo]['linea 2'][$m][] = $r['id'];                    
                }
                elseif ($tipo == 'residencial')
                {
                    $ou['movil']['total'][$tipo][$m][] = $r['id'];
                    $ou['movil']['supervisor'][$r['supervisor']][$tipo][$m][] = $r['id'];
                    $ou['movil']['asesor_venta'][$r['asesor_venta']][$tipo][$m][] = $r['id'];                    
                }
            }
        }
        return $ou;
    }
    function campania_001_Vodafon_one_html_header() {
        $ou = '';
        $ou .= '<div class="tablas-comisiones">';
        $ou .= '<table>';
        $ou .= '
               <tr>
                <th colspan="2" rowspan="2">&nbsp;</th>

                <th colspan="3">Residencial</th>
                <th colspan="4">Lineas</th>
                <th colspan="3">Autonomos</th>
                <th colspan="3">1ra Linea</th>
                <th colspan="3">2da y 3ra Linea</th>
                <th colspan="1">Lineas</th>
                <th colspan="2">Total</th>
               </tr>
               <tr>
                <th colspan="1"><a title="(Fibra + Telf)">2P</a></th>
                <th colspan="1"><a title="(Fibra + Telf + TV extra)">3P</a></th>
                <th colspan="1">SubTotal</th>
                <th colspan="1"><a title="Small">S</a></th>
                <th colspan="1"><a title="Medium">M</a></th>
                <th colspan="1"><a title="Large">L</a></th>
                <th colspan="1">SubTotal</th>
                <!--  --!>
                <th colspan="1">Alta Nueva</th>
                <th colspan="1">Portabilidad</th>
                <th colspan="1">SubTotal</th>
                <th colspan="1"><a title="Small">S</a></th>
                <th colspan="1"><a title="Medium">M</a></th>
                <th colspan="1"><a title="Large">L</a></th>
                <th colspan="1"><a title="Small">S</a></th>
                <th colspan="1"><a title="Medium">M</a></th>
                <th colspan="1"><a title="Large">L</a></th>
                <th colspan="1">SubTotal</th>
                <th colspan="1">Ventas</th>
                <th colspan="1">Lineas</th>
               </tr>
             ';
        return $ou;
    }
    function campania_001_Vodafon_one_html_footer() {
        $ou = '';
        $ou .= '</table>';
        $ou .= '</div>';        
        return $ou;        
    }
    function campania_001_Vodafon_one_html_body($titulo, $fibra, $movil) {
        $ou = '';
        // --------------------------------------------- lineas
        if (!isset($movil['residencial']['S']))
            $movil['residencial']['S'] = array();
        if (!isset($movil['residencial']['M']))
            $movil['residencial']['M'] = array();
        if (!isset($movil['residencial']['L']))
            $movil['residencial']['L'] = array();
        //
        if (!isset($movil['autonomo']['linea 1']['S']))
            $movil['autonomo']['linea 1']['S'] = array();
        if (!isset($movil['autonomo']['linea 1']['M']))
            $movil['autonomo']['linea 1']['M'] = array();
        if (!isset($movil['autonomo']['linea 1']['L']))
            $movil['autonomo']['linea 1']['L'] = array();
        
        if (!isset($movil['autonomo']['linea 2']['S']))
            $movil['autonomo']['linea 2']['S'] = array();
        if (!isset($movil['autonomo']['linea 2']['M']))
            $movil['autonomo']['linea 2']['M'] = array();
        if (!isset($movil['autonomo']['linea 2']['L']))
            $movil['autonomo']['linea 2']['L'] = array();
        
        // --------------------------------------------- 300
        if (!isset($fibra['residencial']['2P']['300MB']))
            $fibra['residencial']['2P']['300MB'] = array();
        if (!isset($fibra['residencial']['3P']['300MB']))
            $fibra['residencial']['3P']['300MB'] = array();
        //
        if (!isset($fibra['autonomo']['fibra']['300MB']['Alta Nueva']))
            $fibra['autonomo']['fibra']['300MB']['Alta Nueva'] = array();
        if (!isset($fibra['autonomo']['fibra']['300MB']['Portabilidad']))
            $fibra['autonomo']['fibra']['300MB']['Portabilidad'] = array();

        // ----------------------------------------- 120
        if (!isset($fibra['residencial']['2P']['120MB']))
            $fibra['residencial']['2P']['120MB'] = array();
        if (!isset($fibra['residencial']['3P']['120MB']))
            $fibra['residencial']['3P']['120MB'] = array();
        //
        if (!isset($fibra['autonomo']['fibra']['120MB']['Alta Nueva']))
            $fibra['autonomo']['fibra']['120MB']['Alta Nueva'] = array();
        if (!isset($fibra['autonomo']['fibra']['120MB']['Portabilidad']))
            $fibra['autonomo']['fibra']['120MB']['Portabilidad'] = array();

        // ----------------------------------------- 50        
        if (!isset($fibra['residencial']['2P']['50MB']))
            $fibra['residencial']['2P']['50MB'] = array();
        if (!isset($fibra['residencial']['3P']['50MB']))
            $fibra['residencial']['3P']['50MB'] = array();
        //
        if (!isset($fibra['autonomo']['fibra']['50MB']['Alta Nueva']))
            $fibra['autonomo']['fibra']['50MB']['Alta Nueva'] = array();
        if (!isset($fibra['autonomo']['fibra']['50MB']['Portabilidad']))
            $fibra['autonomo']['fibra']['50MB']['Portabilidad'] = array();
        
        // ----------------------------------------- adsl        
        if (!isset($fibra['autonomo']['adsl']['Alta Nueva']))
            $fibra['autonomo']['adsl']['Alta Nueva'] = array();
        if (!isset($fibra['autonomo']['adsl']['Portabilidad']))
            $fibra['autonomo']['adsl']['Portabilidad'] = array();
        // 
        if (!isset($fibra['residencial']['3P']['adsl']))
            $fibra['residencial']['3P']['adsl'] = array();
        if (!isset($fibra['residencial']['2P']['adsl']))
            $fibra['residencial']['2P']['adsl'] = array();

        // ------------------------------------------ TOTAL
        $total_1 = count($fibra['residencial']['2P']['300MB']) 
                 + count($fibra['residencial']['2P']['120MB'])
                 + count($fibra['residencial']['2P']['50MB'])
                 + count($fibra['residencial']['3P']['300MB']) 
                 + count($fibra['residencial']['3P']['120MB'])
                 + count($fibra['residencial']['3P']['50MB'])
                 ;
        $total_2 = count($movil['residencial']['S'])
                 + count($movil['residencial']['M'])
                 + count($movil['residencial']['L'])
                 ;
        $total_3 = count($fibra['autonomo']['fibra']['300MB']['Alta Nueva'])
                 + count($fibra['autonomo']['fibra']['300MB']['Portabilidad'])
                 + count($fibra['autonomo']['fibra']['120MB']['Alta Nueva'])
                 + count($fibra['autonomo']['fibra']['120MB']['Portabilidad'])
                 + count($fibra['autonomo']['fibra']['50MB']['Alta Nueva'])
                 + count($fibra['autonomo']['fibra']['50MB']['Portabilidad'])
                 + count($fibra['autonomo']['adsl']['Alta Nueva'])
                 + count($fibra['autonomo']['adsl']['Portabilidad'])
                 ;        
        $total_4 = count($movil['autonomo']['linea 1']['S'])
                 + count($movil['autonomo']['linea 1']['M'])
                 + count($movil['autonomo']['linea 1']['L'])
                 + count($movil['autonomo']['linea 2']['S'])
                 + count($movil['autonomo']['linea 2']['M'])
                 + count($movil['autonomo']['linea 2']['L'])
                 ;
        $total_5 = $total_1 + $total_3;
        $total_6 = $total_2 + $total_4;
        $ou .= '
              <tr>
               <th rowspan="4" style="width: 100px;">' . $titulo . '</th>   
               <th>Fibra 300MB</th>
               <td>' . count($fibra['residencial']['2P']['300MB']) . '</td>
               <td>' . count($fibra['residencial']['3P']['300MB']) . '</td>
               <th rowspan="4">' . $total_1 . '</th>
               <td rowspan="4">' . count($movil['residencial']['S']) . '</td>
               <td rowspan="4">' . count($movil['residencial']['M']) . '</td>
               <td rowspan="4">' . count($movil['residencial']['L']) . '</td>
               <th rowspan="4">' . $total_2 . '</th>
               <!--  --!>
               <td>' . count($fibra['autonomo']['fibra']['300MB']['Alta Nueva']) . '</td>
               <td>' . count($fibra['autonomo']['fibra']['300MB']['Portabilidad']) . '</td>
               <th rowspan="4">' . $total_3 . '</th>
               <td rowspan="4">' . count($movil['autonomo']['linea 1']['S']) . '</td>
               <td rowspan="4">' . count($movil['autonomo']['linea 1']['M']) . '</td>
               <td rowspan="4">' . count($movil['autonomo']['linea 1']['L']) . '</td>

               <td rowspan="4">' . count($movil['autonomo']['linea 2']['S']) . '</td>
               <td rowspan="4">' . count($movil['autonomo']['linea 2']['M']) . '</td>
               <td rowspan="4">' . count($movil['autonomo']['linea 2']['L']) . '</td>
               <th rowspan="4">' . $total_4 . '</th>
               <th rowspan="4">' . $total_5 . '</th>
               <th rowspan="4">' . $total_6 . '</th>
              </tr>
               ';        

        $ou .= '<tr>
               <th>Fibra 120MB</th>
               <td>' . count($fibra['residencial']['2P']['120MB']) . '</td>
               <td>' . count($fibra['residencial']['3P']['120MB']) . '</td>
               <!--  --!>
               <td>' . count($fibra['autonomo']['fibra']['120MB']['Alta Nueva']) . '</td>
               <td>' . count($fibra['autonomo']['fibra']['120MB']['Portabilidad']) . '</td>
              </tr>
             ';

        $ou .= '<tr>
               <th>Fibra 50MB</th>
               <td>' . count($fibra['residencial']['2P']['50MB']) . '</td>
               <td>' . count($fibra['residencial']['3P']['50MB']) . '</td>
               <!--  --!>
               <td>' . count($fibra['autonomo']['fibra']['50MB']['Alta Nueva']) . '</td>
               <td>' . count($fibra['autonomo']['fibra']['50MB']['Portabilidad']) . '</td>
              </tr>
             ';
        $ou .= '</tr>';
        
        $ou .= '<tr>
               <th>ADSL</th>
               <td>' . count($fibra['residencial']['2P']['adsl']) . '</td>
               <td>' . count($fibra['residencial']['3P']['adsl']) . '</td>
               <!--  --!>
               <td>' . count($fibra['autonomo']['adsl']['Alta Nueva']) . '</td> 
               <td>' . count($fibra['autonomo']['adsl']['Portabilidad']) . '</td> 
              </tr>
             ';
        $ou .= '</tr>';
        $ou .= '<tr><th colspan="21"></th></tr>';
        return $ou ;
    }
}
