<?php
include "../../../../../lib/mysql/dbconnector.php";
include "../../../../../lib/mysql/conexion01.php";
include "../../../../../lib/mysql/utilidades.php";
include "../../../modelo/ModeloVenta.php";
session_start();
$venta = new ModeloVenta();
// -------------------------------------------------------- INPUT
$in['lineas']  = Utilidades::clear_input($_SESSION['lineas']);
$in['proceso'] = Utilidades::clear_input($_POST['proceso']);
$in['title'] = Utilidades::clear_input($_POST['title']);

// --------------------------------------------------------- DATA

$ou = $venta->getTimerEstructuraListado($in);
echo '<center><h2>' . html_entity_decode($in['title']) . '</h2></center>';

echo '<input type="hidden" class="field_proceso" value="' . $in['proceso'] . '">';
echo '<table width="100%">';
echo '<thead>';
echo '<tr>';
echo '<th>Nro</th>
      <th>Fecha de Creación</th>
      <th>Documento</th>
      <th>Cliente</th>
      <th>Campaña</th>
      <th>Supervisor</th>
      <th>Asesor de Venta</th>
      <th>Acciones</th>
     ';
echo '</tr>';
echo '</thead>';
$i = 1;
if (isset($ou)) {
    foreach($ou as $r) {
        echo '<tr>';
        echo '<td>' . $i++ . '</td>';
        echo '<td><center>' . Utilidades::fechas_de_MysqlTimeStamp_a_string_hm($r['fecha'])  . '</center></td>';
        echo '<td>' . utf8_encode($r['documento']) . '</td>';
        echo '<td>' . utf8_encode($r['cliente']) . '</td>';
        echo '<td>' . utf8_encode($r['campania']) . '</td>';
        echo '<td>' . utf8_encode($r['supervisor']) . '</td>';
        echo '<td>' . utf8_encode($r['asesor_venta']) . '</td>';
        echo '<td><a class="aprobar button tiny view no-margin warning" 
                            title="Aprobar"
                            campania="' . $r['indice'] . '"
                            venta_id="' . $r['id'] . '"
                            ><i class="fi-check medium"></i></a> 
                            <a class="edit button tiny view no-margin"
                               venta_id="' . $r['id'] . '"
                               campania="' . $r['indice'] . '"
                               title="Editar"
                               data-open="venta_listado_modal_div"                                  
                            ><i class="fi-pencil medium"></i></a>
              </td>';
        echo '</tr>';
    }
}

echo '</table>';


// ---------------------------------------------------------- OUT
// Utilidades::printr($campanias);
// Utilidades::printr($in);
// Utilidades::printr($ou);
