<?php
include "../../../../../lib/mysql/dbconnector.php";
include "../../../../../lib/mysql/conexion01.php";
include "../../../../../lib/mysql/utilidades.php";
include "../../../modelo/ModeloBarrido.php";

$modelo = new ModeloBarrido();
session_start();

// -------------------------------------------------------- INPUT
$in['campania'] =  Utilidades::clear_input($_POST['campania']);
$in['estado'] = Utilidades::clear_input_id($_POST['estado']);
$in['id'] =  Utilidades::clear_input_id($_POST['venta']) ;
$in['fecha'] = date('Y-m-d H:i:s');
$in['usuario'] = $_SESSION['user_id'];

// -------------------------------------------------------- Data
$modelo->updateVenta($in);

// -------------------------------------------------------- TEST
// Utilidades::printr($in);
// Utilidades::printr($campos);
// Utilidades::printr($dato);

// -------------------------------------------------------- OUT
