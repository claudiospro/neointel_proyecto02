<?php
include "../../../../../lib/mysql/dbconnector.php";
include "../../../../../lib/mysql/conexion01.php";
include "../../../../../lib/mysql/utilidades.php";
include "../../../modelo/ModeloVenta.php";
session_start();
$perfil = trim($_SESSION['perfiles']);
if ($perfil != 'Asesor Comercial'
    && $perfil != 'Supervisor')
{
    $venta = new ModeloVenta();
    
    // -------------------------------------------------------- INPUT
    $in['lineas'] = Utilidades::clear_input($_SESSION['lineas']);
    // --------------------------------------------------------- DATA
    $campanias = $venta->getCampaniaNombreByLinealId($in);
    // print_r($campanias);
    // ---------------------------------------------------------- OUT
    $ou = array();
    if (isset($campanias)) {
        foreach($campanias as $row) {
            $row = $venta->getTimerRepoirteEstructura($row['indice'], $in['lineas']);
            foreach ($row as $k => $r) {
                if (! isset($ou[$k]))
                    $ou[$k] = $r;
                else
                    $ou[$k] += $r;
            }
            // print_r($row);
        }
        unset($ou['campania']);
        // print_r($ou);
        echo json_encode($ou);
    }
    
}