<?php
include "../../../../../lib/mysql/dbconnector.php";
include "../../../../../lib/mysql/conexion01.php";
include "../../../../../lib/mysql/utilidades.php";
include "../../../modelo/ModeloVenta.php";
session_start();
    
if ('Asesor Comercial' != trim($_SESSION['perfiles'])) {
    $venta = new ModeloVenta();

    // -------------------------------------------------------- INPUT
    $in['lineas'] = Utilidades::clear_input($_SESSION['lineas']);

    // --------------------------------------------------------- DATA
    $campanias = $venta->getCampaniaIdByLinealId($in);

    // ---------------------------------------------------------- OUT
    if (isset($campanias)) {

        foreach($campanias as $row) {
            $row = $venta->getTimerRepoirteEstructura($row['campania_id'], $in['lineas']);
            // print_r($row);
            echo '<tr>';
            echo '<td>' . $row['campania'] . '</td>';
            echo '<td class="text-center">' . $row['dato01'] . '</td>';
            echo '<td class="text-center">' . $row['dato02'] . '</td>';
            echo '<td class="text-center">' . $row['dato03'] . '</td>';
            echo '</tr>';
        }

    }

}