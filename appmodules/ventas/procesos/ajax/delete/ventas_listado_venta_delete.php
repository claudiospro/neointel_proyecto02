<?php
include "../../../../../lib/mysql/dbconnector.php";
include "../../../../../lib/mysql/conexion01.php";
include "../../../../../lib/mysql/utilidades.php";
include "../../../modelo/ModeloVenta.php";
session_start();
$venta = new ModeloVenta();

// -------------------------------------------------------- INPUT
$in['id'] = Utilidades::clear_input_id($_POST['venta_id']);
$in['fecha'] = date('Y-m-d H:i:s');
$in['user'] = $_SESSION['user_id'];


// -------------------------------------------------------- DATA
$venta->deleteVenta($in);

// -------------------------------------------------------- TEST
// print_r($in);
