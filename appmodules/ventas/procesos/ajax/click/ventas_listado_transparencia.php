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

// -------------------------------------------------------- DATA
$listado = $venta->getTransparenciaByVentaId($in);

// -------------------------------------------------------- TEST
// Utilidades::printr($in);
// Utilidades::printr($listado);

// ------------------------------------------------------- OUPUT
echo '<table style="width:100%">';
echo '<thead>';
echo '<tr>';
echo '<td width="100px">Fecha</td>';
echo '<td width="150px">Usuario</td>';
echo '<td width="200px">Campos</td>';
echo '<td>Detalles</td>';
echo '</tr>';
echo '</thead>';
echo '<tbody>';
if (is_array($listado))
    foreach($listado as $row)
    {
        $json = json_decode($row['json'], true);
        // Utilidades::printr($json);
        echo '<tr>';
        echo '<td>' . $json['fecha'] . '</td>';
        echo '<td>' . $json['usuario'] . '</td>';
        echo '<td>';
        $first = true;
        foreach ($json['campos'] as $campo) {
            if (!$first) echo ', ';
            else $first = false;
            echo $campo['nombre'];
        }
        echo '</td>';    
    
        echo '<td><a class="item" href="#">Ver</a>';
        echo '<table style="margin:0; display:none">';    
        foreach ($json['campos'] as $campo)
        {
            echo '<tr>';
            echo '<td>' . $campo['nombre'] . ':</td>';
            echo '<td><div style="background-color:#fb8b8b">' . $campo['old'] . '</div>';
            echo '<div style="background-color: #c7f8c6">' . $campo['new'] . '</div></td>';
            echo '</tr>';
        }
        echo '</table>';
        echo '</td>';
    }
echo '</tbody>';
echo '</table>';
