<?php
include "../../../../../lib/mysql/dbconnector.php";
include "../../../../../lib/mysql/conexion01.php";
include "../../../../../lib/mysql/utilidades.php";
include "../../../modelo/ModeloVenta.php";
session_start();
$venta = new ModeloVenta();
// -------------------------------------------------------- INPUT
$in['lineas'] = Utilidades::clear_input($_SESSION['lineas']);

// --------------------------------------------------------- DATA
$campanias = $venta->getCampaniaNombreByLinealId($in);
    if (isset($campanias)) {
        echo '<table width="100%">';
        echo '<thead>';
        echo '<tr>';
        echo '<th>Fecha de Creación</th><th>Asesor de Venta</th><th>Acciones </th>';
        echo '</tr>';
        echo '</thead>';
        foreach($campanias as $row) {
            $in['campania'] = $row['indice'];
            $row =  $venta->getVentasPorAprobar($in);
            if (isset($row)) {
                foreach($row as $r) {
                    echo '<tr>';
                    echo '<td>' . $r['fecha'] . '</td>';
                    echo '<td>' . utf8_encode($r['asesor_venta']) . '</td>';
                    echo '<td><a class="aprobar-link button tiny view no-margin warning" 
                                 title="Aprobar"
                                 venta_id="' . $r['id'] . '"
                              ><i class="fi-like medium"></i></a> 
                              <a class="button tiny view no-margin"
                                 venta_id="' . $r['id'] . '"
                                 campania="' . $in['campania'] . '"
                                 title="Editar"
                                 data-open="venta_listado_modal_div"                                  
                              ><i class="fi-pencil medium"></i></a>
                          </td>';
                    echo '</tr>';
                }
            }
        }
        echo '</table>';
    }

// ---------------------------------------------------------- OUT

