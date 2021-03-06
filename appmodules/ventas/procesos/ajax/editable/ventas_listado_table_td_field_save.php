<?php
include "../../../../../lib/mysql/dbconnector.php";
include "../../../../../lib/mysql/conexion01.php";
include "../../../../../lib/mysql/utilidades.php";
include "../../../modelo/ModeloVenta.php";
session_start();
$modelo = new ModeloVenta();


// -------------------------------------------------------- INPUT
$in['campo']       = Utilidades::clear_input($_POST['campo']);
$in['venta_id']    = Utilidades::clear_input_id($_POST['venta_id']);
$in['campania']    = $modelo->getCampaniaEditable($in['venta_id']) ;
$in['fecha'] = date('Y-m-d H:i:s');
$in['usuario']     = $_SESSION['user_id'];
$in['perfil']      = trim($_SESSION['perfiles']);

if ($in['campo'] == 'info_create_fecha')
    $in['tabla'] = 'venta';
elseif ($in['campo'] == 'asesor_venta_id')
    $in['tabla'] = 'venta';
elseif ($in['campo'] == 'supervisor_id')
    $in['tabla'] = 'venta';
else
    $in['tabla'] = 'venta_' . $in['campania'];


$in['valor']       = Utilidades::clear_input_text($_POST['valor']);


// --------------------------------------------------------- DATA
$old = $modelo->getValorEditable($in);

// ------------------------------------------ esto es para el log
$log_campos = '';
if ($in['campo'] == 'agendado_fecha') {
    $old = substr($old, 0, 16);
}
if (utf8_encode($in['valor']) != utf8_encode($old)) {
    $log_campos = $modelo->drawLogItem(
        $in['tabla']
        , $in['campo']
        , $old
        , $in['valor']
    );
    $healthy = array("\n\r", "\r\n", "\n", "\r", "\t");
    $yummy   = array("<br>", "<br>", "<br>", "<br>", " ");    
    $log_campos = str_replace($healthy, $yummy, $log_campos);
    
    $modelo->drawDivLogItem(
        $in['campania']
        , $in['venta_id']
        , $in['usuario']
        , $in['fecha']
        , utf8_encode($log_campos)
    );
}

// ----------------------------------- guardar
$modelo->setValorEditable($in);
// Utilidades::printr($in);
if ($in['campo'] == 'estado_real') {
    $in['campo'] = 'estado';
    $in['valor'] = $modelo->getEstadoRealToEstado($in['valor']);
    $modelo->setValorEditable($in);
}
if ($in['campo'] == 'supervisor_id') {
    $in['campo'] = 'lineal_id ';
    $sql = '
    SELECT ul.lineal_id FROM usu_usuario_lineal ul
    WHERE ul.usuario_id=' . $in['valor'] . '   
    ';
    $data = $modelo->setSQL(array('id' => '')  , $sql);
    if (isset($data[0]['id'])) {
        $in['valor'] = $data[0]['id'];
        // print_r($in);
        $modelo->setValorEditable($in);
    }
}
// Utilidades::printr($in);