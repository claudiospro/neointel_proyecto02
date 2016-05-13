<?php 
require_once '../autentificacion/modelo/logica.php';
ModeloAuten::user_log('Reporte-01-Venta', '../autentificacion/index.php');

include "../../lib/mysql/dbconnector.php";
include "../../lib/mysql/conexion01.php";
include "../../lib/mysql/utilidades.php";
include "./modelo/ModeloReporte01.php";


$data1 = null;

$in['modo'] = 'Estructura';
if( 'Supervisor' == trim($_SESSION['perfiles']))
{
    $in['modo'] = 'Supervisor';
}

if (isset($_GET['anio-mes-ini'])) {
    $modelo = new ModeloVenta();

    // -------------------------------------------------------- INPUT
    $in['anio-mes-ini'] = Utilidades::clear_input($_GET['anio-mes-ini']);
    $in['anio-mes-end'] = Utilidades::clear_input($_GET['anio-mes-end']);
    $in['dia-ini'] = Utilidades::clear_input($_GET['dia-ini']);
    $in['dia-end'] = Utilidades::clear_input($_GET['dia-end']);
    $in['tipo'] = Utilidades::clear_input($_GET['tipo']);
    $l = explode('-', $in['anio-mes-ini']);
    $in['anio'] = $l[0];
    $in['mes'] = $l[1];
    if (isset($_GET['supervisor_id']) && $_GET['supervisor_id'] !='') {
        $in['supervisor_id'] = Utilidades::clear_input($_GET['supervisor_id']);
    } else {
        $in['supervisor_id'] = '00';
    }
    if (isset($_GET['asesor_comercial_id']) && $_GET['asesor_comercial_id'] !='') {
        $in['asesor_comercial_id'] = Utilidades::clear_input($_GET['asesor_comercial_id']);
    } else {
        $in['asesor_comercial_id'] = '00';
    }    
    $in['lineas'] = Utilidades::clear_input($_SESSION['lineas']);

    
    // ------------------------------------------------------- OUTPUT
    $data0 = $modelo->getDatos($in);
    if (isset($data0)) {
        $data1[0] = array();
        
        $mes = array (1 => 'Enero', 2 => 'Febreo', 3 => 'Marzo', 4 => 'Abril', 5 => 'Mayo', 6 => 'Junio', 7 => 'Julio', 8 => 'Agosto', 9 => 'Septiembre', 10 => 'Octubre', 11 => 'Noviembre', 12 => 'Diciembre');

    
        $data1[0]['titulo'] = 'Ventas: Totales';
        $data1[0]['tab'] = 'Total';
        
        if (isset($data0['indice']))
            foreach($data0['indice'] as $key => $row) {
                $data1[$row]['titulo'] = 'Ventas: ' . $data0['indice_nombre'][$key];
                $data1[$row]['tab'] = $data0['indice_nombre'][$key] ;
            }
        if (isset($data0['estado']) && $in['tipo'] == '01')
            foreach($data0['estado'] as $row) {
                // busco en listado
                $index = $data0['indice'][$row['campania']];
                $e = $row['estado_id'];
                $data1[$index]['estado'][$e] = array ('name'=>$row['estado'], 'y'=>$row['total'], 'drilldown' => $row['estado']);
                if (!isset( $data1[0]['estado'][$e]))
                    $data1[0]['estado'][$e] = $data1[$index]['estado'][$e];
                else
                    $data1[0]['estado'][$e]['y'] += $row['total'];
            }
        if (isset($data0['estado_real']) && $in['tipo'] == '01')
            foreach($data0['estado_real'] as $row) {
                // busco en listado
                $index = $data0['indice'][$row['campania']];
                $e = $row['estado'];
                $er = $row['estado_real_id'];
                $data1[$index]['estado_real'][$e][$er] = array ( 'name'=>$row['estado_real'], 'y'=>$row['total'] );
                if (!isset($data1[0]['estado_real'][$e][$er]))
                    $data1[0]['estado_real'][$e][$er] = $data1[$index]['estado_real'][$e][$er];
                else
                    $data1[0]['estado_real'][$e][$er]['y'] += $row['total'];
            }
        // ---------------------------------------------------------------------------------------
        if (isset($data0['cliente_tipo']) && $in['tipo'] == '02')
            foreach($data0['cliente_tipo'] as $row) {
                // busco en listado
                $index = $data0['indice'][$row['campania']];
                $e = $row['cliente_tipo_id'];
                $data1[$index]['cliente_tipo'][$e] = array ('name'=>$row['cliente_tipo'], 'y'=>$row['total'], 'drilldown' => $row['cliente_tipo']);
                if (!isset( $data1[0]['cliente_tipo'][$e]))
                    $data1[0]['cliente_tipo'][$e] = $data1[$index]['cliente_tipo'][$e];
                else
                    $data1[0]['cliente_tipo'][$e]['y'] += $row['total'];
            }
        if (isset($data0['estado_real']) && $in['tipo'] == '02')
            foreach($data0['estado_real'] as $row) {
                // busco en listado
                $index = $data0['indice'][$row['campania']];
                $e = $row['cliente_tipo'];
                $er = $row['estado_real_id'];
                $data1[$index]['estado_real'][$e][$er] = array ( 'name'=>$row['estado_real'], 'y'=>$row['total'] );
                if (!isset($data1[0]['estado_real'][$e][$er]))
                    $data1[0]['estado_real'][$e][$er] = $data1[$index]['estado_real'][$e][$er];
                else
                    $data1[0]['estado_real'][$e][$er]['y'] += $row['total'];
            }
    }
    

    
    // --------------------------------------------------------- TEST
    // Utilidades::printr($in);
    // Utilidades::printr($data0);
    // Utilidades::printr($data1);
} else {
    $in['anio-mes-ini'] = date('Y-m');
    $in['anio-mes-end'] = date('Y-m');
    $in['dia-ini'] = '00';
    $in['dia-end'] = '00';
    $in['tipo'] = '01';
    $in['supervisor_id'] = '00';
    $in['asesor_comercial_id'] = '00';
    $in['lineas'] = Utilidades::clear_input($_SESSION['lineas']);
}

// $data[0]['titulo'] = 'Ventas Totales - Marzo 2015';
// $data[0]['tab'] = 'Total';

// $data[0]['estado'][1] = array('name'=>'En tramitacion', 'y'=>'500', 'drilldown'=>'En tramitacion');
// $data[0]['estado'][2] = array('name'=>'Ok tramitado', 'y'=>'100', 'drilldown'=>'Ok tramitado');
// $data[0]['estado'][3] = array('name'=>'Ko cliente', 'y'=>'300', 'drilldown'=>'Ko cliente');

// $data[0]['estado_real']['En tramitacion'][1] = array('name'=>'Pendiente' , 'y'=>'50');
// $data[0]['estado_real']['En tramitacion'][2] = array('name'=>'En Tramitación' , 'y'=>'50');
// $data[0]['estado_real']['En tramitacion'][3] = array('name'=>'Autoinstalable', 'y'=>'50');
// $data[0]['estado_real']['En tramitacion'][4] = array('name'=>'Incidencia cliente', 'y'=>'50');
// $data[0]['estado_real']['En tramitacion'][5] = array('name'=>'Pendiente de instalación', 'y'=>'50');
// $data[0]['estado_real']['En tramitacion'][6] = array('name'=>'Pendiente de documentación', 'y'=>'50');
// $data[0]['estado_real']['En tramitacion'][7] = array('name'=>'Desconectada', 'y'=>'100');
// $data[0]['estado_real']['En tramitacion'][8] = array('name'=>'Pendiente por documentacion', 'y'=>'100');

// $data[0]['estado_real']['Ok tramitado'][1] = array('name'=>'Pendiente' , 'y'=>'100');


// $data[1]['titulo'] = 'OASDDK - Marzo 2015';
// $data[1]['tab'] = 'OASDDK';

// $data[1]['estado'][1] = array('name'=>'En tramitacion', 'y'=>'100', 'drilldown'=>'En tramitacion');
// $data[1]['estado'][2] = array('name'=>'Ok tramitado', 'y'=>'150', 'drilldown'=>'');
// $data[1]['estado'][3] = array('name'=>'Ko cliente', 'y'=>'150', 'drilldown'=>'');

// $data[1]['estado_real']['En tramitacion'][1] = array('name'=>'Pendiente' , 'y'=>'10');
// $data[1]['estado_real']['En tramitacion'][2] = array('name'=>'En Tramitación' , 'y'=>'20');
// $data[1]['estado_real']['En tramitacion'][3] = array('name'=>'Autoinstalable', 'y'=>'10');
// $data[1]['estado_real']['En tramitacion'][4] = array('name'=>'Incidencia cliente', 'y'=>'10');
// $data[1]['estado_real']['En tramitacion'][5] = array('name'=>'Pendiente de instalación', 'y'=>'20');
// $data[1]['estado_real']['En tramitacion'][6] = array('name'=>'Pendiente de documentación', 'y'=>'10');
// $data[1]['estado_real']['En tramitacion'][7] = array('name'=>'Desconectada', 'y'=>'10');
// $data[1]['estado_real']['En tramitacion'][8] = array('name'=>'Pendiente por documentacion', 'y'=>'10');

 $data = $data1 ;
// Utilidades::printr($data0);
// Utilidades::printr($data);

require 'vista/mes.tpl.php';
