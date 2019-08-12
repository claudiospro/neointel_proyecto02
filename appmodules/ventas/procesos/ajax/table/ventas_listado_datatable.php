<?php
session_start();

include "../../../../../lib/mysql/dbconnector.php";
include "../../../../../lib/mysql/conexion01.php";
include "../../../../../lib/mysql/utilidades.php";
include "../../../modelo/ModeloVenta.php";

include "datatables_libs.php";

if (isset($_GET['campania']))
{
  $in['campania'] = $_GET['campania'];
} else {
  echo 'No campaña';
  die();
}

$requestData= $_REQUEST;

$libs = new datatables_libs($in);
$sql = $libs->sql(); // die();
$sql_filter = $libs->sql_filter($sql, $requestData);

$totalData = $libs->count($sql, 1);
$totalFiltered = $libs->count($sql_filter, 2);
$data = $libs->data($sql_filter, $requestData);
$json_data = array(
    "draw"              => intval( $requestData['draw'] ) // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw.
    , "recordsTotal"    => intval( $totalData ) // total number of records
    , "recordsFiltered" => intval( $totalFiltered ) // total number of records after searching, if there is no searching then totalFiltered = totalData
    , "data"            => $data   // total data array
    , "sql"             => $sql
);

echo json_encode($json_data);  // send data as json format
