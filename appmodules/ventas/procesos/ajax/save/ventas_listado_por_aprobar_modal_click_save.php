<?php
include "../../../../../lib/mysql/dbconnector.php";
include "../../../../../lib/mysql/conexion01.php";
include "../../../../../lib/mysql/utilidades.php";
include "../../../modelo/ModeloVenta.php";
session_start();
$modelo = new ModeloVenta();

// -------------------------------------------------------- INPUT
$in['campania'] = Utilidades::clear_input(Utilidades::sanear_string($_POST['campania']));
$in['venta_id'] = Utilidades::clear_input_id($_POST['venta_id']);
$in['fecha'] = date('Y-m-d H:i:s');
$in['usuario'] = $_SESSION['user_id'];


// -------------------------------------------------------- DATA
$modelo->setVentaPorAprobar($in);


// -------------------------------------------------------- TEST
Utilidades::printr($in);