<?php 
require_once '../autentificacion/modelo/logica.php';
ModeloAuten::user_log('Comisiones', '../autentificacion/index.php');

include "../../lib/mysql/utilidades.php";
include "../../lib/mysql/dbconnector.php";
include "../../lib/mysql/conexion01.php";
include "./modelo/ModeloComision.php";

$modelo = new ModeloComision();

if (isset($_GET['campania_id']))
{
    $in['campania_id'] = Utilidades::clear_input($_GET['campania_id']);
    $in['anio-mes'] = Utilidades::clear_input($_GET['anio-mes']);    
    $in['campania_info'] = $modelo->campania_info($in['campania_id']);
    $in['lineas'] = trim($_SESSION['lineas']);
    

    if ($in['campania_info']['indice'] == 'campania_001'
        &&'Vodafone One' == trim($in['campania_info']['nombre']))
    {
        $pr = $modelo->campania_001_Vodafon_one($in);
        if (is_array($pr['datos']))
        {
            $ou = $modelo->campania_001_Vodafon_one_process($pr);
        }
        else
        {
            $ou = null;
        }        
    }
    
    
} else {
    $in['campania_id'] = '0';
    $in['anio-mes'] = date('Y-m');
}

// Utilidades::printr($_SESSION);
// Utilidades::printr($in);
// if (isset($pr)) Utilidades::printr($pr);
// if (isset($ou)) Utilidades::printr($ou);

require 'vista/listado.tpl.php';