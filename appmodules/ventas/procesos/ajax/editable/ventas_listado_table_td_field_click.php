<?php
include "../../../../../lib/mysql/dbconnector.php";
include "../../../../../lib/mysql/conexion01.php";
include "../../../../../lib/mysql/utilidades.php";
include "../../../modelo/ModeloVenta.php";
session_start();
$modelo = new ModeloVenta();


// -------------------------------------------------------- INPUT
$in['campo']       = Utilidades::clear_input($_POST['campo']);
$in['venta_id']    = Utilidades::clear_input_id($_POST['venta_id']);
$in['usuario']     = $_SESSION['user_id'];
$in['perfil']      = trim($_SESSION['perfiles']);
$in['campania']    = $modelo->getCampaniaEditable($in['venta_id']) ;
$in['estado_real'] = $modelo->getEstadoTramitacionIdEditable($in);
$in['valor']       = $modelo->getValorEditable($in);


// --------------------------------------------------------- Data
if ($in['campo'] == 'estado_real')
    validar_estado_real($in);
elseif ($in['campo'] == 'estado_observacion') 
    validar_estado_observacion($in);
elseif ($in['campo'] == 'estado_tramitacion') 
    validar_estado_tramitacion($in);
else Utilidades::printr($in);


// ---------------------------------------------------- Funciones
function validar_estado_real($in) {
    $mostrar = false;
    if ($in['perfil'] == 'Admin' || $in['perfil'] == 'Tramitacion' )
        $mostrar = true;
    else
    {
        if ($in['perfil'] == 'Tramitacion-Validacion-Carga' && $in['estado_real'] != 3)
            $mostrar = true;
        if ($in['perfil'] == 'Tramitacion-Carga' && $in['estado_real'] != 1 && $in['estado_real'] != 3)
            $mostrar = true;
        if ($in['perfil'] == 'Tramitacion-Validacion' && $in['estado_real'] != 2 && $in['estado_real'] != 3 )
            $mostrar = true;
    }
    if ($mostrar) 
        imprimir_estado_real($in);
    else
        echo '-1';
}
function imprimir_estado_real($in) {
    global $modelo;
    $data = $modelo->getEstadoRealActivas($in);
    echo '<select class="no-margin no-padding" style="font-size: .8em">';
    foreach($data as $row)
    {
        if ($row['id'] == $in['valor']) 
            $selected = ' selected ';
        else
            $selected = '';        
        echo '<option value="' . $row['id'] . '" ' . $selected . '>' . utf8_encode($row['nombre']) . '</option>'; 
    }
    echo '</select>';
    echo '<button class="button tiny no-margin">Guardar</button>';
    // Utilidades::printr($in);    
}
//
function validar_estado_observacion($in) {
    $mostrar = false;
    if ($in['perfil'] == 'Admin' || $in['perfil'] == 'Tramitacion' )
        $mostrar = true;
    if ($mostrar)
        imprimir_estado_observacion($in);
     else
         echo '-1';
}
function imprimir_estado_observacion($in) {
    echo '<textarea class="no-margin no-padding" style="height: 100px; width: 280px; overflow-y: scroll; font-size: .8em;">' . utf8_encode($in['valor']) . '</textarea>';
    echo '<button class="button tiny no-margin">Guardar</button>';
    // Utilidades::printr($in);    
}
//
function validar_estado_tramitacion($in) {
    $mostrar = false;
    if ($in['perfil'] == 'Admin' || $in['perfil'] == 'Tramitacion' )
    {
        $mostrar = true;
        $in['tramitacion-denegado'] = '0';
    }
    else
    {
        if ($in['perfil'] == 'Tramitacion-Validacion-Carga' && $in['estado_real'] != 3)
        {
            $mostrar = true;
            $in['tramitacion-denegado'] = '0';
        }        
        if ($in['perfil'] == 'Tramitacion-Carga' && $in['estado_real'] != 1 && $in['estado_real'] != 3)
        {
            $mostrar = true;
            $in['tramitacion-denegado'] = '1';
        }
        if ($in['perfil'] == 'Tramitacion-Validacion' && $in['estado_real'] != 2 && $in['estado_real'] != 3 )
        {
            $mostrar = true;
            $in['tramitacion-denegado'] = '3';
        }
    }
    if ($mostrar) 
        imprimir_estado_tramitacion($in);
    else
        echo '-1';
}
function imprimir_estado_tramitacion($in) {
    global $modelo;
    $data = $modelo->getEstadoTramitacionPerfilActivas($in);
    echo '<select class="no-margin no-padding" style="font-size: .8em">';
    foreach($data as $row)
    {
        if ($row['id'] == $in['valor']) 
            $selected = ' selected ';
        else
            $selected = '';        
        echo '<option value="' . $row['id'] . '" ' . $selected . '>' . utf8_encode($row['nombre']) . '</option>'; 
    }
    echo '</select>';
    echo '<button class="button tiny no-margin">Guardar</button>';    
    
    // Utilidades::printr($in);    
}
