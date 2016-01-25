<?php
include "../../../../../lib/mysql/dbconnector.php";
include "../../../../../lib/mysql/conexion01.php";
include "../../../../../lib/mysql/utilidades.php";
include "../../../../../lib/html/tabla.php";
include "../../../modelo/ModeloVenta.php";

$venta = new ModeloVenta();
// -------------------------------------------------------- INPUT
$in[] = array();

// -------------------------------------------------------- Data
$ou = $venta->getCampaniaActivas();
$combo = new OptionComboSimple0();
// $combo->set_option(0);
$combo->set_format(array('id', 'nombre'));
$combo->imprimir($ou);

// -------------------------------------------------------- TEST
// Utilidades::printr($in);
// Utilidades::printr($campos);
// Utilidades::printr($dato);

// -------------------------------------------------------- OUT
