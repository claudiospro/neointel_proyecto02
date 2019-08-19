<?php
include "../../../../../lib/mysql/dbconnector.php";
include "../../../../../lib/mysql/conexion01.php";
include "../../../../../lib/mysql/utilidades.php";
include "../../../modelo/ModeloBarrido.php";

$modelo = new ModeloBarrido();
session_start();

// -------------------------------------------------------- INPUT
$in['campania'] =  Utilidades::clear_input($_POST['campania']);
$in['estado_real'] = Utilidades::clear_input_id($_POST['estado_real']);
$in['estado'] = $modelo->getEstadoRealToEstado($in['estado_real']);
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
