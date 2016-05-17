<?php
include "../../../../../lib/mysql/dbconnector.php";
include "../../../../../lib/mysql/conexion01.php";
include "../../../../../lib/mysql/utilidades.php";
include "../../../modelo/ModeloApunte.php";
session_start();
$prefix = 'apuntes_listado_';
$modelo = new ModeloApunte();

// -------------------------------------------------------- INPUT
$in['search_ini'] = Utilidades::clear_input($_POST['search_ini']);
$in['search_end'] = Utilidades::clear_input($_POST['search_end']);
$in['search_pendiente'] = (int) Utilidades::clear_input($_POST['search_pendiente']);

$in['pagina'] = Utilidades::clear_input($_POST['pagina']);
$in['items'] = $modelo->apuntes_get_pagina();
$in['user_id']  = Utilidades::clear_input($_SESSION['user_id']);


// --------------------------------------------------------- DATA
$ou = $modelo->apuntes_listado($in);


// --------------------------------------------------------- TEST
// Utilidades::printr($_POST);
if(is_array($ou))
    echo $in['pagina'];
else
    echo $in['pagina'] - 1;
