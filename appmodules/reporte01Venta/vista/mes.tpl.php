<?php
$title = 'Reporte Ventas Mes';
$prefix = 'venta_reporte_mes_';
?>

<?php ob_start() ?>
<link rel="stylesheet" href="../../lib/vendor/foundation-datepicker/css/foundation-datepicker.min.css">
<?php $css = ob_get_clean() ?>


<?php ob_start() ?>
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/data.js"></script>
<script src="https://code.highcharts.com/modules/drilldown.js"></script>

<script src="../../lib/vendor/foundation-datepicker/js/foundation-datepicker.min.js"></script>
<script src="../../lib/vendor/foundation-datepicker/js/locales/foundation-datepicker.es.js"></script>
<!-- <script src="../../static/reporte01Venta/reporte01Venta_datapicker.js"></script> -->

<script type="text/javascript">
 $(function () {
     $('.datapicker-month input').fdatepicker({
         format: 'yyyy-mm',
         language: 'es',
         startView: 3,
         minView: 3,
     });
     <?php
     if (isset($data)) {
         foreach($data as $key => $row)
         {
             $js = '
$("#pai-' . $key . '").highcharts({';
             $js.= 'chart: { type: "pie" },';
             $js.= 'title: { text: "' . utf8_encode($row['titulo']) . '" },';
             $js.= '
         plotOptions: {
             series: {
                 dataLabels: {
                     enabled: true,
                     format: "<span style=\'color:{point.color}\'>{point.name}</span>: {point.y}"
                 }
             }
         },
         tooltip: {
             headerFormat: "<span style=\'font-size:11px\'>{series.name}</span><br>",
             pointFormat:  "<span style=\'color:{point.color}\'>{point.name}</span>: <b>{point.y}</b><br/>"
         },
         series: [{
             name: "Estado",
             colorByPoint: true,
             data: [';
             if (isset($row['estado'])) {
                 $t = 0;
                 foreach($row['estado'] as $r) {
                     $t += $r['y'];
                 }
                 foreach($row['estado'] as $r)
                 {
                     $js.= '{';
                     $js.= ' name: "' . utf8_encode($r['name']) . '(' . round($r['y']/$t*100,2) . '%)' . '", ';
                     $js.= ' y: ' . $r['y'] . ', ';
                     if ($r['drilldown'] != '')
                         $js.= 'drilldown: "' . utf8_encode($r['drilldown']) . '"';
                     $js.= '}, ';
                     // break;
                 }
             }             
             $js.= '
             ]
         }],
         drilldown: {
             series: [';
             if (isset($row['estado_real'])) {
                 foreach($row['estado_real'] as $kk => $rr)
                 {                 
                     $js.= '
                 {
                 name: "' . utf8_encode($kk) . '",
                 id: "' . utf8_encode($kk) . '",
                 data: [';
                     $t = 0;
                     foreach($rr as $r) {
                         $t += $r['y'];
                     }     
                     foreach($rr as $r)
                     {
                         $js.= '[';
                         $js.= '"' . utf8_encode($r['name']) . '(' . round($r['y']/$t*100,2) . '%)' . '", ';
                         $js.= ''  . utf8_encode($r['y']) . ', ';
                         $js.= '], ';
                         // break;
                     }
                     
                     $js.= ']},';
                 }
             }             
             $js.=']}';         
             $js.= '});';
             echo $js;         
         }
     }

     ?>
 });
</script>
<?php $js = ob_get_clean() ?>

<?php ob_start() ?>
<?php include '../autentificacion/vista/url.php' ?>
<?php include '../autentificacion/vista/menu.tpl.php' ?>

<form action="index.php">
  <div class="row">
    <div class="large-6 medium-8 columns">
      <div class="row">
        <div class="large-9 medium-8 columns">
          <div class="input-group datapicker-month no-margin">
            <input name="anio-mes" type="text" readonly="" class="no-margin" value="<?php echo $in['anio-mes'] ?>" >
            <a class="input-group-label" title="Limpiar"><i class="fi-calendar size-24"></i></a>
          </div>
        </div>
        <div class="large-3 medium-4 columns">
          <button type="submit" class="button no-margin expanded success">Ver</button>
        </div>
      </div>    
    </div>
  </div>  
</form>


<?php if (isset($data)):  ?>
<div class="row collapse">
  <div class="large-2 medium-3 small-3 columns">
    <ul class="tabs vertical" id="vert-tabs" data-tabs>
      <?php
      $first = true;
      foreach($data as $key => $row)
      {
          if ($first)
          {
              $first = false;
              echo '<li class="tabs-title is-active"><a href="#panel-' . $key . '" aria-selected="true">' . $row['tab'] . '</a></li>';
          } else
          {
              echo '<li class="tabs-title"><a href="#panel-' . $key . '">' . $row['tab'] . '</a></li>';          
          }          
      }
      ?>
    </ul>
  </div>
  <div class="large-10 medium-9 small-9 columns">
    <div class="tabs-content vertical" data-tabs-content="vert-tabs">
      <?php

      $first = true;
      foreach($data as $key => $row)
      {
          if ($first)
          {
              // $first = false;
              echo '<div class="tabs-panel is-active" id="panel-' . $key . '">';
          } else
          {
              echo '<div class="tabs-panel" id="panel-' . $key . '">';
          }
          echo '<div id="pai-' . $key . '" style=""></div>';
          echo '</div>';
      }
      ?>
    </div>
  </div>
</div>

<?php endif ?>

<?php $content = ob_get_clean() ?>

<?php include '../autentificacion/vista/layout.tpl.php' ?>
