<?php
include "../../../../../lib/mysql/dbconnector.php";
include "../../../../../lib/mysql/utilidades.php";

$cnn= new DBConnector_Alternative();

$conn = mysqli_connect($cnn->servername, $cnn->username, $cnn->password, $cnn->dbname) or die("Connection failed: " . mysqli_connect_error());

$sql_columns= "
  ve.info_create
, ve.fecha_venta
, ve.fecha_instalacion
, TIMESTAMPDIFF(DAY, '" . date('Y-m-d'). "', ve.fecha_instalacion) dias_instalacion
, es.nombre estado_nombre
, su.nombre supervisor_nombre
, tr.nombre tramitacion_nombre
, ac.nombre asesor_comercial_nombre
, 'ddd' telefono_fijo
, cl.nombre cliente_nombre
, cl.documento cliente_documento
, pr.nombre producto_nombre
, ca.nombre campania_nombre
--
, ve.id venta_id
, ve.estado_id
, ve.asesor_comercial_id
, ve.tramitacion_id
, ve.supervisor_id
";

$sql_ini = "
SELECT unido.*, @rownum:=@rownum+1 row_num  FROM (
  SELECT
  " . $sql_columns . "
FROM ven_venta ve
LEFT JOIN ven_estado es ON es.id=ve.estado_id
LEFT JOIN cliente cl ON cl.id=ve.cliente_id
LEFT JOIN ven_producto pr ON pr.id=ve.producto_id
LEFT JOIN campania ca ON ca.id=pr.campania_id
LEFT JOIN usu_usuario ac ON ac.id=ve.asesor_comercial_id
LEFT JOIN usu_usuario tr ON tr.id=ve.tramitacion_id
LEFT JOIN usu_usuario su ON su.id=ve.supervisor_id
) unido, (SELECT @rownum:=0) R
WHERE 1=1
";


/*
, ve.
, ve.
, ve.
*/
session_start();
$perfiles = trim($_SESSION['perfiles']);
if ($perfiles=='Tramitacion') {
    $sql_ini.= ' AND tramitacion_id="' . $_SESSION['user_id'] . '"';
} elseif ($perfiles=='Supervisor') {
    $sql_ini.= ' AND supervisor_id="' . $_SESSION['user_id'] . '"';
} elseif ($perfiles=='Asesor Comercial') {
    $sql_ini.= ' AND asesor_comercial_id="' . $_SESSION['user_id'] . '"';
}

// storing  request (ie, get/post) global array to a variable  
$requestData= $_REQUEST;


// getting total number records without any search
$sql = $sql_ini;
$query=mysqli_query($conn, $sql) or die("01");
// print $sql;

$totalData = mysqli_num_rows($query);
$totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.

$sql = $sql_ini;

$sql_filter = '';
if( !empty($requestData['columns'][0]['search']['value']) ) {
    $sql_filter.=' AND info_create LIKE "%' . $requestData['columns'][0]['search']['value'] . '%"';
}
if( !empty($requestData['columns'][1]['search']['value']) ) {
    $sql_filter.=' AND fecha_venta LIKE "%' . $requestData['columns'][1]['search']['value'] . '%"';
}
if( !empty($requestData['columns'][2]['search']['value']) ) {
    $sql_filter.=' AND fecha_instalacion LIKE "%' . $requestData['columns'][2]['search']['value'] . '%"';
}
if( !empty($requestData['columns'][3]['search']['value']) ) {
    $sql_filter.=' AND dias_instalacion = "' . $requestData['columns'][3]['search']['value'] . '"';
}
if( !empty($requestData['columns'][4]['search']['value']) ) {
    $sql_filter.=' AND LOWER(estado_nombre) LIKE "%' . strtolower($requestData['columns'][4]['search']['value']) . '%"';
}
if( !empty($requestData['columns'][5]['search']['value']) ) {
    $sql_filter.=' AND LOWER(supervisor_nombre) LIKE "%' . strtolower($requestData['columns'][5]['search']['value']) . '%"';
}
if( !empty($requestData['columns'][6]['search']['value']) ) {
    $sql_filter.=' AND LOWER(tramitacion_nombre) LIKE "%' . strtolower($requestData['columns'][6]['search']['value']) . '%"';
}
if( !empty($requestData['columns'][7]['search']['value']) ) {
    $sql_filter.=' AND LOWER(asesor_comercial_nombre) LIKE "%' . strtolower($requestData['columns'][7]['search']['value']) . '%"';
}
if( !empty($requestData['columns'][8]['search']['value']) ) {
    $sql_filter.=' AND LOWER(telefono_fijo) LIKE "%' . strtolower($requestData['columns'][8]['search']['value']) . '%"';
}
if( !empty($requestData['columns'][9]['search']['value']) ) {
    $sql_filter.=' AND LOWER(cliente_nombre) LIKE "%' . strtolower($requestData['columns'][9]['search']['value']) . '%"';
}
if( !empty($requestData['columns'][10]['search']['value']) ) {
    $sql_filter.=' AND LOWER(cliente_documento) LIKE "%' . strtolower($requestData['columns'][10]['search']['value']) . '%"';
}
if( !empty($requestData['columns'][11]['search']['value']) ) {
    $sql_filter.=' AND LOWER(producto_nombre) LIKE "%' . strtolower($requestData['columns'][11]['search']['value']) . '%"';
}
if( !empty($requestData['columns'][12]['search']['value']) ) {
    $sql_filter.=' AND LOWER(campania_nombre) LIKE "%' . strtolower($requestData['columns'][12]['search']['value']) . '%"';
}
// 13 (acciones)

$sql.= $sql_filter;

/* $sql_donde = ''; */
/* $pagina =''; */
/* if ( !empty($requestData['search']['value']) && trim($requestData['search']['value']) != '' )  { */
/*     // esto es para recuperar la pagina (es muy importante) */
/*     $sql_donde.= 'SELECT * FROM (' . $sql; */
/*     $sql_donde.= ' ORDER BY '. (intval($requestData['order'][0]['column'])+1) . ' ' . $requestData['order'][0]['dir']; */
/*     $sql_donde.= ') unido2 WHERE direccion_id=' . intval($requestData['search']['value']) ; */
/*     $query=mysqli_query($conn, $sql_donde) or die("01.5"); */
/*     while( $row=mysqli_fetch_array($query) ) $pagina = $row['row_num']; */
/*     $pagina -= 1; */
/*     if ($pagina > 0) { */
/*         $pagina-= ($pagina % $requestData['length']); */
/*         if ($pagina > 0) { */
/*             $pagina /= $requestData['length']; */
/*         } */
/*     } */
/*     $pagina *= $requestData['length']; */
/* } */
/* if ($pagina != '') */
/*     $requestData['start'] = $pagina; */

$query=mysqli_query($conn, $sql) or die("02");
$totalFiltered = mysqli_num_rows($query); // when there is a search parameter then we have to modify total number filtered rows as per search result.

$sql.=" ORDER BY ". (intval($requestData['order'][0]['column'])+1)." ".$requestData['order'][0]['dir']." LIMIT ".$requestData['start']." ,".$requestData['length']." ";
/* $requestData['order'][0]['column'] contains colmun index, $requestData['order'][0]['dir'] contains order such as asc/desc  */

// print $sql;
$query=mysqli_query($conn, $sql) or die("03");

$data = array();
while( $row=mysqli_fetch_array($query) ) {
    $nestedData = array();
    // venta_id | estado_id | row_num |
    $nestedData[] = Utilidades::fechas_de_MysqlTimeStamp_a_string($row['info_create']);
    $nestedData[] = Utilidades::fechas_de_MysqlTimeStamp_a_string($row['fecha_venta']);
    $nestedData[] = Utilidades::fechas_de_MysqlTimeStamp_a_string($row['fecha_instalacion']);
    $nestedData[] = $row['dias_instalacion'];
    $nestedData[] = utf8_encode($row['estado_nombre']);
    $nestedData[] = utf8_encode($row['supervisor_nombre']);
    $nestedData[] = utf8_encode($row['tramitacion_nombre']);
    $nestedData[] = utf8_encode($row['asesor_comercial_nombre']);
    $nestedData[] = utf8_encode($row['telefono_fijo']);
    $nestedData[] = utf8_encode($row['cliente_nombre']);
    $nestedData[] = utf8_encode($row['cliente_documento']);
    $nestedData[] = utf8_encode($row['producto_nombre']);
    $nestedData[] = utf8_encode($row['campania_nombre']);
    $acciones = '<a class="button edit no-margin" codigo="'.$row['venta_id'].'" title="Editar"><i class="fi-pencil medium"></i></a>';
    $acciones.= '<a class="button edit secondary no-margin" codigo="'.$row['venta_id'].'" title="Ver"><i class="fi-info medium"></i></a>';
    $nestedData[] = $acciones;

    $data[] = $nestedData;
}

$json_data = array(
    "draw"            => intval( $requestData['draw'] ) // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw.
    , "recordsTotal"    => intval( $totalData ) // total number of records
    , "recordsFiltered" => intval( $totalFiltered ) // total number of records after searching, if there is no searching then totalFiltered = totalData
    , "data"            => $data   // total data array
    , "sql"             => $sql
);

echo json_encode($json_data);  // send data as json format
