<?php
include "../../../../../lib/mysql/dbconnector.php";
include "../../../../../lib/mysql/conexion01.php";
include "../../../../../lib/mysql/utilidades.php";
include "../../../../../lib/html/html.php";
include "../../../modelo/ModeloVenta.php";

$venta = new ModeloSave();
// -------------------------------------------------------- INPUT
$in['campania'] = Utilidades::clear_input(Utilidades::sanear_string($_POST['campania']));
$in['venta_id'] = Utilidades::clear_input_id($_POST['venta_id']);
// -------------------------------------------------------- Data
$pr = $venta->campos($in);

// -------------------------------------------------------- TEST
Html::printr($in);
Html::printr($pr);

// -------------------------------------------------------- OUT
