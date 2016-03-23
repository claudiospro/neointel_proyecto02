<?php
include "../../../../../lib/mysql/dbconnector.php";
include "../../../../../lib/mysql/conexion01.php";
include "../../../../../lib/mysql/utilidades.php";
include "../../../modelo/ModeloVenta.php";
session_start();
$venta = new ModeloVenta();

// -------------------------------------------------------- INPUT
$in['lineas'] = Utilidades::clear_input_id($_SESSION['lineas']);

// -------------------------------------------------------- DATA

set_time_limit(0); //Establece el número de segundos que se permite la ejecución de un script.
// print_r($_SESSION);
if ( 'Asesor Comercial' != trim($_SESSION['perfiles'])) {
    echo $venta->getTimerEstructura($in);
} else {
    echo '-1';
}
