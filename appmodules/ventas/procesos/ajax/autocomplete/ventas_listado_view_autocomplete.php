<?php
include "../../../../../lib/mysql/dbconnector.php";
include "../../../../../lib/mysql/conexion01.php";
include "../../../../../lib/mysql/utilidades.php";
include "../../../../../lib/html/tabla.php";
include "../../../modelo/ModeloVenta.php";

$venta = new ModeloVenta();

// -------------------------------------------------------- INPUT
$in['termino'] = Utilidades::clear_input(Utilidades::sanear_string($_REQUEST['term']));
$in['campo'] = Utilidades::clear_input_id($_REQUEST['campo']);

// --------------------------------------------------------- DATA
$ou = $venta->getAutoComplete($in);

// --------------------------------------------------------- TEST


$json = array();
if (is_array($ou)) {
    foreach ($ou as $row) {
        $tmp = array();
        $tmp['value'] = utf8_encode($row['termino']);
        $tmp['label'] = utf8_encode($row['termino']);
        $json[]=$tmp;        
    }
}
echo json_encode($json);