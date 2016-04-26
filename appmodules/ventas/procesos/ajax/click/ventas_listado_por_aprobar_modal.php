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
        echo '<table>';
        echo '<thead>';
        echo '<tr>';
        echo '<th>Fecha de Creación</th><th width="350">Asesor de Venta</th><th>Acciones </th>';
        echo '</tr>';
        echo '</thead>';
        foreach($campanias as $row) {
            $in['campania'] = $row['indice'];
            $row =  $venta->getVentasPorAprobar($in);
            if (isset($row)) {
                foreach($row as $r) {
                    echo '<tr>';
                    echo '<td><center>' . Utilidades::fechas_de_MysqlTimeStamp_a_string_hm($r['fecha'])  . '</center></td>';
                    echo '<td>' . utf8_encode($r['asesor_venta']) . '</td>';
                    echo '<td><a class="aprobar button tiny view no-margin warning" 
                                 title="Aprobar"
                                 campania="' . $in['campania'] . '"
                                 venta_id="' . $r['id'] . '"
                              ><i class="fi-check medium"></i></a> 
                              <a class="edit button tiny view no-margin"
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

