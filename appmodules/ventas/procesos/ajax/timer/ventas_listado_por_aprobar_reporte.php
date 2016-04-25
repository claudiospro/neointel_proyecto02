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
    $campanias = $venta->getCampaniaNombreByLinealId($in);

    // ---------------------------------------------------------- OUT
    if (isset($campanias)) {
        foreach($campanias as $row) {
            $row = $venta->getTimerRepoirtePorAprobar($row['indice'], $in['lineas']);
            // print_r($row);
            $f = Utilidades::fechas_de_MysqlTimeStamp_a_array($row['date']);
            $m = Utilidades::fechas_de_militar_a_meridiano(array('hora' => $f['hora'], 'minuto' => $f['minuto'], 'return'=> 'string'));
            if (strpos($row['date'], date('Y-m-d')) !== false) {
                $row['date'] = $m;
            } else {
                $row['date'] = $f['anio'] . '-' . $f['mes'] . '-' . $f['dia'] . ' ' . $m;
            }
            echo '<a data-open="venta_listado_modal_por_aprobar"
                     title="Ver Detalle"
                   >' . $row['cnt'] . '</a>
                   (' . $row['date'] . ')
                 ';
        }
    }
}