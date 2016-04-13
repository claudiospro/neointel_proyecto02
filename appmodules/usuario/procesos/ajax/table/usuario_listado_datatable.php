<?php
include "../../../../../lib/mysql/dbconnector.php";
include "../../../../../lib/mysql/utilidades.php";

$cnn= new DBConnector_Alternative();

$conn = mysqli_connect($cnn->servername, $cnn->username, $cnn->password, $cnn->dbname) or die("Connection failed: " . mysqli_connect_error());


session_start();

$sql_ini = '
SELECT
u.nombre, u.login,  p.nombre perfil, u.info_status vigente, 
u.id, up.perfil_id, ul.lineal_id
FROM usu_usuario u
LEFT JOIN usu_usuario_lineal ul ON ul.usuario_id=u.id
LEFT JOIN usu_usuario_perfil up ON up.usuario_id=u.id
LEFT JOIN usu_perfil p ON p.id=up.perfil_id
WHERE u.id !=1
';

$sql = "
SELECT unido.*, @rownum:=@rownum+1 row_num  FROM (
" . $sql_ini . "
) unido, (SELECT @rownum:=0) R
WHERE 1=1
";


// storing  request (ie, get/post) global array to a variable  
$requestData= $_REQUEST;


// getting total number records without any search
// $sql = $sql_ini;
// echo $sql;
$query=mysqli_query($conn, $sql) or die("01");


$totalData = mysqli_num_rows($query);
$totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.

$sql = $sql_ini;

$sql_filter = '';
if( !empty($requestData['columns'][0]['search']['value']) && $requestData['columns'][0]['search']['value'] != '-1') {
    $sql_filter.=' AND lineal_id = "' . $requestData['columns'][0]['search']['value'] . '"';
}

if( !empty($requestData['columns'][1]['search']['value']) ) {
    $sql_filter.=' AND nombre LIKE "%' . Utilidades::sanear_complete_string($requestData['columns'][1]['search']['value']) . '%"';
}
if( !empty($requestData['columns'][2]['search']['value']) ) {
    $sql_filter.=' AND login  LIKE "%' . Utilidades::sanear_complete_string($requestData['columns'][2]['search']['value']) . '%"';
}
if( !empty($requestData['columns'][3]['search']['value']) ) {
    $sql_filter.=' AND perfil_id = "' . Utilidades::sanear_complete_string($requestData['columns'][3]['search']['value']) . '"';
}
if( !empty($requestData['columns'][4]['search']['value']) ) {
    $sql_filter.=' AND vigente = "' . (int)$requestData['columns'][4]['search']['value'] . '"';
}
// 5 (acciones)

$sql.= $sql_filter;

$sql_donde = '';
$pagina ='';
if ( !empty($requestData['search']['value']) && trim($requestData['search']['value']) != '' )  {
    // esto es para recuperar la pagina (es muy importante)

    
    $sql_donde.= 'SELECT * FROM (SELECT unido.*, @rownum:=@rownum+1 row_num  FROM ( ' . $sql_ini;
    $sql_donde.= ' ORDER BY '. (intval($requestData['order'][0]['column'])+1) . ' ' . $requestData['order'][0]['dir'] ;
    $sql_donde.= ') unido, (SELECT @rownum:=0) R WHERE 1=1';
    $sql_donde.= ') unido2 WHERE id=' . intval($requestData['search']['value']) ;
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

$bool_str = array('0'=>'No', '1'=>'Si');

$query=mysqli_query($conn, $sql) or die("03");

$data = array();
$id_old = 0;
$combo = '
<select class="item-vigente-tbl no-margin no-padding search-input-select"
        usuario_id=""
        style="width: 45px;">
   <option value="1">Si</option>
   <option value="0">No</option>
</select>
';
while( $row=mysqli_fetch_array($query) ) {
    // if ($id_old != $row['id'])
    // {
        $nestedData = array();
        $nestedData[] = utf8_encode($row['nombre']);
        $nestedData[] = '<center>' . utf8_encode($row['login']) . '</center>';
        $nestedData[] = '<center>' . utf8_encode($row['perfil']) . '</center>';
        $tmp = $combo;
        $tmp = str_replace('option value="' . $row['vigente'] . '"', 'option value="' . $row['vigente'] . '" selected', $tmp);
        $tmp = str_replace('usuario_id=""', 'usuario_id="' . $row['id'] . '"', $tmp);
        $nestedData[] = '<center>' . $tmp . '</center>';
        $acciones = '';    
        $acciones.= '<a class="button tiny edit no-margin" usuario_id="' . $row['id'] . '" data-open="usuario_listado_modal_div" title="Editar" ><i class="fi-pencil medium"></i></a>';
        $nestedData[] = '<center class="item-datatable item-datatable-' . $row['id'] . '">' . $acciones . '</center>';
        $data[] = $nestedData;
        
        $id_old = $row['id'];
        //  }
}

$json_data = array(
    "draw"              => intval( $requestData['draw'] ) // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw.
    , "recordsTotal"    => intval( $totalData ) // total number of records
    , "recordsFiltered" => intval( $totalFiltered ) // total number of records after searching, if there is no searching then totalFiltered = totalData
    , "data"            => $data   // total data array
    , "sql"             => $sql
    , "donde"           => $sql_donde
    , "pagina"          => $pagina
);

echo json_encode($json_data);  // send data as json format
