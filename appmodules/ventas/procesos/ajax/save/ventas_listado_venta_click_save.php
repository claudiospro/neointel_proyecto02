<?php
include "../../../../../lib/mysql/dbconnector.php";
include "../../../../../lib/mysql/conexion01.php";
include "../../../../../lib/mysql/utilidades.php";
include "../../../modelo/ModeloVenta.php";
session_start();
$venta = new ModeloVenta();
// -------------------------------------------------------- INPUT
$in['campania'] = Utilidades::clear_input(Utilidades::sanear_string($_POST['campania']));
$in['venta_id'] = Utilidades::clear_input_id($_POST['venta_id']);

$dato = $_POST;
// solucionando el auto-completado
/* foreach ($dato as $row) { */
        
/* }/\*end foreach*\/ */


$sql_campos = '';  // insert
$sql_valores = ''; // insert
$sql_set = '';     // update
// -------------------------------------------------------- Data
$campos = $venta->getcampos($in);
foreach ($campos as $row) {
    if ($in['venta_id'] == '0') {
        $tmp = $venta->sqlCampo($dato[$row['nombre']], $row, 'insert');
        if ($sql_campos != '') $sql_campos .= ', ';
        $sql_campos .= $tmp['campos'];
        if ($sql_valores != '') $sql_valores .= ', ';
        $sql_valores .= $tmp['valores'];
    } else {
        $tmp = $venta->sqlCampo($dato[$row['nombre']], $row, 'update');
        if ($sql_set != '') $sql_set .= ', ';
        $sql_set .= $tmp;
    }
}
if ($in['venta_id'] == '0') {
    $sql = 'INSERT INTO venta_' . $in['campania'] . '(' . $sql_campos . ') VALUES(' . $sql_valores . ')';
} else {
    $sql = 'UPDATE venta_' . $in['campania'] . ' SET ' . $sql_set . ' WHERE id="' . $in['venta_id'] . '"';
}
// -------------------------------------------------------- TEST
print_r($_POST);
echo '<hr>';
print_r($campos);
echo '<hr>';
print_r($sql);

