<?php
include "../../../../../lib/mysql/dbconnector.php";
include "../../../../../lib/mysql/conexion01.php";
include "../../../../../lib/mysql/utilidades.php";
include "../../../modelo/ModeloVenta.php";
session_start();
$venta = new ModeloVenta();

// -------------------------------------------------------- INPUT
$in['campo']       = Utilidades::clear_input($_POST['campo']);
$in['venta_id']    = Utilidades::clear_input_id($_POST['venta_id']);
$in['campania']    = $venta->getCampaniaEditable($in['venta_id']) ;
$in['usuario']     = $_SESSION['user_id'];
$in['perfil']    = trim($_SESSION['perfiles']);
$in['estado_real'] = $venta->getEstadoTramitacionIdEditable($in);
$in['valor']       = $venta->getValorEditable($in);

// -------------------------------------------------------- Data

$mostrar = false;
if ($in['campo'] == 'estado_real') {
    if ($in['perfil'] == 'Admin' || $in['perfil'] == 'Tramitacion' ) {
        $mostrar = true;
    } else {
        if ($in['perfil'] == 'Tramitacion-Validacion-Carga' && $in['estado_real'] != 3) $mostrar = true;
        if ($in['perfil'] == 'Tramitacion-Carga' && $in['estado_real'] != 1 && $in['estado_real'] != 3) $mostrar = true;
        if ($in['perfil'] == 'Tramitacion-Validacion' && $in['estado_real'] != 2 && $in['estado_real'] != 3 ) $mostrar = true;
    }
    if ($mostrar) {
        Utilidades::printr($in);
    } else  echo '-1';
    
} elseif ($in['campo'] == 'estado_observacion') {
    if ($in['perfil'] == 'Admin' || $in['perfil'] == 'Tramitacion' ) $mostrar = true;
    if ($mostrar) {
        Utilidades::printr($in);
    } else  echo '-1';

} else {
    Utilidades::printr($in);
}





