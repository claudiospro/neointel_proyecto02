<?php
include "../../../../../lib/mysql/dbconnector.php";
include "../../../../../lib/mysql/conexion01.php";
include "../../../../../lib/mysql/utilidades.php";
include "../../../modelo/ModeloVenta.php";

$venta = new ModeloVenta();
// -------------------------------------------------------- INPUT
$in['campania'] = Utilidades::clear_input(Utilidades::sanear_string($_POST['campania']));
$in['venta_id'] = Utilidades::clear_input_id($_POST['venta_id']);
// -------------------------------------------------------- Data
$campos = $venta->getcampos($in);
$in['fields']['id'] = '';
foreach ($campos as $r) {
    $in['fields'][$r['nombre']] = '';
}

$dato = $venta->getUnDato($in);

// -------------------------------------------------------- TEST
// Utilidades::printr($in);
session_start();
// Utilidades::printr($_SESSION);
// Utilidades::printr($campos);
// Utilidades::printr($dato);
// -------------------------------------------------------- OUT
$total = count($campos);
for ($i=0; $i < $total; $i++) {
    echo '<div class="row fields">';
    if ($campos[$i]['grupo'] == '' && $campos[$i]['grupo_etiqueta'] == '') {
        echo '<div class="small-2 columns"><label class="">';
        echo utf8_encode($campos[$i]['etiqueta']) . ':';
        echo '</label></div>';
        echo '<div class="small-10 columns">';
        echo $venta->imprimirCampo($dato[$campos[$i]['nombre']], $campos[$i], $in['campania']);
        echo '</div>'; 
    } else {
        echo '<div class="small-2 columns"><label class="">';
        echo utf8_encode($campos[$i]['grupo_etiqueta']) . ':';
        echo '</label></div>';
        echo '<div class="small-10 columns"><div class="callout primary">';
        for ($j=$i; $campos[$i]['grupo'] == $campos[$j]['grupo']; $j++) {
            echo '<div class="row">';
            echo '<div class="small-2 columns"><label class="">';
            echo utf8_encode($campos[$j]['etiqueta']) . ':';
            echo '</label></div>';
            echo '<div class="small-10 columns">';
            echo $venta->imprimirCampo($dato[$campos[$j]['nombre']], $campos[$j], $in['campania']);
            echo '</div>'; 
            echo '</div>';
        }
        $i = $j - 1;
        echo '</div></div>';
    }
    echo '</div>';
}
echo '

<script src="../../lib/vendor/foundation-datepicker/js/foundation-datepicker.min.js"></script>
<script src="../../lib/vendor/foundation-datepicker/js/locales/foundation-datepicker.es.js"></script>
<script src="../../static/ventas/ventas_datapicker.js"></script>

<script src="../../lib/vendor/jquery-ui-1.11.4.custom/jquery-ui.min.js"></script>
<script>
$(".autocomplete").focus(function() {
   var my_url = "./procesos/ajax/autocomplete/ventas_listado_view_autocomplete.php?campo=" + $(this).attr("campo");
   $(this).autocomplete({
     source: my_url,
     search: function( event, ui ) {             
        $(this).removeClass("active");
     },
     select: function( event, ui ) {            
        $(this).val(ui.item.label).addClass("active");
        return false;
     }
   });
});

</script>
';

