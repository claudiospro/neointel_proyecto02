<?php 
require_once '../autentificacion/modelo/logica.php';
ModeloAuten::user_log('Reporte-01-Venta', '../autentificacion/index.php');

include "../../lib/mysql/dbconnector.php";
include "../../lib/mysql/conexion01.php";
include "../../lib/mysql/utilidades.php";
include "./modelo/ModeloReporte01.php";


$data1 = null;
if (isset($_GET['anio-mes'])) {
    $modelo = new ModeloVenta();

    // -------------------------------------------------------- INPUT
    $in['anio-mes'] = Utilidades::clear_input($_GET['anio-mes']);
    $l = explode('-', $in['anio-mes']);
    $in['anio'] = $l[0];
    $in['mes'] = $l[1];
    $in['lineas'] = Utilidades::clear_input($_SESSION['lineas']);

    
    // ------------------------------------------------------- OUTPUT
    $data0 = $modelo->getDatos($in);
    if (isset($data0) && $data0['estado']!=null) {
        $data1[0] = array();
        
        $mes = array (1 => 'Enero', 2 => 'Febreo', 3 => 'Marzo', 4 => 'Abril', 5 => 'Mayo', 6 => 'Junio', 7 => 'Julio', 8 => 'Agosto', 9 => 'Septiembre', 10 => 'Octubre', 11 => 'Noviembre', 12 => 'Diciembre');

    
        $data1[0]['titulo'] = 'Ventas: Total, ' . $mes[ (int)$in['mes'] ] . ' ' . $in['anio'];
        $data1[0]['tab'] = 'Total';
        
        
        foreach($data0['indice'] as $key => $row) {
            $data1[$row]['titulo'] = 'Ventas: ' . $data0['indice_nombre'][$key] . ', ' . $mes[ (int)$in['mes'] ] . ' ' . $in['anio'];
            $data1[$row]['tab'] = $data0['indice_nombre'][$key] ;
        }
        
        foreach($data0['estado'] as $row) {
            // busco en listado
            $data1[ $data0['indice'][$row['campania']] ]['estado'][ $row['estado_id'] ] = array ('name'=>$row['estado'], 'y'=>$row['total'], 'drilldown' => $row['estado']);
            if (!isset( $data1[0]['estado'][ $row['estado_id'] ] ))
                $data1[0]['estado'][ $row['estado_id'] ] = $data1[ $data0['indice'][$row['campania']] ]['estado'][ $row['estado_id'] ];
            else
                $data1[0]['estado'][ $row['estado_id'] ]['y'] += $row['total'];
        }
    }
    

    
    // --------------------------------------------------------- TEST
    // Utilidades::printr($in);
    // Utilidades::printr($data0);
    // Utilidades::printr($data1);
} else {
    $in['anio-mes'] = date('Y-m');;
}

$data[0]['titulo'] = 'Ventas Totales - Marzo 2015';
$data[0]['tab'] = 'Total';

$data[0]['estado'][1] = array('name'=>'En tramitacion', 'y'=>'500', 'drilldown'=>'En tramitacion');
$data[0]['estado'][2] = array('name'=>'Ok tramitado', 'y'=>'100', 'drilldown'=>'Ok tramitado');
$data[0]['estado'][3] = array('name'=>'Ko cliente', 'y'=>'300', 'drilldown'=>'Ko cliente');

$data[0]['estado_real']['En tramitacion'][1] = array('name'=>'Pendiente' , 'y'=>'50');
$data[0]['estado_real']['En tramitacion'][2] = array('name'=>'En Tramitación' , 'y'=>'50');
$data[0]['estado_real']['En tramitacion'][3] = array('name'=>'Autoinstalable', 'y'=>'50');
$data[0]['estado_real']['En tramitacion'][4] = array('name'=>'Incidencia cliente', 'y'=>'50');
$data[0]['estado_real']['En tramitacion'][5] = array('name'=>'Pendiente de instalación', 'y'=>'50');
$data[0]['estado_real']['En tramitacion'][6] = array('name'=>'Pendiente de documentación', 'y'=>'50');
$data[0]['estado_real']['En tramitacion'][7] = array('name'=>'Desconectada', 'y'=>'100');
$data[0]['estado_real']['En tramitacion'][8] = array('name'=>'Pendiente por documentacion', 'y'=>'100');

$data[0]['estado_real']['Ok tramitado'][1] = array('name'=>'Pendiente' , 'y'=>'100');


$data[1]['titulo'] = 'OASDDK - Marzo 2015';
$data[1]['tab'] = 'OASDDK';

$data[1]['estado'][1] = array('name'=>'En tramitacion', 'y'=>'100', 'drilldown'=>'En tramitacion');
$data[1]['estado'][2] = array('name'=>'Ok tramitado', 'y'=>'150', 'drilldown'=>'');
$data[1]['estado'][3] = array('name'=>'Ko cliente', 'y'=>'150', 'drilldown'=>'');

$data[1]['estado_real']['En tramitacion'][1] = array('name'=>'Pendiente' , 'y'=>'10');
$data[1]['estado_real']['En tramitacion'][2] = array('name'=>'En Tramitación' , 'y'=>'20');
$data[1]['estado_real']['En tramitacion'][3] = array('name'=>'Autoinstalable', 'y'=>'10');
$data[1]['estado_real']['En tramitacion'][4] = array('name'=>'Incidencia cliente', 'y'=>'10');
$data[1]['estado_real']['En tramitacion'][5] = array('name'=>'Pendiente de instalación', 'y'=>'20');
$data[1]['estado_real']['En tramitacion'][6] = array('name'=>'Pendiente de documentación', 'y'=>'10');
$data[1]['estado_real']['En tramitacion'][7] = array('name'=>'Desconectada', 'y'=>'10');
$data[1]['estado_real']['En tramitacion'][8] = array('name'=>'Pendiente por documentacion', 'y'=>'10');

 $data = $data1 ;
// Utilidades::printr($data);

require 'vista/mes.tpl.php';
