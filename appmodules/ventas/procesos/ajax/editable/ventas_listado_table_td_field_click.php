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
elseif ($in['campo'] == 'fecha_entrega_observacion' && $in['campania'] == 'campania_003' ) 
    validar_fecha_entrega_observacion_campania_003($in);
elseif ($in['campo'] == 'fecha_entrega' && $in['campania'] == 'campania_003' ) 
    validar_fecha_entrega_campania_003($in);
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
function validar_fecha_entrega_observacion_campania_003($in) {
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
        imprimir_validar_fecha_entrega_observacion_campania_003($in);
     else
         echo '-1';    
}
function imprimir_validar_fecha_entrega_observacion_campania_003 ($in) {
    echo '<textarea class="no-margin no-padding" style="height: 50px; width: 220px; overflow-y: scroll; font-size: .8em;">' . utf8_encode($in['valor']) . '</textarea>';
    echo '<button class="button tiny no-margin">Guardar</button>';
    // Utilidades::printr($in);
}
//
function validar_fecha_entrega_campania_003($in) {
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
        imprimir_validar_fecha_entrega_campania_003($in);
     else
         echo '-1';    
}
function imprimir_validar_fecha_entrega_campania_003 ($in) {
    $in['valor'] = substr(utf8_encode($in['valor']), 0,-9);
    if ($in['valor'] == '0000-00-00') $in['valor'] = '';
    echo '<input type="text" readonly class="datapicker-editable  no-margin no-padding" style="width: 200px; font-size: 0.8em; height: 28px; line-height: 20px;" value="' . $in['valor'] . '">';
    echo '<button class="button tiny no-margin">Guardar</button>';
    echo '<script>
          $(".datapicker-editable").fdatepicker({
               format: "yyyy-mm-dd"
             , language: "es"
             , weekStart: 1
          });
          </script>';    
    // Utilidades::printr($in);
}

