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

// --------------------------------------------------------- ini lineales
// con esto se optimiza, en vez de mostrar todo, solo se muestra uno solo
$sql = 'SELECT DISTINCT c.indice FROM campania c
        JOIN campania_lineal cl ON cl.campania_id = c.id
        WHERE c.info_status=1';
if ('' != trim($_SESSION['lineas'])) {
    $sql.= ' AND cl.lineal_id IN (' . $_SESSION['lineas'] . ')';
}
$query=mysqli_query($conn, $sql) or die("00");
// --------------------------------------------------------- end lineales

$sql_ini='';
$campanias = array();
while( $row=mysqli_fetch_array($query) ) {
    $campanias[] = $row['indice'];
    if ($sql_ini!='') {
        $sql_ini.= ' UNION ';
    }
    $sql_ini.= "
SELECT
  d1.nombre campania_nombre
, d2.nombre producto
, d.cliente_nombre
, d.cliente_documento
, d3.nombre estado
, d8.nombre estado_real
, d9.nombre estado_tramitacion
, v.info_create_fecha fecha_creacion
, v.info_update_fecha fecha_actualizacion
, d.fecha_instalada
, d4.nombre asesor_venta
, d6.nombre supervisor
, d7.nombre coordinador
, v.info_status
--
, v.id venta_id
, v.campania
, d.estado estado_id
, d.estado_real estado_real_id
, d.estado_tramitacion estado_tramitacion_id
FROM venta v 
JOIN  venta_".$row['indice']." d ON d.id=v.id
-- definiciones
LEFT JOIN campania d1 ON d1.indice=v.campania
LEFT JOIN venta_producto d2 ON d2.id=d.producto
LEFT JOIN venta_estado d3 ON d3.id=d.estado
LEFT JOIN usu_usuario d4 ON d4.id=v.asesor_venta_id
LEFT JOIN usu_usuario d6 ON d6.id=v.supervisor_id
LEFT JOIN usu_usuario d7 ON d7.id=v.coordinador_id
LEFT JOIN venta_estado_real d8 ON d8.id=d.estado_real
LEFT JOIN venta_estado_tramitacion d9 ON d9.id=d.estado_tramitacion
WHERE v.campania = '".$row['indice']."'". $sql_activo . " " . $sql_usuario . "";
    
}


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
if( !empty($requestData['columns'][0]['search']['value']) ) {
    $sql_filter.=' AND campania = "' . Utilidades::sanear_complete_string($requestData['columns'][0]['search']['value']) . '"';
}else {
$sql_filter.=' AND campania = "' . $campanias[0] . '"';
}

if( !empty($requestData['columns'][1]['search']['value']) ) {
    $sql_filter.=' AND producto LIKE "%' . Utilidades::sanear_complete_string($requestData['columns'][1]['search']['value']) . '%"';
}
if( !empty($requestData['columns'][2]['search']['value']) ) {
    $sql_filter.=' AND cliente_nombre LIKE "%' . Utilidades::sanear_complete_string($requestData['columns'][2]['search']['value']) . '%"';
}
if( !empty($requestData['columns'][3]['search']['value']) ) {
    $sql_filter.=' AND cliente_documento LIKE "%' . Utilidades::sanear_complete_string($requestData['columns'][3]['search']['value']) . '%"';
}
if( !empty($requestData['columns'][4]['search']['value']) ) {
    $sql_filter.=' AND estado_id = "' . Utilidades::sanear_complete_string($requestData['columns'][4]['search']['value']) . '"';
}
if( !empty($requestData['columns'][5]['search']['value']) ) {
    $sql_filter.=' AND estado_real_id = "' . Utilidades::sanear_complete_string($requestData['columns'][5]['search']['value']) . '"';
}
if( !empty($requestData['columns'][6]['search']['value']) ) {
    $sql_filter.=' AND estado_tramitacion_id = "' . Utilidades::sanear_complete_string($requestData['columns'][6]['search']['value']) . '"';
}
if( !empty($requestData['columns'][7]['search']['value']) ) {
    $sql_filter.=' AND fecha_creacion LIKE "%' . Utilidades::sanear_complete_string($requestData['columns'][7]['search']['value']) . '%"';
}
if( !empty($requestData['columns'][8]['search']['value']) ) {
    $sql_filter.=' AND fecha_actualizacion LIKE "%' . Utilidades::sanear_complete_string($requestData['columns'][8]['search']['value']) . '%"';
}
if( !empty($requestData['columns'][9]['search']['value']) ) {
    $sql_filter.=' AND fecha_instalada LIKE "%' . Utilidades::sanear_complete_string($requestData['columns'][9]['search']['value']) . '%"';
}
if( !empty($requestData['columns'][10]['search']['value']) ) {
    $sql_filter.=' AND asesor_venta LIKE "%' . Utilidades::sanear_complete_string($requestData['columns'][10]['search']['value']) . '%"';
}
if( !empty($requestData['columns'][11]['search']['value']) ) {
    $sql_filter.=' AND supervisor LIKE "%' . Utilidades::sanear_complete_string($requestData['columns'][11]['search']['value']) . '%"';
}
if( !empty($requestData['columns'][12]['search']['value']) ) {
    $sql_filter.=' AND coordinador LIKE "%' . Utilidades::sanear_complete_string($requestData['columns'][12]['search']['value']) . '%"';
}
$bool_str = array('0'=>'Si', '1'=>'No');
if( !empty($requestData['columns'][13]['search']['value']) ) {
    $bool = $requestData['columns'][13]['search']['value'];
    if ($bool=='si' || $bool=='s') {
        $sql_filter.=' AND info_status  = "0"';
    } elseif($bool=='no' || $bool=='n') {
        $sql_filter.=' AND info_status  = "1"';
    }    
}
// 14 (acciones)

$sql.= $sql_filter;

$sql_donde = '';
$pagina ='';
if ( !empty($requestData['search']['value']) && trim($requestData['search']['value']) != '' )  {
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
$editar['Admin']                        = array (0 => true , 1 => true , 2 => true , 3=> true );
$editar['Gerencia']                     = array (0 => true , 1 => true , 2 => true , 3=> true );
$editar['Coordinador']                  = array (0 => true , 1 => true , 2 => true , 3=> true );
$editar['Tramitacion']                  = array (0 => true , 1 => true , 2 => true , 3=> true );
$editar['Tramitacion-Validacion-Carga'] = array (0 => true , 1 => true , 2 => true , 3=> false);
$editar['Tramitacion-Carga']            = array (0 => true , 1 => false, 2 => true , 3=> false);
$editar['Tramitacion-Validacion']       = array (0 => true , 1 => true , 2 => false, 3=> false);
$editar['Supervisor']                   = array (0 => true , 1 => true , 2 => false, 3=> false);
$editar['Asesor Comercial']             = array (0 => false, 1 => false, 2 => false, 3=> false);

$data = array();
while( $row=mysqli_fetch_array($query) ) {
    $nestedData = array();

    $nestedData[] = utf8_encode($row['campania_nombre']);
    $nestedData[] = utf8_encode($row['producto']);
    $nestedData[] = utf8_encode($row['cliente_nombre']);
    $nestedData[] = utf8_encode($row['cliente_documento']);
    $nestedData[] = utf8_encode($row['estado']);
    $nestedData[] = utf8_encode($row['estado_real']);
    $nestedData[] = utf8_encode($row['estado_tramitacion']);
    $nestedData[] = Utilidades::fechas_de_MysqlTimeStamp_a_string_hm($row['fecha_creacion']);
    $nestedData[] = Utilidades::fechas_de_MysqlTimeStamp_a_string($row['fecha_actualizacion']);
    $nestedData[] = Utilidades::fechas_de_MysqlTimeStamp_a_string($row['fecha_instalada']);
    $nestedData[] = utf8_encode($row['asesor_venta']);
    $nestedData[] = utf8_encode($row['supervisor']);
    $nestedData[] = utf8_encode($row['coordinador']);
    $nestedData[] = '<center>' . $bool_str[$row['info_status']] . '</center>';
    $acciones = '';    
    if ($editar[ $perfiles ][ $row['estado_tramitacion_id'] ]) { // aca hay que cambiar por el estado de tramitacion
        $acciones.= '<a class="button tiny edit no-margin" venta_id="' . $row['venta_id'] . '" campania="' . $row['campania'] . '" data-open="venta_listado_modal_div" title="Editar" ><i class="fi-pencil medium"></i></a>';
    }
    $acciones.= '<a class="button tiny view no-margin secondary" venta_id="' . $row['venta_id'] . '" campania="' . $row['campania'] . '" data-open="venta_listado_modal_div" title="Ver" ><i class="fi-info medium"></i></a>';
    if ($editar[ $perfiles ][ $row['estado_tramitacion_id'] ]) {
        $acciones.= '<a class="button tiny delete no-margin alert" venta_id="' . $row['venta_id'] . '" campania="' . $row['campania'] . '" title="Eliminar" ><i class="fi-x medium"></i></a>';
    }
    $nestedData[] = '<center class="item-datatable item-datatable-' . $row['venta_id'] . '">' . $acciones . '</center>';

    $data[] = $nestedData;
}

$json_data = array(
    "draw"              => intval( $requestData['draw'] ) // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw.
    , "recordsTotal"    => intval( $totalData ) // total number of records
    , "recordsFiltered" => intval( $totalFiltered ) // total number of records after searching, if there is no searching then totalFiltered = totalData
    , "data"            => $data   // total data array
    , "sql"             => $sql
);

echo json_encode($json_data);  // send data as json format
