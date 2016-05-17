<?php
include "../../../../../lib/mysql/dbconnector.php";
include "../../../../../lib/mysql/conexion01.php";
include "../../../../../lib/mysql/utilidades.php";
include "../../../modelo/ModeloApunte.php";
session_start();
$prefix = 'apuntes_listado_';
$modelo = new ModeloApunte();
// -------------------------------------------------------- INPUT
$in['id'] = Utilidades::clear_input_id($_POST['id']);
$in['texto'] = Utilidades::clear_input($_POST['texto']);
$in['pendiente'] = Utilidades::clear_input($_POST['pendiente']);
$in['telefono'] = Utilidades::clear_input($_POST['telefono']);

$in['user_id'] = Utilidades::clear_input_id($_SESSION['user_id']);
$in['fecha'] = date('Y-m-d H:i:s');

// --------------------------------------------------------- DATA
$modelo->apuntes_save($in);

// --------------------------------------------------------- TEST
// Utilidades::printr($in);
// echo html_entity_decode($in['texto']);


// ---------------------------------------------------------- OUT


