<?php
include "../../../../../lib/mysql/dbconnector.php";
include "../../../../../lib/mysql/conexion01.php";
include "../../../../../lib/mysql/utilidades.php";
include "../../../modelo/ModeloUsuario.php";

$modelo = new ModeloUsuario();
session_start();

// -------------------------------------------------------- INPUT
$in['id'] = Utilidades::clear_input_id($_POST['usuario_id']);
$in['info_status'] = Utilidades::clear_input($_POST['vigente']);
$in['fecha'] = date('Y-m-d H:i:s');
$in['usuario'] = $_SESSION['user_id'];

// -------------------------------------------------------- Data
$modelo->updateVigente($in);

// -------------------------------------------------------- TEST
// Utilidades::printr($in);
// Utilidades::printr($campos);
// Utilidades::printr($dato);

// -------------------------------------------------------- OUT
