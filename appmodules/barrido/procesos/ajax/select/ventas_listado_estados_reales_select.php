<?php
include "../../../../../lib/mysql/dbconnector.php";
include "../../../../../lib/mysql/conexion01.php";
include "../../../../../lib/mysql/utilidades.php";
include "../../../../../lib/html/tabla.php";
include "../../../modelo/ModeloBarrido.php";

$modelo = new ModeloBarrido();
// -------------------------------------------------------- INPUT

// -------------------------------------------------------- Data
$ou = $modelo->getEstadosReales();
$combo = new OptionComboSimple0();
$combo->set_format(array('id', 'nombre'));
$combo->imprimir($ou);

// -------------------------------------------------------- TEST
// Utilidades::printr($in);
// Utilidades::printr($campos);
// Utilidades::printr($dato);

// -------------------------------------------------------- OUT
