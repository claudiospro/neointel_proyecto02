<?php
include "../../../../../lib/mysql/dbconnector.php";
include "../../../../../lib/mysql/utilidades.php";

$cnn= new DBConnector_Alternative();

$conn = mysqli_connect($cnn->servername, $cnn->username, $cnn->password, $cnn->dbname) or die("Connection failed: " . mysqli_connect_error());


session_start();
$perfiles = trim($_SESSION['perfiles']);
$sql_usuario = '';
if ($_SESSION['lineas'] != '' && $perfiles!='Asesor Comercial') {
    $sql_usuario.= 'AND v.lineal_id IN (' . $_SESSION['lineas'] . ')';
}
if ($perfiles=='Asesor Comercial') {
    $sql_usuario.= ' AND v.asesor_venta_id="' . $_SESSION['user_id'] . '"';
}
$sql_activo = '';
if ($perfiles != 'Admin' && $perfiles != 'Gerencia' && $perfiles != 'Coordinador') {
    $sql_activo.= ' AND v.info_status=1';
}

$campania = 'campania_003';
$sql_ini='';
$sql_ini.= "
    SELECT
      d2.nombre producto
    , d9.nombre cliente_tipo
    , d.cliente_nombre
    , d.fecha_entrega
    , d.producto_cantidad
    , d.precio
    , d.precio_final
    , d11.nombre tipo_pago_nombre
    , 'recivio_dinero'
    , 'comprobante'
    , '__proceso__'
    , d3.nombre estado
    , d8.nombre estado_real
    , d.estado_observacion
    , 'acciones'
    , v.info_create_fecha fecha_creacion
    , v.info_update_fecha fecha_actualizacion
    , d4.nombre asesor_venta
    , d6.nombre supervisor
    , d7.nombre coordinador
    , v.info_status
    --
    , v.id venta_id
    , v.campania
    , d.estado estado_id
    , d.estado_real estado_real_id
    , d.aprobado_supervisor
    , d.tramitacion_venta_validar
    , d.tramitacion_venta_cargar
    , d.tramitacion_postventa_validar
    , d.tramitacion_postventa_citar
    , d.tramitacion_postventa_intalar
    , d.fecha_entrega_observacion
    , d10.nombre fecha_entrega_horario_nombre
    , d.fecha_entrega_horario
    , CONCAT(
        d.aprobado_supervisor
      , d.tramitacion_venta_validar
      , d.tramitacion_venta_cargar
      , d.tramitacion_postventa_validar
      , d.tramitacion_postventa_citar
      , d.tramitacion_postventa_intalar  
      ) AS proceso_clds
    , d12.nombre recibio_dinero_cliente_nombre
    ,         d.recibio_dinero_cliente
    , d13.nombre recibio_dinero_mensajero_nombre
    ,          d.recibio_dinero_mensajero
    , d14.nombre comprobante_tipo
    ,          d.comprobante_numero    
    , d15.nombre dinero_empresa
    FROM venta v 
    JOIN venta_" . $campania . " d ON d.id=v.id
    -- definiciones
    LEFT JOIN venta_producto d2 ON d2.id=d.producto
    LEFT JOIN venta_estado d3 ON d3.id=d.estado
    LEFT JOIN usu_usuario d4 ON d4.id=v.asesor_venta_id
    LEFT JOIN usu_usuario d6 ON d6.id=v.supervisor_id
    LEFT JOIN usu_usuario d7 ON d7.id=v.coordinador_id
    LEFT JOIN venta_estado_real d8 ON d8.id=d.estado_real
    LEFT JOIN venta_cliente_tipo d9 ON d9.id=d.cliente_tipo
    LEFT JOIN venta_entrega_horario d10 ON d10.id = d.fecha_entrega_horario
    LEFT JOIN venta_tipo_pago d11 ON d11.id = d.tipo_pago
    LEFT JOIN usu_usuario d12 ON d12.id= d.recibio_dinero_cliente
    LEFT JOIN usu_usuario d13 ON d13.id= d.recibio_dinero_mensajero
    LEFT JOIN venta_comprobante_tipo d14 ON d14.id = d.comprobante_tipo
    LEFT JOIN venta_dinero_empresa d15 ON d15.id = d.dinero_empresa
    WHERE v.campania = '" . $campania . "'" . $sql_activo . " " . $sql_usuario . ""
        ;


$sql_ini = "
SELECT unido.*, @rownum:=@rownum+1 row_num  FROM (
" . $sql_ini . "
) unido, (SELECT @rownum:=0) R
WHERE 1=1
";


// storing  request (ie, get/post) global array to a variable  
$requestData= $_REQUEST;


// getting total number records without any search
$sql = $sql_ini;
// echo $sql;
$query=mysqli_query($conn, $sql) or die("01");

$col = -1;

$totalData = mysqli_num_rows($query);
$totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.

$sql = $sql_ini;

$sql_filter = '';
if( !empty($requestData['columns'][++$col]['search']['value']) ) {
    $sql_filter.=' AND producto LIKE "%' . Utilidades::sanear_complete_string($requestData['columns'][$col]['search']['value']) . '%"';
}
if( !empty($requestData['columns'][++$col]['search']['value']) ) {
    $sql_filter.=' AND cliente_tipo LIKE "%' . Utilidades::sanear_complete_string($requestData['columns'][$col]['search']['value']) . '%"';
}
if( !empty($requestData['columns'][++$col]['search']['value']) ) {
    $sql_filter.=' AND cliente_nombre LIKE "%' . Utilidades::sanear_complete_string($requestData['columns'][$col]['search']['value']) . '%"';
}
if( !empty($requestData['columns'][++$col]['search']['value']) ) {
    $tmp = Utilidades::sanear_complete_string($requestData['columns'][$col]['search']['value']);
    $sql_filter.=' AND fecha_entrega LIKE "%' . $tmp . '%"';
}

if( !empty($requestData['columns'][++$col]['search']['value']) ) {
    $sql_filter.=' AND producto_cantidad LIKE "%' . Utilidades::sanear_complete_string($requestData['columns'][$col]['search']['value']) . '%"';
}
if( !empty($requestData['columns'][++$col]['search']['value']) ) {
    $sql_filter.=' AND precio LIKE "%' . Utilidades::sanear_complete_string($requestData['columns'][$col]['search']['value']) . '%"';
}
if( !empty($requestData['columns'][++$col]['search']['value']) ) {
    $sql_filter.=' AND precio_final LIKE "%' . Utilidades::sanear_complete_string($requestData['columns'][$col]['search']['value']) . '%"';
}
if( !empty($requestData['columns'][++$col]['search']['value']) ) {
    $sql_filter.=' AND tipo_pago_nombre LIKE "%' . Utilidades::sanear_complete_string($requestData['columns'][$col]['search']['value']) . '%"';
}
++$col;// ddd1
++$col;// ddd2
if( !empty($requestData['columns'][++$col]['search']['value']) ) {
    $valor = $requestData['columns'][$col]['search']['value'];   
    if ($valor == 'b1') $sql_filter.=' AND proceso_clds = "111222"';
    if ($valor == 'b2') $sql_filter.=' AND proceso_clds = "111322"';
    if ($valor == 'b3') $sql_filter.=' AND proceso_clds = "111122"';
    if ($valor == 'b4') $sql_filter.=' AND proceso_clds = "111132"';
    if ($valor == 'b5') $sql_filter.=' AND proceso_clds = "111112"';
    if ($valor == 'b6') $sql_filter.=' AND proceso_clds = "111113"';
    if ($valor == 'b7') $sql_filter.=' AND proceso_clds = "111111"';
    if ($valor == 'b0') $sql_filter.=' AND proceso_clds IN(111222, 111322, 111122, 111132, 111112, 111113, 111111)';    
}
if( !empty($requestData['columns'][++$col]['search']['value']) ) {
    $sql_filter.=' AND estado_id = "' . Utilidades::sanear_complete_string($requestData['columns'][$col]['search']['value']) . '"';
}
if( !empty($requestData['columns'][++$col]['search']['value']) ) {
    $sql_filter.=' AND estado_real_id = "' . Utilidades::sanear_complete_string($requestData['columns'][$col]['search']['value']) . '"';
}
++$col; //  observacion
++$col; // (acciones)
if( !empty($requestData['columns'][++$col]['search']['value']) ) {
    $sql_filter.=' AND fecha_creacion LIKE "%' . Utilidades::sanear_complete_string($requestData['columns'][$col]['search']['value']) . '%"';
}
if( !empty($requestData['columns'][++$col]['search']['value']) ) {
    $sql_filter.=' AND fecha_actualizacion LIKE "%' . Utilidades::sanear_complete_string($requestData['columns'][$col]['search']['value']) . '%"';
}
if( !empty($requestData['columns'][++$col]['search']['value']) ) {
    $sql_filter.=' AND asesor_venta LIKE "%' . Utilidades::sanear_complete_string($requestData['columns'][$col]['search']['value']) . '%"';
}
if( !empty($requestData['columns'][++$col]['search']['value']) ) {
    $sql_filter.=' AND supervisor LIKE "%' . Utilidades::sanear_complete_string($requestData['columns'][$col]['search']['value']) . '%"';
}
if( !empty($requestData['columns'][++$col]['search']['value']) ) {
    $sql_filter.=' AND coordinador LIKE "%' . Utilidades::sanear_complete_string($requestData['columns'][$col]['search']['value']) . '%"';
}
$bool_str = array('0'=>'Si', '1'=>'No');
if( !empty($requestData['columns'][++$col]['search']['value']) ) {
    $bool = $requestData['columns'][$col]['search']['value'];
    if ($bool=='si' || $bool=='s') {
        $sql_filter.=' AND info_status  = "0"';
    } elseif($bool=='no' || $bool=='n') {
        $sql_filter.=' AND info_status  = "1"';
    }
}


$sql.= $sql_filter;

$sql_donde = '';
$pagina ='';
if ( !empty($requestData['search']['value']) && trim($requestData['search']['value']) != '' ) {
    // esto es para recuperar la pagina (es muy importante)
    $sql_donde.= 'SELECT * FROM (' . $sql;
    $sql_donde.= ' ORDER BY '. (intval($requestData['order'][0]['column'])+1) . ' ' . $requestData['order'][0]['dir'];
    $sql_donde.= ') unido2 WHERE venta_id=' . intval($requestData['search']['value']) ;
    $query=mysqli_query($conn, $sql_donde) or die("01.5");
    $cnt = mysqli_num_rows($query);
    if ($cnt > 0) {
        while( $row=mysqli_fetch_array($query) ) $pagina = $row['row_num'];
        $pagina -= 1;
        if ($pagina > 0) {
            $pagina-= ($pagina % $requestData['length']);
            if ($pagina > 0) {
                $pagina /= $requestData['length'];
            }
        }
        $pagina *= $requestData['length'];
    }
}
if ($pagina != '')
    $requestData['start'] = $pagina;

$query=mysqli_query($conn, $sql) or die("02");
$totalFiltered = mysqli_num_rows($query); // when there is a search parameter then we have to modify total number filtered rows as per search result.

$sql.=" ORDER BY ". (intval($requestData['order'][0]['column'])+1)." ".$requestData['order'][0]['dir']." LIMIT ".$requestData['start']." ,".$requestData['length']." ";// print $sql;
/* $requestData['order'][0]['column'] contains colmun index, $requestData['order'][0]['dir'] contains order such as asc/desc  */


$query=mysqli_query($conn, $sql) or die("03");

// esto es para decir cuando no se puede $editar

$data = array();
while( $row=mysqli_fetch_array($query) ) {
    $nestedData = array();

    $nestedData[] = utf8_encode($row['producto']);
    $nestedData[] = utf8_encode($row['cliente_tipo']);
    $nestedData[] = utf8_encode($row['cliente_nombre']);
    $tmp = Utilidades::fechas_de_MysqlTimeStamp_a_string($row['fecha_entrega']);
    if ($tmp == '0000-00-00') $tmp ='';
    $nestedData[] = utf8_encode('<u>Obs</u>:
                                 <div class="editable-inline line2" class="">
                                   <a></a>
                                   <span venta_id="' . $row['venta_id'] . '" campo="fecha_entrega_observacion">
                                   ' . $row['fecha_entrega_observacion'] . '
                                   </span>
                                   <div style="display:none"></div>
                                 </div>
                                 <u>Fecha</u>:
                                 <div class="editable-inline line2" class="">
                                   <a></a>
                                   <span venta_id="' . $row['venta_id'] . '" campo="fecha_entrega">
                                   ' . $tmp . '
                                   </span>
                                   <div style="display:none"></div>
                                 </div>
                                 '
    );
    $nestedData[] = utf8_encode('<center>'.$row['producto_cantidad'].'</center>');
    $nestedData[] = utf8_encode($row['precio']);
    $nestedData[] = utf8_encode($row['precio_final']);
    $nestedData[] = utf8_encode($row['tipo_pago_nombre']);
    $nestedData[] = '
    <b>del Cliente</b>:
    <div class="editable-inline line2" class="">
      <a></a>
      <span venta_id="' . $row['venta_id'] . '" campo="recibio_dinero_cliente">
      ' . utf8_encode($row['recibio_dinero_cliente_nombre']) . '
      </span>
      <div style="display:none"></div>
    </div>
    <b>del Mensajero</b>:
    <div class="editable-inline line2" class="">
      <a></a>
      <span venta_id="' . $row['venta_id'] . '" campo="recibio_dinero_mensajero">
      ' . utf8_encode($row['recibio_dinero_mensajero_nombre']) . '
      </span>
      <div style="display:none"></div>
    </div>
    <b>Empresa</b>:
    <div class="editable-inline line2" class="">
      <a></a>
      <span venta_id="' . $row['venta_id'] . '" campo="dinero_empresa">
      ' . utf8_encode($row['dinero_empresa']) . '
      </span>
      <div style="display:none"></div>
    </div>
    ';
    $nestedData[] = '
    <b>Tipo</b>:
    <div class="editable-inline line2" class="">
      <a></a>
      <span venta_id="' . $row['venta_id'] . '" campo="comprobante_tipo">
      ' . utf8_encode($row['comprobante_tipo']) . '
      </span>
      <div style="display:none"></div>      
    </div>
    <b>Nmro</b>:
    <div class="editable-inline line2" class="">
      <a></a>
      <span venta_id="' . $row['venta_id'] . '" campo="comprobante_numero">
      ' . utf8_encode($row['comprobante_numero']) . '
      </span>
      <div style="display:none"></div>
    </div>
    ';
    $nestedData[] = mostrar_proceso($row);
    $nestedData[] = '<span class="item-estado item-estado-' . $row['estado_id'] . '">'. utf8_encode($row['estado']) .'</span>';
    $nestedData[] = '<div class="editable-inline" class="">
                       <a></a>
                       <span venta_id="' . $row['venta_id'] . '" campo="estado_real" class="item-estado-real item-estado-real-' . $row['estado_real_id'] . '">' . utf8_encode($row['estado_real']) . '</span>
                       <div style="display:none"></div>
                     </div>
                    ';
    $nestedData[] = '<div class="editable-inline" class="">
                       <a></a>
                       <span venta_id="' . $row['venta_id'] . '" campo="estado_observacion">' . utf8_encode($row['estado_observacion']) . '</span>
                       <div style="display:none"></div>
                     </div>
                    ';
    
    $acciones = '';
    if (validar_permisos('edit' , $row)) $acciones.= '<a class="button tiny edit no-margin" venta_id="' . $row['venta_id'] . '" campania="' . $row['campania'] . '" data-open="venta_listado_modal_div" title="Editar" ><i class="fi-pencil medium"></i></a>';
    $acciones.= '<a class="button tiny view no-margin secondary" venta_id="' . $row['venta_id'] . '" campania="' . $row['campania'] . '" data-open="venta_listado_modal_div" title="Ver" ><i class="fi-info medium"></i></a>';
    if (validar_permisos('tran', $row)) $acciones.= '<a class="button tiny transparencia no-margin warning " venta_id="' . $row['venta_id'] . '" campania="' . $row['campania'] . '" data-open="venta_listado_modal_div3" title="Trasparencia" ><i class="fi-magnifying-glass medium"></i></a>';
    if (validar_permisos('dele', $row)) $acciones.= '<a class="button tiny delete no-margin alert" venta_id="' . $row['venta_id'] . '" campania="' . $row['campania'] . '" title="Eliminar" ><i class="fi-x medium"></i></a>';
    $nestedData[] = '<center class="item-datatable item-datatable-' . $row['venta_id'] . '">' . $acciones . '</center>';
    $nestedData[] = '
    <div class="editable-inline line2" class="">
      <a></a>
      <span venta_id="' . $row['venta_id'] . '" campo="info_create_fecha">
      ' . Utilidades::fechas_de_MysqlTimeStamp_a_string_hm($row['fecha_creacion']) . '
      </span>
      <div style="display:none"></div>      
    </div>
    ';    
    $nestedData[] = Utilidades::fechas_de_MysqlTimeStamp_a_string_hm($row['fecha_actualizacion']);
    $nestedData[] = '
    <div class="editable-inline line2" class="">
      <a></a>
      <span venta_id="' . $row['venta_id'] . '" campo="asesor_venta_id">
      ' . utf8_encode($row['asesor_venta']) . '
      </span>
      <div style="display:none"></div>      
    </div>
    ';
    $nestedData[] = '
    <div class="editable-inline line2" class="">
      <a></a>
      <span venta_id="' . $row['venta_id'] . '" campo="supervisor_id">
      ' . utf8_encode($row['supervisor']) . '
      </span>
      <div style="display:none"></div>      
    </div>
    ';
    $nestedData[] = utf8_encode($row['coordinador']);
    $nestedData[] = '<center>' . $bool_str[$row['info_status']] . '</center>';
    
    $data[] = $nestedData;
}

function validar_permisos($accion, $row) {
    $ou = true;
    $perfil = trim($_SESSION['perfiles']);
    if ($accion == 'edit' || $accion == 'dele')
    {
        if ($perfil == 'Asesor Comercial') $ou = false;
        if ($perfil == 'Supervisor' && $row['aprobado_supervisor'] == '1') $ou = false;
        if ($perfil == 'Gerencia') $ou = true;
    }
    if ($accion == 'tran')
    {
        if ( $perfil != 'Admin' ) $ou = false;

    }
    return $ou;
}
function mostrar_proceso($row) {
    $ou = '';
    $proceso = '';
    $proceso .= $row['aprobado_supervisor'];
    $proceso .= $row['tramitacion_venta_validar'];
    $proceso .= $row['tramitacion_venta_cargar'];
    $proceso .= $row['tramitacion_postventa_validar'];
    $proceso .= $row['tramitacion_postventa_citar'];
    $proceso .= $row['tramitacion_postventa_intalar'];

    if ($proceso == '111222') $ou = '<span style="color:black"> <br>Validación:Pendiente</span>';
    if ($proceso == '111322') $ou = '<span style="color:red">   <br>Validación:Caida</span>';
    if ($proceso == '111122') $ou = '<span style="color:black"> <br>Cita:Pendiente</span>';
    if ($proceso == '111132') $ou = '<span style="color:red">   <br>Cita:Caida</span>';
    if ($proceso == '111112') $ou = '<span style="color:black"> <br>Intalación:Pendiente</span>';
    if ($proceso == '111113') $ou = '<span style="color:red">   <br>Intalación:Caida</span>';
    if ($proceso == '111111') $ou = '<span style="color:green"> <br>Intalación:Si</span>';
    return $ou;
}

$json_data = array(
    "draw"              => intval( $requestData['draw'] ) // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw.
    , "recordsTotal"    => intval( $totalData ) // total number of records
    , "recordsFiltered" => intval( $totalFiltered ) // total number of records after searching, if there is no searching then totalFiltered = totalData
    , "data"            => $data   // total data array
    , "sql"             => $sql
);

echo json_encode($json_data);  // send data as json format
