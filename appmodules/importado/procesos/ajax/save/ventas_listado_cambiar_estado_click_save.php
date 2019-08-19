<?php
include "../../../../../lib/mysql/dbconnector.php";
include "../../../../../lib/mysql/conexion01.php";
include "../../../../../lib/mysql/utilidades.php";
include "../../../modelo/ModeloBarrido.php";
session_start();
$modelo = new ModeloBarrido();
// -------------------------------------------------------- INPUT
$in['estado'] = Utilidades::sanear_string($_POST['estado']);
$in['ids'] = explode(',',Utilidades::clear_input_id($_POST['ids'])) ;
$in['fecha'] = date('Y-m-d H:i:s');
$in['usuario'] = $_SESSION['user_id'];


// -------------------------------------------------------- Data
foreach($in['ids'] as $row) {
    $l = explode('::', $row);
    $in['id'] =$l[0];
    $in['campania'] = $l[1];
    $modelo->updateVenta($in);
}

// $campos = $venta->getcampos($in);


// -------------------------------------------------------- TEST
// print_r($in);
$l = explode('::', $in['ids'][0]);
echo $l[0];