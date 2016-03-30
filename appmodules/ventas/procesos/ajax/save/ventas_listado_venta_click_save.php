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
$in['fecha'] = date('Y-m-d H:i:s');
$in['usuario'] = $_SESSION['user_id'];

$dato = $_POST;

// -------------------------------------------------------- Data
$campos = $venta->getcampos($in);
$id = $venta->setVenta($in);

$sql_campos = 'id';  // insert
$sql_valores = $id;  // insert
$sql_set = '';       // update

// lo siguiente es si existe "estado_real" para cambiar
foreach ($campos as $row) {
    if ($row['nombre'] == 'estado_real') {
        $dato['estado'] = $venta->getEstadoRealToEstado($dato['estado_real']);
    }
}

// construlle el sql
foreach ($campos as $row) {
    if ($row['diccionario'] == '1') {
        $dato[$row['nombre']] = array (
            'id'    => $dato[$row['nombre']],
            'value' => $dato[$row['nombre'].'_value'],
            'dependencia' => $row['dependencia'],
        );
        if ($row['dependencia'] != '') {
            $dato[$row['nombre']]['dependencia_value'] = $dato[$row['dependencia']];
        }
    }

    if (isset($dato[$row['nombre']])) {
        if ($in['venta_id'] == '0') {            
            $tmp = $venta->sqlCampo($dato[$row['nombre']], $row, 'insert');
            if ($tmp['campos']!='') $sql_campos .= ', ';
            $sql_campos .= $tmp['campos'];
            if ($tmp['valores'] !='') $sql_valores .= ', ';
            $sql_valores .= $tmp['valores'];
        } else {
            $tmp = $venta->sqlCampo($dato[$row['nombre']], $row, 'update');
            if ($sql_set != '' & $tmp != '') $sql_set .= ', ';
            $sql_set .= $tmp;
        }        
    }

}
if ($in['venta_id'] == '0') {
    $sql = 'INSERT INTO venta_' . $in['campania'] . '(' . $sql_campos . ') VALUES(' . $sql_valores . ')';
} else {
    $sql = 'UPDATE venta_' . $in['campania'] . ' SET ' . $sql_set . ' WHERE id="' . $in['venta_id'] . '"';
}

$venta->setVentaCampania($sql);
// -------------------------------------------------------- TEST
/* print_r($_POST); */
/* echo '<hr>'; */
/* print_r($campos); */
/* echo '<hr>'; */
// print($sql);

echo $id;