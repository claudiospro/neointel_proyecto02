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
$sql_activo = '';
if ($perfiles != 'Admin' && $perfiles != 'Gerencia' && $perfiles != 'Coordinador') {
    $sql_activo.= ' ';
}

$campania = 'campania_003';
$sql_ini='';
$sql_ini.= '
    SELECT
      v.info_create_fecha 
    , d.fecha_entrega 
    -- ------------------------ no visibles
    , d.fecha_entrega_observacion
    , v.id
    , venta_producto.nombre producto
    , d.producto_cantidad cantidad
    , venta_color.nombre color
    , d.precio
    , d.costo_envio 
    , d.precio_final 
    , venta_tipo_pago.nombre tipo_de_pago
    , venta_modo_entrega.nombre modo_de_entrega
    , venta_obsequio.nombre obsequio
    , cliente_nombre 
    , cliente_contacto_fijo 
    , cliente_contacto_movil
    , venta_ubigeoPeruDepartamento.nombre departamento
    , venta_ubigeoPeruProvincia.nombre provincia
    , venta_ubigeoPeruDistrito.nombre distrito
    , d.direccion
    , referencia_lugar 
    , referencia_fachada
    , venta_estado_real.nombre estado_real
    , d.estado_real estado_real_id
    , u1.nombre recibio_dinero_cliente_nombre
    ,         d.recibio_dinero_cliente
    , u2.nombre recibio_dinero_mensajero_nombre
    ,         d.recibio_dinero_mensajero
    , venta_comprobante_tipo.nombre comprobante_tipo
    , d.comprobante_numero
    FROM venta v 
    JOIN venta_' . $campania . ' d ON d.id=v.id
    LEFT JOIN venta_producto ON venta_producto.id = d.producto 
    LEFT JOIN venta_color ON venta_color.id = d.color
    LEFT JOIN venta_tipo_pago ON venta_tipo_pago.id = d.tipo_pago 
    LEFT JOIN venta_modo_entrega ON venta_modo_entrega.id = d.modo_entrega 
    LEFT JOIN venta_obsequio ON venta_obsequio.id = d.obsequio
    LEFT JOIN venta_ubigeoPeruDepartamento ON venta_ubigeoPeruDepartamento .id = d.ubigeoPeruDepartamento 
    LEFT JOIN venta_ubigeoPeruProvincia ON venta_ubigeoPeruProvincia.id = d.ubigeoPeruProvincia
    LEFT JOIN venta_ubigeoPeruDistrito ON venta_ubigeoPeruDistrito.id = d.ubigeoPeruDistrito
    LEFT JOIN venta_estado_real ON venta_estado_real.id = d.estado_real
    LEFT JOIN usu_usuario u1 ON u1.id= d.recibio_dinero_cliente
    LEFT JOIN usu_usuario u2 ON u2.id= d.recibio_dinero_mensajero
    LEFT JOIN venta_comprobante_tipo ON venta_comprobante_tipo.id = d.comprobante_tipo
    WHERE v.campania = "' . $campania . '" 
    AND v.info_status=1
    ' . $sql_usuario . '
    ';

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

$totalData = mysqli_num_rows($query);
$totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.

$sql = $sql_ini;

$sql_filter = '';
$col = -1;

if( !empty($requestData['columns'][++$col]['search']['value']) ) {
    $sql_filter.=' AND info_create_fecha LIKE "%' . Utilidades::sanear_complete_string($requestData['columns'][$col]['search']['value']) . '%"';
}
if( !empty($requestData['columns'][++$col]['search']['value']) ) {
    $sql_filter.=' AND fecha_entrega LIKE "%' . Utilidades::sanear_complete_string($requestData['columns'][$col]['search']['value']) . '%"';
}
++$col; // observaciones
++$col; // pago/entrega
++$col; // producto
++$col; // montos
if( !empty($requestData['columns'][++$col]['search']['value']) ) {
    $tmp = Utilidades::sanear_complete_string($requestData['columns'][$col]['search']['value']);
    $sql_filter.=' AND (cliente_nombre LIKE "%' . $tmp . '%" 
                     OR cliente_contacto_fijo LIKE "%' . $tmp . '%" 
                     OR cliente_contacto_movil LIKE "%' . $tmp . '%"
                     )';
}
if( !empty($requestData['columns'][++$col]['search']['value']) ) {
    $tmp = Utilidades::sanear_complete_string($requestData['columns'][$col]['search']['value']);
    $sql_filter.=' AND (departamento LIKE "%' . $tmp . '%" 
                     OR provincia LIKE "%' . $tmp . '%" 
                     OR distrito LIKE "%' . $tmp . '%"
                     OR direccion LIKE "%' . $tmp . '%"
                     )';
}
++$col; // referencia
if ($perfiles == 'Motorizado') {
    $sql_filter.=' AND estado_real_id NOT IN (22, 23)';
}
if( !empty($requestData['columns'][++$col]['search']['value']) ) {
    $sql_filter.=' AND estado_real_id LIKE "%' . Utilidades::sanear_complete_string($requestData['columns'][$col]['search']['value']) . '%"';
}
++$col; // responsalbles: falta!!!
++$col; // comprobante: falta!!!

$sql.= $sql_filter;

$query=mysqli_query($conn, $sql) or die("02");
$totalFiltered = mysqli_num_rows($query); // when there is a search parameter then we have to modify total number filtered rows as per search result.

$sql.=" ORDER BY ". (intval($requestData['order'][0]['column'])+1)." ".$requestData['order'][0]['dir']." LIMIT ".$requestData['start']." ,".$requestData['length']." ";// print $sql;
/* $requestData['order'][0]['column'] contains colmun index, $requestData['order'][0]['dir'] contains order such as asc/desc  */


$query=mysqli_query($conn, $sql) or die("03");

// esto es para decir cuando no se puede $editar

$data = array();
while( $row=mysqli_fetch_array($query) ) {
    $nestedData = array();

    $nestedData[] = imprimir('info_create_fecha', $row['info_create_fecha']);
    $nestedData[] = imprimir('fecha_entrega', $row['fecha_entrega']);
    $nestedData[] = imprimir('fecha_entrega_observacion', $row['fecha_entrega_observacion']);
    $nestedData[] = imprimir('pago_entrega', $row);
    $nestedData[] = imprimir('producto', $row);
    $nestedData[] = imprimir('montos', $row);
    $nestedData[] = imprimir('cliente', $row);
    $nestedData[] = imprimir('ubigeo', $row);
    $nestedData[] = imprimir('referencia', $row);
    $nestedData[] = imprimir('estado_real', $row['estado_real']);
    $nestedData[] = imprimir('recibio_dinero', $row);
    $nestedData[] = imprimir('comprobante', $row);

    $data[] = $nestedData;
}

function imprimir($campo, $datos) {
    $ou = '';
    switch ($campo) {
    case 'info_create_fecha':
    case 'fecha_entrega':
        $ou .= substr($datos, 0, -9);
        break;
    case 'pago_entrega':
        $ou .= utf8_encode($datos['tipo_de_pago']);
        $ou .= '<hr class="no-margin">';
        $ou .= utf8_encode($datos['modo_de_entrega']);
        break;
    case 'producto':
        $ou .= '<div>';
        $ou .=  utf8_encode($datos['producto']) . '</div>';
        $ou .= '<div><b style="color: #9f9f9f;">Cantidad: </b>';
        $ou .= utf8_encode($datos['cantidad']) . '</div>';
        $ou .= '<div><b style="color: #9f9f9f;">Color: </b>';
        $ou .= utf8_encode($datos['color']) . '</div>';
        $ou .= '<div><b style="color: #9f9f9f;">Obsequio: </b>';
        $ou .= utf8_encode($datos['obsequio']) . '</div>';
        break;
    case 'montos':
        $ou .= '<div><b style="color: #9f9f9f;">Precio: </b>';
        $ou .= utf8_encode($datos['precio']) . '</div>';
        $ou .= '<div><b style="color: #9f9f9f;">Costo Envio: </b>';
        $ou .= utf8_encode($datos['costo_envio']) . '</div>';
        $ou .= '<div><b style="color: #9f9f9f;">Precio Final: </b>';
        $ou .= utf8_encode($datos['precio_final']) . '</div>';
        break;
    case 'cliente':
        $ou .= '<div>';
        $ou .= utf8_encode($datos['cliente_nombre']) . '</div>';
        $ou .= '<div><b style="color: #9f9f9f;">Tel. Fij: </b>';
        $ou .= utf8_encode($datos['cliente_contacto_fijo']) . '</div>';
        $ou .= '<div><b style="color: #9f9f9f;">Tel. Mov: </b>';
        $ou .= utf8_encode($datos['cliente_contacto_movil']) . '</div>';
        break;
    case 'ubigeo':
        $ou .= '<div><b style="color: #9f9f9f;">Departamento: </b>';
        $ou .= utf8_encode($datos['departamento']) . '</div>';
        $ou .= '<div><b style="color: #9f9f9f;">Provincia: </b>';
        $ou .= utf8_encode($datos['provincia']) . '</div>';
        $ou .= '<div><b style="color: #9f9f9f;">Distrito: </b>';
        $ou .= utf8_encode($datos['distrito']) . '</div>';
        $ou .= '<div><b style="color: #9f9f9f;">Dirección: </b>';
        $ou .= utf8_encode($datos['direccion']) . '</div>';
        break;
    case 'referencia':
        $ou .= '<div>';
        $ou .= utf8_encode($datos['referencia_fachada']) . '</div>';
        $ou .= '<div><b style="color: #9f9f9f;">Fachada: </b>';
        $ou .= utf8_encode($datos['referencia_fachada']) . '</div>';        
        break;
    case 'recibio_dinero':
        $ou .= '<b style="color: #9f9f9f;">del Cliente : </b>';
        $ou .= '<div class="editable-inline line2" class="">
                  <a></a>
                  <span venta_id="' . $datos['id'] . '" campo="recibio_dinero_cliente">
                  ' . utf8_encode($datos['recibio_dinero_cliente_nombre']) . '
                  </span>
                  <div style="display:none"></div>
                </div>';
        $ou .= '<b style="color: #9f9f9f;">del Mensajero: </b>';
        $ou .= '<div class="editable-inline line2" class="">
                  <a></a>
                  <span venta_id="' . $datos['id'] . '" campo="recibio_dinero_mensajero">
                  ' . utf8_encode($datos['recibio_dinero_mensajero_nombre']) . '
                  </span>
                  <div style="display:none"></div>
                </div>';
        break;
    case 'comprobante':
        $ou .= '<b style="color: #9f9f9f;">Tipo: </b>';
        $ou .= '<div class="editable-inline line2" class="">
                  <a></a>
                  <span venta_id="' . $datos['id'] . '" campo="comprobante_tipo">
                  ' . utf8_encode($datos['comprobante_tipo']) . '
                  </span>
                  <div style="display:none"></div>
                </div>'
                                                              ;
        $ou .= '<b style="color: #9f9f9f;">Nmro: </b>';
        $ou .= '<div class="editable-inline line2" class="">
                  <a></a>
                  <span venta_id="' . $datos['id'] . '" campo="comprobante_numero">
                  ' . utf8_encode($datos['comprobante_numero']) . '
                  </span>
                  <div style="display:none"></div>
                </div>';
        break;
    default: 
        $ou .= utf8_encode($datos);
    }
    return $ou;        
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

$json_data = array(
    "draw"              => intval( $requestData['draw'] ) // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw.
    , "recordsTotal"    => intval( $totalData ) // total number of records
    , "recordsFiltered" => intval( $totalFiltered ) // total number of records after searching, if there is no searching then totalFiltered = totalData
    , "data"            => $data   // total data array
    , "sql"             => $sql
);
echo json_encode($json_data);  // send data as json format
