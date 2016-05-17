<?php
include "../../../../../lib/mysql/dbconnector.php";
include "../../../../../lib/mysql/conexion01.php";
include "../../../../../lib/mysql/utilidades.php";
include "../../../modelo/ModeloApunte.php";
session_start();
$prefix = 'apuntes_listado_';
$modelo = new ModeloApunte();

// -------------------------------------------------------- INPUT

$in['search_ini'] = Utilidades::clear_input($_POST['search_ini']);
$in['search_end'] = Utilidades::clear_input($_POST['search_end']);
$in['search_pendiente'] = (int) Utilidades::clear_input($_POST['search_pendiente']);

$in['pagina'] = Utilidades::clear_input($_POST['pagina']);
$in['items'] = $modelo->apuntes_get_pagina();
$in['user_id'] = Utilidades::clear_input($_SESSION['user_id']);


// --------------------------------------------------------- DATA
$ou = $modelo->apuntes_listado($in);


// --------------------------------------------------------- TEST
// Utilidades::printr($_POST);
// Utilidades::printr($ou);


// ------------------------------------------------------- OUTPUT
if (isset($ou)) 
    foreach($ou as $row) {
        $pendiente= 'pendiente-no';
        if ($row['pendiente'] == '1') {
            $pendiente= 'pendiente-si';
        }
        if ('' == trim($row['telefono'])) {
            $row['telefono'] = 'Vacio';
        }
        echo '
        <div id="#item-' . $row['id'] . '" class="item column">
          <a data-open="' . $prefix . 'modal"
             class="' . $pendiente . '"
             item="' . $row['id'] . '">
            <p>' . Utilidades::fechas_de_MysqlTimeStamp_a_string_hm($row['info_create_fecha']) . '
               <strong> Teléfono</strong>: ' . utf8_decode($row['telefono'])  . '
            </p>
            <div class="resumen">
            ' . html_entity_decode($row['texto']) . '  
            </div>
          </a>
        </div>
        ';
    }
?>

