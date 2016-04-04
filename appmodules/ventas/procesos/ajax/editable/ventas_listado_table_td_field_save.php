<?php
include "../../../../../lib/mysql/dbconnector.php";
include "../../../../../lib/mysql/conexion01.php";
include "../../../../../lib/mysql/utilidades.php";
include "../../../modelo/ModeloVenta.php";
session_start();
$modelo = new ModeloVenta();


// -------------------------------------------------------- INPUT
$in['campo']       = Utilidades::clear_input($_POST['campo']);
$in['venta_id']    = Utilidades::clear_input_id($_POST['venta_id']);
$in['usuario']     = $_SESSION['user_id'];
$in['perfil']      = trim($_SESSION['perfiles']);
$in['campania']    = $modelo->getCampaniaEditable($in['venta_id']) ;
$in['valor']       = Utilidades::clear_input($_POST['valor']);


// --------------------------------------------------------- DATA
$modelo->setValorEditable($in);

Utilidades::printr($in);