<?php
include "../../../../../lib/mysql/dbconnector.php";
include "../../../../../lib/mysql/utilidades.php";

$cnn= new DBConnector_Alternative();

$conn = mysqli_connect($cnn->servername, $cnn->username, $cnn->password, $cnn->dbname) or die("Connection failed: " . mysqli_connect_error());


session_start();

$lineas = trim($_SESSION['lineas']);

$sql_ini = '
SELECT l.nombre, c.nombre campania, l.info_status vigente,
       l.id
FROM lineal l 
JOIN campania_lineal cp ON cp.lineal_id=l.id
JOIN campania c ON c.id = cp.campania_id
';
if ($lineas != '') {
    $sql_ini .= 'WHERE l.id IN (' . $lineas . ')';
}
// $sql = "
// SELECT unido.*, @rownum:=@rownum+1 row_num  FROM (
// " . $sql_ini . "
// ) unido, (SELECT @rownum:=0) R
// WHERE 1=1
// ";

$sql = "
SELECT * FROM (
" . $sql_ini . "
) unido01
WHERE 1=1
";

$requestData= $_REQUEST;

$query=mysqli_query($conn, $sql) or die("01");

$totalData = mysqli_num_rows($query);
$totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.

$sql_filter = '';

if( !empty($requestData['columns'][0]['search']['value'])) {
    $sql_filter.=' AND nombre LIKE "%' . Utilidades::sanear_complete_string($requestData['columns'][0]['search']['value']) . '%"';
}

if( !empty($requestData['columns'][1]['search']['value']) ) {
    $sql_filter.=' AND campania LIKE "%' . Utilidades::sanear_complete_string($requestData['columns'][1]['search']['value']) . '%"';
}
if( !empty($requestData['columns'][2]['search']['value']) ) {
    $sql_filter.=' AND vigente = "' . (int)$requestData['columns'][2]['search']['value'] . '"';
}
// 3 (acciones)

$sql.= $sql_filter;

$sql_donde = '';
$pagina ='';
if ( !empty($requestData['search']['value']) && trim($requestData['search']['value']) != '' )  {
    // esto es para recuperar la pagina (es muy importante)
    $dd = 'tem_usuario_grupo_' . rand(0,200);
    $sql_donde = 'CREATE TEMPORARY TABLE '. $dd . ' ' . $sql;
    $sql_donde.=" ORDER BY ". (intval($requestData['order'][0]['column'])+1);
    $query=mysqli_query($conn, $sql_donde) or die("01.5");
    
    $sql_donde = '
                 SELECT * FROM (
                    SELECT *, @rownum:=@rownum+1 row_num  FROM (
                      SELECT * FROM ' . $dd . '
                    ) unido1, (SELECT @rownum:=0) R
                 ) unido2
                 WHERE id = ' . $requestData['search']['value'];
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
    $sql_donde = 'DROP TEMPORARY TABLE '. $dd;    
    $query=mysqli_query($conn, $sql_donde) or die("01.6");
}
if ($pagina != '')
    $requestData['start'] = $pagina;

$query=mysqli_query($conn, $sql) or die("02");
$totalFiltered = mysqli_num_rows($query);

$sql.=" ORDER BY ". (intval($requestData['order'][0]['column'])+1)." ".$requestData['order'][0]['dir']." LIMIT ".$requestData['start']." ,".$requestData['length']." ";// print $sql;
$query=mysqli_query($conn, $sql) or die("03");

$data = array();

$info_status = array('0' => 'No' , '1' => 'Si');

while( $row=mysqli_fetch_array($query) ) {
    // l.nombre, c.nombre campania, l.info_status,
    $nestedData = array();
    $nestedData[] = utf8_encode($row['nombre']);
    $nestedData[] = utf8_encode($row['campania']);
    $nestedData[] = '<center>' . $info_status[$row['vigente']] . '<center>';
    $acciones = '';    
    $acciones.= '<a class="button tiny edit no-margin" grupo_id="' . $row['id'] . '" data-open="usuario_listado_modal_div2" title="Editar" >
                   <i class="fi-pencil medium"></i>
                 </a>';
    $nestedData[] = '<center class="item-datatable item-datatable-' . $row['id'] . '">' . $acciones . '</center>';
    $data[] = $nestedData;
}

$json_data = array(
    "draw"              => intval( $requestData['draw'] ) 
    , "recordsTotal"    => intval( $totalData ) 
    , "recordsFiltered" => intval( $totalFiltered ) 
    , "data"            => $data
    , "sql"             => $sql
    , "sql_donde"       => $sql_donde
);

echo json_encode($json_data);
