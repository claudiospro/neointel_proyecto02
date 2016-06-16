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
$in['valor']       = $modelo->getValorEditable($in);


// --------------------------------------------------------- Data
if ($in['campo'] == 'estado_real')
    validar_estado_real($in);
elseif ($in['campo'] == 'estado_observacion') 
    validar_estado_observacion($in);
else Utilidades::printr($in);


// ---------------------------------------------------- Funciones
function validar_estado_real($in) {
    $mostrar = false;
    if (
        $in['perfil'] == 'Admin' ||
        $in['perfil'] == 'Gerencia' ||
        $in['perfil'] == 'Tramitacion' ||
        $in['perfil'] == 'Tramitacion-Validacion' ||
        $in['perfil'] == 'Tramitacion-Carga' ||
        $in['perfil'] == 'Tramitacion-Validacion-Carga'
    )
        $mostrar = true;
    
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
    if (
        $in['perfil'] == 'Admin' ||
        $in['perfil'] == 'Gerencia' ||
        $in['perfil'] == 'Tramitacion' ||
        $in['perfil'] == 'Tramitacion-Validacion' ||
        $in['perfil'] == 'Tramitacion-Carga' ||
        $in['perfil'] == 'Tramitacion-Validacion-Carga'
    )
        $mostrar = true;
    if ($mostrar)
        imprimir_estado_observacion($in);
     else
         echo '-1';
}
function imprimir_estado_observacion($in) {
    echo '<textarea class="no-margin no-padding" style="height: 100px; width: 220px; overflow-y: scroll; font-size: .8em;">' . utf8_encode($in['valor']) . '</textarea>';
    echo '<button class="button tiny no-margin">Guardar</button>';
    // Utilidades::printr($in);    
}
//

