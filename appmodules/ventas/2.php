<?php 
require_once '../autentificacion/modelo/logica.php';
ModeloAuten::user_log('Ventas', '../autentificacion/index.php');

include "../../lib/mysql/dbconnector.php";
include "../../lib/mysql/conexion01.php";
include "../../lib/mysql/utilidades.php";
include "../../lib/html/tabla.php";
include "./modelo/ModeloVenta.php";

$modelo = new ModeloVenta();


$in['lineas'] = $_SESSION['lineas'];
$in['campanias'] = $modelo->getCampaniaActivas($in);

Utilidades::printr($_SESSION);
Utilidades::printr($in);

require 'vista/listado2.tpl.php';