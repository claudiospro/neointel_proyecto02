<?php
$title = 'Reporte Ventas Mes';
$prefix = 'venta_reporte_mes_';
include './vista/colores.php';
?>

<?php ob_start() ?>
<link rel="stylesheet" href="../../lib/vendor/foundation-datepicker/css/foundation-datepicker.min.css">
<?php $css = ob_get_clean() ?>


<?php ob_start() ?>
<script src="../../lib/vendor/highcharts/js/highcharts.js"></script>
<script src="../../lib/vendor/highcharts/js/modules/data.js"></script>
<script src="../../lib/vendor/highcharts/js/modules/drilldown.js"></script>

<script src="../../lib/vendor/foundation-datepicker/js/foundation-datepicker.min.js"></script>
<script src="../../lib/vendor/foundation-datepicker/js/locales/foundation-datepicker.es.js"></script>
<script src="../../static/reporte01Venta/reporte01Venta_listado.js?v=1.0.3"></script>
<script type="text/javascript">
 $('.datapicker-month input').fdatepicker({
     format: 'yyyy-mm',
     language: 'es',
     startView: 3,
     minView: 3,
 });
</script>
<?php include './vista/js_'. $in['tipo'] . '.tpl.php' ?>


<?php $js = ob_get_clean() ?>

<?php
    ob_start() ;
include '../autentificacion/vista/url.php';
include '../autentificacion/vista/menu.tpl.php';

// Utilidades::printr($_SESSION);
include './vista/form.tpl.php';
?>


<?php if (isset($data)): ?>
<div class="row collapse">
  <div class="large-12 medium-12 small-12 columns">
    <?php
    $first = true;
    foreach($data as $key => $row)
    {
        echo '<div class="tabs-panel is-active" id="panel-' . $key . '">';
        echo '<div id="pai-' . $key . '" style=""></div>';
        echo '</div>';
    }
    ?>
  </div>
</div>

<?php endif ?>
<?php $content = ob_get_clean() ?>
<?php include '../autentificacion/vista/layout.tpl.php' ?>
