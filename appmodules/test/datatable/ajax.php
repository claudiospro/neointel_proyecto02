<?php
include "../../../lib/mysql/dbconnector.php";
include "../../../lib/mysql/utilidades.php";

$cnn= new DBConnector_Alternative();

$conn = mysqli_connect($cnn->servername, $cnn->username, $cnn->password, $cnn->dbname) or die("Connection failed: " . mysqli_connect_error());

$sql_columns= "

";

$sql_ini = "

";

session_start();

$requestData= $_REQUEST;

$sql = $sql_ini; //echo $sql;
$query=mysqli_query($conn, $sql) or die("01");

$totalData = mysqli_num_rows($query);
$totalFiltered = $totalData; 

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
// 3 (acciones)

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
// echo $sql;

$query=mysqli_query($conn, $sql) or die("03");

$data = array();
while( $row=mysqli_fetch_array($query) ) {
    $nestedData = array();
    // venta_id | estado_id | row_num |
    $nestedData[] = Utilidades::fechas_de_MysqlTimeStamp_a_string($row['fecha']);
    $nestedData[] = utf8_encode($row['']);
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
