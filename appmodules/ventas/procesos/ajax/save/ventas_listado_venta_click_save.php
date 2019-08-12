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
$in['f'] = 'id, ';
if ($in['venta_id'] != '0') {
    $in['fields']['id'] = '';
    foreach ($campos as $r)
    {
        $in['fields'][$r['nombre']] = '';
      $in['f'] .= $r['nombre'] . ', ';
    }
  $in['f'] = substr(  $in['f'], 0, -2);

  $old = $venta->getUnDato($in);
}
$id = $venta->setVenta($in);



$sql_campos = 'id';  // insert
$sql_valores = $id;  // insert
$sql_set = '';       // update

// lo siguiente es si existe "estado_real" para cambiar
// print_r($campos);
// foreach ($campos as $row) {
//     if (isset($dato['estado_real']) && $row['nombre'] == 'estado_real') {
//         $dato['estado'] = $venta->getEstadoRealToEstado($dato['estado_real']);
//     }
//     if (isset($dato['cliente_tipo_inicial']) && $row['nombre'] == 'cliente_tipo_inicial' && $in['venta_id'] == '0') {
//         $dato['cliente_tipo'] = $dato['cliente_tipo_inicial'];
//     }
//     if (isset($dato['producto_inicial']) && $row['nombre'] == 'producto_inicial' && $in['venta_id'] == '0') {
//         $dato['producto'] = $dato['producto_inicial'];
//     }
// }

// construlle el sql
$json_log = array();

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
            if ($sql_set != '' & $tmp['sql'] != '') $sql_set .= ', ';
            $sql_set .= $tmp['sql'];
        }
        // esto es para recuperar el valor actual de FK en caso de que sea distinto
        if ($row['diccionario'] == '1') {
            $dato[$row['nombre']]['id2'] = $tmp['dato'];
        }
        // bamos a compara si los datos cambiado con lo anterior si a cambiado cuidado con FK
        $igualado = false;
        if ($row['diccionario'] == '1') {
            $igualado = ( utf8_encode($old[$row['nombre']]) == $dato[$row['nombre']]['id2'] );
        } elseif($row['tipo'] == 'TIMESTAMP') {
            $old[$row['nombre']] = substr($old[$row['nombre']], 0, 10);
            if ($old[$row['nombre']] == '0000-00-00') $old[$row['nombre']] = ''; 
            $igualado = ( $old[$row['nombre']] == $dato[$row['nombre']] );
        } elseif($row['tipo'] == 'TIMESTAMP-HM') {
            $old[$row['nombre']] = substr($old[$row['nombre']], 0, 16);
            if ($old[$row['nombre']] == '0000-00-00 00:00') $old[$row['nombre']] = ''; 
            $igualado = ( $old[$row['nombre']] == $dato[$row['nombre']] );            
        } else {
            $igualado = ( utf8_encode($old[$row['nombre']]) == $dato[$row['nombre']] );
        }
        if (!$igualado) { // aqui hacer los cambios
//            $json_log[] = $venta->drawLogItem(
//                'venta_' . $in['campania']
//                , $row['nombre']
//                , $old[$row['nombre']]
//                , $dato[$row['nombre']]
//            );
            // echo $row['nombre'].': '; print_r($igualado); echo ', ';
        }
    }
}
if ($in['venta_id'] == '0') {
    $sql = 'INSERT INTO venta_' . $in['campania'] . '(' . $sql_campos . ') VALUES(' . $sql_valores . ')';
} else {
    $sql = 'UPDATE venta_' . $in['campania'] . ' SET ' . $sql_set . ' WHERE id="' . $in['venta_id'] . '"';
}

$venta->setVentaCampania($sql);

// print_r($json_log);
$tmp = '';
foreach ($json_log as $row)
{
    if ($tmp !='') $tmp .= ', ';
    $tmp .= $row;
}

if ($tmp != '')
{
    $healthy = array("\n\r", "\r\n", "\n", "\r", "\t");
    $yummy   = array("<span style='color:red' > newline </span>"
                     , "<span style='color:red' > [newline] </span>"
                     , "<span style='color:red' > [newline] </span>"
                     , "<span style='color:red' > [newline] </span>"
                     , "<span style='color:red' > [tab] </span>");
    
    $tmp = str_replace($healthy, $yummy, $tmp);
    $venta->drawDivLogItem(
        $in['campania']
        , $in['venta_id']
        , $in['usuario']
        , $in['fecha']
        , utf8_encode($tmp)
    );
}

// -------------------------------------------------------- TEST
// print_r($dato);
// print_r($old);
/* echo '<hr>'; */
// print_r($campos);
/* print_r($datos); */
/* echo '<hr>'; */

// echo $id;