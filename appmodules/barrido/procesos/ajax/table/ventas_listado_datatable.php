<?php
include "../../../../../lib/mysql/dbconnector.php";
include "../../../../../lib/mysql/utilidades.php";

$cnn= new DBConnector_Alternative();

$conn = mysqli_connect($cnn->servername, $cnn->username, $cnn->password, $cnn->dbname) or die("Connection failed: " . mysqli_connect_error());


session_start();
$perfiles = trim($_SESSION['perfiles']);
$sql_usuario = '';
if ($_SESSION['lineas'] != '') {
    $sql_usuario.= 'AND v.lineal_id IN (' . $_SESSION['lineas'] . ')';
} 
$sql = 'SELECT indice FROM campania WHERE info_status=1';
$query=mysqli_query($conn, $sql) or die("00");
$sql_ini='';
while( $row=mysqli_fetch_array($query) ) {
    if ($sql_ini!='') {
        $sql_ini.= ' UNION ';
    }
    $sql_ini.= "
SELECT
  'dda'
, d4.nombre estado
, d3.nombre asesor_venta
, v.info_create_fecha fecha_creacion
, d2.nombre producto
, d1.cliente_nombre
--
, v.id venta_id
, v.campania
, d1.estado estado_id
FROM venta v 
JOIN  venta_".$row['indice']." d1 ON d1.id=v.id
-- definiciones
LEFT JOIN venta_producto d2 ON d2.id=d1.producto
LEFT JOIN usu_usuario d3 ON d3.id=v.asesor_venta_id
LEFT JOIN venta_estado d4 ON d4.id=d1.estado
WHERE v.campania = '".$row['indice']."' AND v.info_status=1 " . $sql_usuario ;
    
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
// 0 (acciones)
if( !empty($requestData['columns'][1]['search']['value']) ) {
    $sql_filter.=' AND estado_id =  "' . Utilidades::sanear_complete_string($requestData['columns'][1]['search']['value']) . '"';
}
if( !empty($requestData['columns'][2]['search']['value']) ) {
    $sql_filter.=' AND asesor_venta LIKE "%' . Utilidades::sanear_complete_string($requestData['columns'][2]['search']['value']) . '%"';
}
if( !empty($requestData['columns'][3]['search']['value']) ) {
    $sql_filter.=' AND fecha_creacion LIKE "%' . Utilidades::sanear_complete_string($requestData['columns'][3]['search']['value']) . '%"';
}
if( !empty($requestData['columns'][4]['search']['value']) ) {
    $sql_filter.=' AND producto LIKE "%' . Utilidades::sanear_complete_string($requestData['columns'][4]['search']['value']) . '%"';
}
if( !empty($requestData['columns'][5]['search']['value']) ) {
    $sql_filter.=' AND cliente_nombre LIKE "%' . Utilidades::sanear_complete_string($requestData['columns'][5]['search']['value']) . '%"';
}

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

$sql.=" ORDER BY ". (intval($requestData['order'][0]['column'])+1)." " . $requestData['order'][0]['dir'] . " LIMIT " . $requestData['start'] . " ,".$requestData['length']." ";// print $sql;
/* $requestData['order'][0]['column'] contains colmun index, $requestData['order'][0]['dir'] contains order such as asc/desc  */


$query=mysqli_query($conn, $sql) or die("03");

$data = array();
while( $row=mysqli_fetch_array($query) ) {
    $nestedData = array();
    $nestedData[] = '<center><input type="checkbox" class="accion" value="' . $row['venta_id'] . '::' . $row['campania'] . '"></center>';
    $nestedData[] = utf8_encode($row['estado']);
    $nestedData[] = utf8_encode($row['asesor_venta']);
    $nestedData[] = Utilidades::fechas_de_MysqlTimeStamp_a_string_hm($row['fecha_creacion']);
    $nestedData[] = utf8_encode($row['producto']);
    $nestedData[] = utf8_encode($row['cliente_nombre']);

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
