<?php 
require_once '../autentificacion/modelo/logica.php';
ModeloAuten::user_log('Entrega', '../autentificacion/index.php');

include "../../lib/mysql/dbconnector.php";
include "../../lib/mysql/conexion01.php";
include "../../lib/mysql/utilidades.php";
include "../../lib/html/tabla.php";
include "./modelo/ModeloEntrega.php";

$modelo = new ModeloEntrega();


$in['lineas'] = $_SESSION['lineas'];
$in['campanias'] = $modelo->getCampaniaActivasParaEntrega($in);

if (is_null($in['campanias']))
    header('Location: ../ventas/');

if (isset($_GET['campania']))
{
    $in['campania'] = $_GET['campania'];
} else
{
    $in['campania'] = $in['campanias'][0]['id'];
}

// Utilidades::printr($_SESSION);
// Utilidades::printr($in);

require 'vista/listado.tpl.php';