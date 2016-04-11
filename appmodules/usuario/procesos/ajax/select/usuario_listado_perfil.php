<?php
include "../../../../../lib/mysql/dbconnector.php";
include "../../../../../lib/mysql/conexion01.php";
include "../../../../../lib/mysql/utilidades.php";
include "../../../../../lib/html/tabla.php";
include "../../../modelo/ModeloUsuario.php";

session_start();
$modelo = new ModeloVenta();
// -------------------------------------------------------- INPUT
$in[] = '';

// -------------------------------------------------------- Data
$ou = $modelo->getPerfil($in);
$combo = new OptionComboSimple();
// $combo->set_option(0);
$combo->set_format(array('id', 'nombre'));
$combo->imprimir($ou);
// -------------------------------------------------------- TEST
// Utilidades::printr($in);
// Utilidades::printr($campos);
// Utilidades::printr($dato);

// -------------------------------------------------------- OUT
