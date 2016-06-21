<?php
include "../../../../../lib/mysql/dbconnector.php";
include "../../../../../lib/mysql/conexion01.php";
include "../../../../../lib/mysql/utilidades.php";
include "../../../modelo/ModeloEntrega.php";
session_start();
$modelo = new ModeloEntrega();


// -------------------------------------------------------- INPUT
$in['campo']       = Utilidades::clear_input($_POST['campo']);
$in['id']    = Utilidades::clear_input_id($_POST['id']);
$in['usuario']     = $_SESSION['user_id'];
$in['perfil']      = trim($_SESSION['perfiles']);
$in['campania']    = $modelo->getCampaniaEditable($in['id']) ;
$in['valor']       = $modelo->getValorEditable($in);


// --------------------------------------------------------- Data
if ($in['campo'] == 'recibio_dinero_cliente')
    recibio_dinero_cliente_validar($in);
elseif ($in['campo'] == 'recibio_dinero_mensajero') 
    recibio_dinero_mensajero_validar($in);
elseif ($in['campo'] == 'comprobante_tipo') 
    comprobante_tipo_validar($in);
elseif ($in['campo'] == 'comprobante_numero') 
    comprobante_numero_validar($in);
else Utilidades::printr($in);


// ---------------------------------------------------- Funciones
function recibio_dinero_cliente_validar($in) {
    if (
        $in['perfil'] == 'Admin' ||
        $in['perfil'] == 'Gerencia' ||
        $in['perfil'] == 'Tramitacion' ||
        $in['perfil'] == 'Tramitacion-Validacion' ||
        $in['perfil'] == 'Tramitacion-Carga' ||
        $in['perfil'] == 'Tramitacion-Validacion-Carga'
    ) {
        recibio_dinero_cliente_imprimir_1($in);
    } elseif ($in['perfil'] == 'Motorizado' && $in['valor'] == '0') {
        recibio_dinero_cliente_imprimir_2($in);
    } else echo '-1';
}
function recibio_dinero_cliente_imprimir_1($in) {
    global $modelo;
    $data = $modelo->setSQL(
        array('id' => '', 'nombre' => '')
        , '
SELECT * FROM (
(SELECT u.id, u.nombre FROM usu_usuario u 
JOIN usu_usuario_lineal ul ON ul.usuario_id = u.id
JOIN campania_lineal cl ON cl.lineal_id = ul.lineal_id
JOIN campania c ON c.id = cl.campania_id 
JOIN usu_usuario_perfil up ON up.usuario_id = u.id
WHERE c.indice ="campania_003"
  AND up.perfil_id IN (3, 4, 7, 8, 9, 12))
UNION  
(SELECT u.id, u.nombre FROM usu_usuario u 
JOIN usu_usuario_perfil up ON up.usuario_id = u.id
  AND up.perfil_id IN (2)
 )
) as unido
ORDER BY unido.nombre
        '
    );
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
    // Utilidades::printr($data);
}
function recibio_dinero_cliente_imprimir_2($in) {
    global $modelo;
    $data = $modelo->setSQL(
        array('id' => '', 'nombre' => '')
        , '
SELECT * FROM (
(SELECT u.id, u.nombre FROM usu_usuario u 
JOIN usu_usuario_lineal ul ON ul.usuario_id = u.id
JOIN campania_lineal cl ON cl.lineal_id = ul.lineal_id
JOIN campania c ON c.id = cl.campania_id 
JOIN usu_usuario_perfil up ON up.usuario_id = u.id
WHERE c.indice ="campania_003"
  AND up.perfil_id IN (3, 4, 7, 8, 9, 12))
UNION  
(SELECT u.id, u.nombre FROM usu_usuario u 
JOIN usu_usuario_perfil up ON up.usuario_id = u.id
  AND up.perfil_id IN (2)
 )
) as unido
ORDER BY unido.nombre
        '
    );
    echo '<select class="no-margin no-padding" style="font-size: .8em">';
    foreach($data as $row)
    {
        if ($row['id'] == $in['usuario'])
            echo '<option value="' . $row['id'] . '" selected>' . utf8_encode($row['nombre']) . '</option>';
    }
    echo '</select>';
    echo '<button class="button tiny no-margin">Asignarme</button>';
    // Utilidades::printr($in);    
}
//
function recibio_dinero_mensajero_validar($in) {
    global $modelo;
    if (
        $in['perfil'] == 'Admin' ||
        $in['perfil'] == 'Gerencia' ||
        $in['perfil'] == 'Tramitacion' ||
        $in['perfil'] == 'Tramitacion-Validacion' ||
        $in['perfil'] == 'Tramitacion-Carga' ||
        $in['perfil'] == 'Tramitacion-Validacion-Carga'
    ) {      
        recibio_dinero_mensajero_imprimir_1($in);
    } elseif ($in['perfil'] == 'Motorizado') {
        $in['recivido_por_cliente'] = $modelo->getValorEditable(array(
            'campo' => 'recibio_dinero_cliente',
            'campania' => $in['campania'],
            'id' => $in['id']
        ));
        if ($in['recivido_por_cliente'] != '0' && $in['recivido_por_cliente'] ==  $in['usuario']) {
            recibio_dinero_mensajero_imprimir_1($in);
        } else echo '-1';
        
    } else echo '-1';
}
function recibio_dinero_mensajero_imprimir_1($in) {
    global $modelo;
    $data = $modelo->setSQL(
        array('id' => '', 'nombre' => '')
        , '
SELECT * FROM (
(SELECT u.id, u.nombre FROM usu_usuario u 
JOIN usu_usuario_lineal ul ON ul.usuario_id = u.id
JOIN campania_lineal cl ON cl.lineal_id = ul.lineal_id
JOIN campania c ON c.id = cl.campania_id 
JOIN usu_usuario_perfil up ON up.usuario_id = u.id
WHERE c.indice ="campania_003"
  AND up.perfil_id IN (3, 4, 7, 8, 9, 12))
UNION  
(SELECT u.id, u.nombre FROM usu_usuario u 
JOIN usu_usuario_perfil up ON up.usuario_id = u.id
  AND up.perfil_id IN (2)
 )
) as unido
ORDER BY unido.nombre
        '
    );
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
function comprobante_tipo_validar($in) {
    global $modelo;
    if (
        $in['perfil'] == 'Admin' ||
        $in['perfil'] == 'Gerencia' ||
        $in['perfil'] == 'Tramitacion' ||
        $in['perfil'] == 'Tramitacion-Validacion' ||
        $in['perfil'] == 'Tramitacion-Carga' ||
        $in['perfil'] == 'Tramitacion-Validacion-Carga'
    ) {      
        comprobante_tipo_imprimir_1($in);
    } elseif ($in['perfil'] == 'Motorizado') {
        $in['recivido_por_cliente'] = $modelo->getValorEditable(array(
            'campo' => 'recibio_dinero_cliente',
            'campania' => $in['campania'],
            'id' => $in['id']
        ));
        if ($in['recivido_por_cliente'] != '0' && $in['recivido_por_cliente'] ==  $in['usuario']) {
            comprobante_tipo_imprimir_1($in);
        } else echo '-1';
        
    } else echo '-1';
}
function comprobante_tipo_imprimir_1($in) {
    global $modelo;
    $data = $modelo->setSQL(
        array('id' => '', 'nombre' => '')
        , '
        SELECT id, nombre FROM `venta_comprobante_tipo` WHERE info_status = 1
        '
    );
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
function comprobante_numero_validar($in) {
    global $modelo;
    if (
        $in['perfil'] == 'Admin' ||
        $in['perfil'] == 'Gerencia' ||
        $in['perfil'] == 'Tramitacion' ||
        $in['perfil'] == 'Tramitacion-Validacion' ||
        $in['perfil'] == 'Tramitacion-Carga' ||
        $in['perfil'] == 'Tramitacion-Validacion-Carga'
    ) {      
        comprobante_numero_imprimir_1($in);
    } elseif ($in['perfil'] == 'Motorizado') {
        $in['recivido_por_cliente'] = $modelo->getValorEditable(array(
            'campo' => 'recibio_dinero_cliente',
            'campania' => $in['campania'],
            'id' => $in['id']
        ));
        if ($in['recivido_por_cliente'] != '0' && $in['recivido_por_cliente'] ==  $in['usuario']) {
            comprobante_numero_imprimir_1($in);
        } else echo '-1';
        
    } else echo '-1';
}
function comprobante_numero_imprimir_1($in) {
    echo '<textarea class="no-margin no-padding" 
                    style="height: 100px; width: 220px; overflow-y: scroll; 
                           font-size: .8em;">' . utf8_encode($in['valor']) .
        '</textarea>';
    echo '<button class="button tiny no-margin">Guardar</button>';
    // Utilidades::printr($in);
}
//
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
