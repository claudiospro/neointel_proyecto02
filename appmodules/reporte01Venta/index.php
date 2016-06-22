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

if (isset($_GET['campania_id'])) {
    $modelo = new ModeloVenta();

    // -------------------------------------------------------- INPUT
    $in['campania_id'] = Utilidades::clear_input_id($_GET['campania_id']);
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

        if (isset($data0['indice']))
            foreach($data0['indice'] as $key => $row) {
                $data1[$row]['titulo'] = 'Ventas: ' . $data0['indice_nombre'][$key];
                $data1[$row]['tab'] = $data0['indice_nombre'][$key] ;
            }
        // ---------------------------------------------------------------------------------------
        if (isset($data0['estado']) && $in['tipo'] == '01')
            foreach($data0['estado'] as $row) {
                // busco en listado
                $index = $data0['indice'][$row['campania']];
                $e = $row['estado_id'];
                $data1[$index]['estado'][$e] = array ('name'=>$row['estado'], 'y'=>$row['total'], 'drilldown' => $row['estado']);
            }
        if (isset($data0['estado_real']) && $in['tipo'] == '01')
            foreach($data0['estado_real'] as $row) {
                // busco en listado
                $index = $data0['indice'][$row['campania']];
                $e = $row['estado'];
                $er = $row['estado_real_id'];
                $data1[$index]['estado_real'][$e][$er] = array ( 'name'=>$row['estado_real'], 'y'=>$row['total'] );

            }
        // ---------------------------------------------------------------------------------------
        if (isset($data0['cliente_tipo']) && $in['tipo'] == '02')
            foreach($data0['cliente_tipo'] as $row) {
                // busco en listado
                $index = $data0['indice'][$row['campania']];
                $e = $row['cliente_tipo_id'];
                $data1[$index]['cliente_tipo'][$e] = array ('name'=>$row['cliente_tipo'], 'y'=>$row['total'], 'drilldown' => $row['cliente_tipo']);
            }
        if (isset($data0['estado_real']) && $in['tipo'] == '02')
            foreach($data0['estado_real'] as $row) {
                // busco en listado
                $index = $data0['indice'][$row['campania']];
                $e = $row['cliente_tipo'];
                $er = $row['estado_real_id'];
                $data1[$index]['estado_real'][$e][$er] = array ( 'name'=>$row['estado_real'], 'y'=>$row['total'] );
            }
        // ---------------------------------------------------------------------------------------
        if (isset($data0['estados']) && $in['tipo'] == '03')
            foreach($data0['estados'] as $row) {
                $data1['estados'][ $row['id'] ] = array (
                    'nombre' => $row['nombre'],
                    'js' => '',
                );
            }
        if (isset($data0['ventas']) && $in['tipo'] == '03')
            foreach($data0['ventas'] as $row) {
                $data1['ventas'][ $row['asesor_venta_id'] ]
                    [ $row['estado_id'] ] = $row['total'];
            }
        if (isset($data0['asesores']) && $in['tipo'] == '03')
            foreach($data0['asesores'] as $row) {
                if ( isset($data1['ventas'][ $row['id'] ]) ) 
                    $data1['asesores'] [ utf8_encode($row['nombre']) ]
                        = $data1['ventas'][ $row['id'] ];
                else
                    $data1['asesores'] [ utf8_encode($row['nombre']) ] = array();

                // $row['nombre'] $row['id']
            }
        // ---------------------------------------------------------------------------------------
        if (isset($data0['estados']) && $in['tipo'] == '04')
            foreach($data0['estados'] as $row) {
                $data1['estados'][ $row['id'] ] = array (
                    'nombre' => $row['nombre'],
                    'js' => '',
                );
            }
        if (isset($data0['asesores']) && $in['tipo'] == '04')
            foreach($data0['asesores'] as $row) {
                $data1['asesores'] [ utf8_encode($row['asesor_venta']) ]
                    [ $row['estado_id'] ] = $row['total'];
            }
    }
    
    // --------------------------------------------------------- TEST
    // Utilidades::printr($in);
    // Utilidades::printr($data0);
    // Utilidades::printr($data1);
} else {
    $in['campania_id'] = '00';
    $in['anio-mes-ini'] = date('Y-m');
    $in['anio-mes-end'] = date('Y-m');
    $in['dia-ini'] = '00';
    $in['dia-end'] = '00';
    $in['tipo'] = '01';
    $in['supervisor_id'] = '00';
    $in['asesor_comercial_id'] = '00';
    $in['lineas'] = Utilidades::clear_input($_SESSION['lineas']);
}

$data = $data1 ;
// Utilidades::printr($data0);
// Utilidades::printr($data);

require 'vista/mes.tpl.php';
