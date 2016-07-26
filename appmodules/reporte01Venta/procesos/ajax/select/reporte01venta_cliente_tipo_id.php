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
$in['cliente_tipo_id'] = Utilidades::clear_input($_POST['cliente_tipo_id']);
// -------------------------------------------------------- Data
$ou = $venta->getClienteTipoByCampania($in);
if ($ou) {
    $combo = new OptionComboSimple();
    $combo->set_option($in['cliente_tipo_id']);
    $combo->set_format(array('id', 'nombre'));
    $combo->imprimir($ou);
}



// -------------------------------------------------------- TEST
// Utilidades::printr($in);
// Utilidades::printr($ou);


// -------------------------------------------------------- OUT
