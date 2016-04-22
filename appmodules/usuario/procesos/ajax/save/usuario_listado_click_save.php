<?php
include "../../../../../lib/mysql/dbconnector.php";
include "../../../../../lib/mysql/conexion01.php";
include "../../../../../lib/mysql/utilidades.php";
include "../../../modelo/ModeloUsuario.php";
session_start();
$modelo = new ModeloUsuario();
// -------------------------------------------------------- INPUT
$in['fecha'] = date('Y-m-d H:i:s');
$in['usuario'] = $_SESSION['user_id'];

$in['form'] = $_POST;

if (isset($in['form']['vigente']) && $in['form']['vigente'] == 'on')
    $in['form']['vigente'] = '1';
else
    $in['form']['vigente'] = '0';

// -------------------------------------------------------- DATA
$id = $modelo->setUsuario($in);

// -------------------------------------------------------- TEST
// Utilidades::printr($in);

// ---------------------------------------------------------- OU
echo $id;