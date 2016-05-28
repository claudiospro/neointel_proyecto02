<?php
include "../../../../../lib/mysql/dbconnector.php";
include "../../../../../lib/mysql/conexion01.php";
include "../../../../../lib/mysql/utilidades.php";
include "../../../../../lib/html/tabla.php";
include "../../../modelo/ModeloReporte01.php";

session_start();
$venta = new ModeloVenta();
// -------------------------------------------------------- INPUT
$in['campania_id'] = Utilidades::clear_input($_POST['campania_id']);
$in['lineas'] = Utilidades::clear_input($_SESSION['lineas']);
// -------------------------------------------------------- Data
$ou = $venta->getCampaniasActivas($in);

if ($ou) {
    $combo = new OptionComboSimple0();
    $combo->set_option($in['campania_id']);
    $combo->set_format(array('indice', 'nombre'));
    $combo->imprimir($ou);
}





// -------------------------------------------------------- TEST

// Utilidades::printr($in);
// Utilidades::printr($ou);


// -------------------------------------------------------- OUT
