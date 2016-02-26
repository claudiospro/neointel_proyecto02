<?php
include "../../../../../lib/mysql/dbconnector.php";
include "../../../../../lib/mysql/conexion01.php";
include "../../../../../lib/mysql/utilidades.php";
include "../../../../../lib/html/tabla.php";
include "../../../modelo/ModeloVenta.php";

session_start();
$venta = new ModeloVenta();
// -------------------------------------------------------- INPUT
$in['lineas'] = $_SESSION['lineas'];

// -------------------------------------------------------- Data
$ou = $venta->getCampaniaActivas($in);
$combo = new OptionComboSimple0();
// $combo->set_option(0);
$combo->set_format(array('id', 'nombre'));
$combo->imprimir($ou);

// -------------------------------------------------------- TEST
// Utilidades::printr($in);
// Utilidades::printr($campos);
// Utilidades::printr($dato);

// -------------------------------------------------------- OUT
