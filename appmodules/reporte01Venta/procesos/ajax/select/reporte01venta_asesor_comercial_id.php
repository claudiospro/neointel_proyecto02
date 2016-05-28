<?php
include "../../../../../lib/mysql/dbconnector.php";
include "../../../../../lib/mysql/conexion01.php";
include "../../../../../lib/mysql/utilidades.php";
include "../../../../../lib/html/tabla.php";
include "../../../modelo/ModeloReporte01.php";

session_start();
$venta = new ModeloVenta();
// -------------------------------------------------------- INPUT
$in['anio-mes-ini'] = Utilidades::clear_input($_POST['anio-mes-ini']);
$in['dia-ini'] = Utilidades::clear_input_id((int)$_POST['dia-ini']);
$in['anio-mes-end'] = Utilidades::clear_input($_POST['anio-mes-end']);
$in['dia-end'] = Utilidades::clear_input_id((int)$_POST['dia-end']);
$in['campania_id'] = Utilidades::clear_input($_POST['campania_id']);
$in['supervisor_id'] = Utilidades::clear_input_id((int)$_POST['supervisor_id']);
$in['asesor_comercial_id'] = Utilidades::clear_input_id((int)$_POST['asesor_comercial_id']);
$in['lineas'] = Utilidades::clear_input($_SESSION['lineas']);

// -------------------------------------------------------- Data
if ($in['supervisor_id'] != 0) {
    $ou = $venta->getAsesorComercialByFechas($in);
    if ($ou) {
        $combo = new OptionComboSimple();
        $combo->set_option($in['asesor_comercial_id']);
        $combo->set_format(array('asesor_venta_id', 'asesor_venta'));
        $combo->imprimir($ou);
    }
    // Utilidades::printr($ou);
}



// -------------------------------------------------------- TEST
// Utilidades::printr($in);



// -------------------------------------------------------- OUT
