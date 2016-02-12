<?php
include "../../../../../lib/mysql/dbconnector.php";
include "../../../../../lib/mysql/conexion01.php";
include "../../../../../lib/mysql/utilidades.php";
include "../../../modelo/ModeloVenta.php";
session_start();
$venta = new ModeloVenta();
// -------------------------------------------------------- INPUT
$in['campania'] = Utilidades::clear_input(Utilidades::sanear_string($_POST['campania']));
$in['venta_id'] = Utilidades::clear_input_id($_POST['venta_id']);
$in['view'] = Utilidades::clear_input_id($_POST['view']);

// -------------------------------------------------------- Data
$campos = $venta->getcampos($in);
$pestanias = $venta->getPestaniaCampania($in);


$in['fields']['id'] = '';
foreach ($campos as $r) {
    $in['fields'][$r['nombre']] = '';
}

$nombre_corto = '';
if ($in['venta_id'] != '0') {
    $dato = $venta->getUnDato($in);
    $nombre_corto = 'Asesor: ' . $venta->getUnDato_NombreCorto($in);
}

// -------------------------------------------------------- TEST
// Utilidades::printr($in);
// Utilidades::printr($_SESSION);
// Utilidades::printr($campos);
// Utilidades::printr($dato);
// -------------------------------------------------------- OUT
echo '<form class="myform" method="post">';

$total = count($pestanias);
echo '<div class="row fields"><div class="small-12 columns">';
echo '<ul class="breadcrumbs">';
echo '<li><a href="#" pestania="0">' . $pestanias[0]['pestania'] . '</a></li>';
$pestanias_str[$pestanias[0]['pestania']] = '';
for ($i=1; $i < $total; $i++) {
    echo '<li><a href="#" pestania="' . $i . '">' . $pestanias[$i]['pestania'] . '</a></li>';
    $pestanias_str[$pestanias[$i]['pestania']] = '';
}
echo '<li>' . $nombre_corto . '</li>';
echo '</ul>';
echo '<hr>';
echo '</div></div>';

echo '<input type="hidden" id="field_venta_id" name="venta_id" value="' . $in['venta_id'] . '">';
echo '<input type="hidden" name="campania" value="' . $in['campania'] . '">';
$total = count($campos);
for ($i=0; $i < $total; $i++) {
    $perfiles = explode(', ', trim($campos[$i]['perfiles']));
    $permisos = explode(', ', trim($campos[$i]['permisos']));
    $campos[$i]['permiso'] = $permisos[array_search($_SESSION['perfiles_id'], $perfiles)];
    if ($in['view'] == '1') $campos[$i]['permiso'] = 'r';
    $row_str = '';
    if ($campos[$i]['permiso'] != 'h') {
        $row_str .= '<div class="row fields">';
        if ($campos[$i]['grupo'] == '' && $campos[$i]['grupo_etiqueta'] == '') {
            $row_str .= '<div class="small-2 columns"><label class="">';
            $row_str .= utf8_encode($campos[$i]['etiqueta']) . ':';
            $row_str .= '</label></div>';
            $row_str .= '<div class="small-10 columns">';
            if ($in['venta_id'] != '0') {
                $row_str .= $venta->imprimirCampo($dato[$campos[$i]['nombre']], $campos[$i], $in['campania']);
            } else {
                $row_str .= $venta->imprimirCampo('', $campos[$i], $in['campania']);
            }        
            $row_str .= '</div>'; 
        } else {
            $row_str .= '<div class="small-2 columns"><label class="">';
            $row_str .= utf8_encode($campos[$i]['grupo_etiqueta']) . ':';
            $row_str .= '</label></div>';
            $row_str .= '<div class="small-10 columns"><div class="callout primary">';
            for ($j=$i; $campos[$i]['grupo'] == $campos[$j]['grupo']; $j++) {
                $perfiles = explode(', ', trim($campos[$j]['perfiles']));
                $permisos = explode(', ', trim($campos[$j]['permisos']));
                $campos[$j]['permiso'] = $permisos[array_search($_SESSION['perfiles_id'], $perfiles)];
                if ($in['view'] == '1') $campos[$j]['permiso'] = 'r';
                if ($campos[$j]['permiso'] != 'h') {
                    $row_str .= '<div class="row">';
                    $row_str .= '<div class="small-3 columns"><label class="">';
                    $row_str .= utf8_encode($campos[$j]['etiqueta']) . ':';
                    $row_str .= '</label></div>';
                    $row_str .= '<div class="small-9 columns">';
                    if ($in['venta_id'] != '0') {
                        $row_str .= $venta->imprimirCampo($dato[$campos[$j]['nombre']], $campos[$j], $in['campania']);
                    } else {
                        $row_str .= $venta->imprimirCampo('', $campos[$j], $in['campania']);
                    }
                    $row_str .= '</div>'; 
                    $row_str .= '</div>';
                }
            }
            $i = $j - 1;
            $row_str .= '</div></div>';
        }
        $row_str .= '</div>';
    }
    $pestanias_str [$campos[$i]['pestana']] .= $row_str;
}

echo '<div class="venta-listado-view" id="venta-listado-view-0">' . current($pestanias_str) . '</div>';
$i= 1;
while ($row = next($pestanias_str)) {
    echo '<div class="venta-listado-view" id="venta-listado-view-' . $i++ . '" style="display:none">' . $row . '</div>';
}
// guardar
if ($in['view'] == '0')
    echo '<div class="row fields">
         <div class="small-12 columns text-right">
           <a class="button no-margin save-continue" >Guardar</a>
           <a class="button success no-margin save-exit" data-close>Guardar y Cerrar</a>
         </div>
      </div>
     ';
// pestañas
echo '<div class="row fields"><div class="small-12 columns">';
echo '<hr>';
$total = count($pestanias);
echo '<ul class="breadcrumbs">';
echo '<li><a href="#" pestania="0">' . $pestanias[0]['pestania'] . '</a></li>';
$pestanias_str[$pestanias[0]['pestania']] = $pestanias[0]['pestania'];
for ($i=1; $i < $total; $i++) {
    echo '<li><a href="#" pestania="' . $i . '">' . $pestanias[$i]['pestania'] . '</a></li>';
}
echo '</ul>';
echo '</div></div>';

echo '
<script src="../../static/ventas/ventas_datapicker.js"></script>
<script src="../../static/ventas/ventas_view.js"></script>
';

