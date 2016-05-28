<?php
$title = 'Reporte Ventas Mes';
$prefix = 'venta_reporte_mes_';
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
 $(function () {
     $('.datapicker-month input').fdatepicker({
         format: 'yyyy-mm',
         language: 'es',
         startView: 3,
         minView: 3,
     });
     <?php
     $color['estado'][1] = '#f9ff9d';
     $color['estado'][2] = '#3add53';
     $color['estado'][3] = '#ff9d9d';

     $color['estado_real'][1]  = '#c9ee70';
     $color['estado_real'][2]  = '#f9ff9d';
     $color['estado_real'][3]  = '#3add53';
     $color['estado_real'][4]  = '#57c5f8';
     $color['estado_real'][5]  = '#ff9d9d';
     $color['estado_real'][6]  = '#76a2ff';
     $color['estado_real'][7]  = '#ffe78b';
     $color['estado_real'][8]  = '#fed9d9';
     $color['estado_real'][9]  = '#cdcdcd';
     $color['estado_real'][12] = '#ffd0d0';
     $color['estado_real'][13] = '#ffbbbb';
     $color['estado_real'][14] = '#ffb3b3';
     $color['estado_real'][15] = '#ffa9a9';
     $color['estado_real'][16] = '#ff9a9a';
     $color['estado_real'][17] = '#fe8d8d';
     $color['estado_real'][18] = '#638add';
     
     $color['estado_real'][19] = '#638add';
     $color['estado_real'][20] = '#638add';
     $color['estado_real'][21] = 'black';
     $color['estado_real'][22] = 'black';
     $color['estado_real'][23] = 'black';
     $color['estado_real'][24] = 'black';
     $color['estado_real'][25] = 'black';
     $color['estado_real'][26] = 'black';
     $color['estado_real'][27] = 'black';
     $color['estado_real'][28] = 'black';
     $color['estado_real'][29] = 'black';
     $color['estado_real'][30] = 'black';
     
     if (isset($data)) {
         foreach($data as $key => $row)
         {
             $js = '$("#pai-' . $key . '").highcharts({';
             $js.= 'chart: { type: "pie" },';
             $js.= 'title: { text: "" },';
             $js.= '
         plotOptions: {
             series: {
                 dataLabels: {
                     enabled: true,
                     format: "<span>{point.name}</span> => {point.y} %"
                 }
             }
         },
         tooltip: {
             headerFormat: "<span style=\'font-size:11px\'>{series.name}</span><br>",
             pointFormat:  "<span>{point.name}</span> => <b>{point.y} % </b>"
         },
         series: [{
             name: "Estado",
             colorByPoint: true,
             data: [';
             if (isset($row['estado'])) {
                 $t = 0;
                 foreach($row['estado'] as $r)
                 {
                     $t += $r['y'];
                 }
                 foreach($row['estado'] as $k => $r)
                 {
                     $js.= '{';
                     $js.= ' name: "' . utf8_encode($r['name']) . ' (' . $r['y'] . '/' . $t . ')' . '", ';
                     $js.= ' y: ' . round($r['y']/$t*100,2) . ', ';
                     $js.= " color: '" . $color['estado'][$k] . "', ";
                     if ($r['drilldown'] != '')
                         $js.= 'drilldown: "' . utf8_encode($r['drilldown']) . '"';
                     $js.= '}, ';
                     // break;
                 }
             }
             if (isset($row['cliente_tipo'])) {
                 $t = 0;
                 foreach($row['cliente_tipo'] as $r)
                 {
                     $t += $r['y'];
                 }
                 foreach($row['cliente_tipo'] as $r)
                 {
                     $js.= '{';
                     $js.= ' name: "' . utf8_encode($r['name']) . ' (' . $r['y'] . '/' . $t . ')' . '", ';
                     $js.= ' y: ' . round($r['y']/$t*100,2) . ', ';
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
                     foreach($rr as $k => $r)
                     {
                         $js.= '{';
                         $js.= ' name: "' . utf8_encode($r['name']) . ' (' . $r['y'] . '/' . $t . ')' . '", ';
                         $js.= ' y: ' . round($r['y']/$t*100,2) . ', ';
                         $js.= " color: '" . $color['estado_real'][$k] . "', ";
                         $js.= '}, ';
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
<?php
// Utilidades::printr($_SESSION);
?>

<form action="index.php">
  <div class="row">
    <div class="large-3 medium-5 small-12 columns">
      <select name="campania_id" id="campania_id" class="no-margin">
        <option value="<?php echo $in['campania_id']  ?>"></option>
      </select>
    </div>
    <div class="large-3 medium-5 small-9 columns">
      <select name="tipo" class="no-margin">
        <?php
        $ll = array('1'=> 'Estados', '2'=>'Tipo Cliente');
        for($i = 1; $i<=2; $i++)
        {
            $selected = '';
            if ($i === (int)$in['tipo'])
            {
                $selected = 'selected';
            }
            printf('<option value="%\'.02d" ' . $selected . '>%s</option>'
                 , $i, $ll[$i]
            );
        }
        ?>
      </select>
    </div>
    <div class="large-1 medium-2 small-3 columns">
      <button type="submit" class="button no-margin expanded success">Ver</button>
    </div>
    <div class="large-1 medium-1 small-0 columns"></div>
  </div>  
  <div class="row">
    <div class="large-6 medium-6 small-12 columns">
      <div class="row">
        <div class="large-4  medium-2  small-2  columns">
          Inicio
        </div>
        <div class="large-6  medium-7  small-7  columns">
          <div class="input-group datapicker-month no-margin">
            <input type="text" id="anio-mes-ini" name="anio-mes-ini" readonly="" class="no-margin" value="<?php echo $in['anio-mes-ini'] ?>" >
            <a class="input-group-label" title="Limpiar"><i class="fi-calendar size-24"></i></a>
          </div>
        </div>
        <div class="large-2  medium-3  small-3  columns">
          <select id="dia-ini" name="dia-ini" class="no-margin">
            <option value="00"></option>
            <?php
            for($i = 1; $i<=31; $i++)
            {
                $selected = '';
                if ($i === (int)$in['dia-ini'])
                {
                    $selected = 'selected';
                }
                printf('<option value="%\'.02d" ' . $selected . '>%\'.02d</option>'
                     , $i, $i
                );
            }            
            ?>
          </select>
        </div>
      </div>
      <div class="row">
        <div class="large-4  medium-2  small-2  columns">
          Fin
        </div>
        <div class="large-6  medium-7  small-7  columns">
          <div class="input-group datapicker-month no-margin">
            <input type="text" id="anio-mes-end" name="anio-mes-end" readonly="" class="no-margin" value="<?php echo $in['anio-mes-end'] ?>" >
            <a class="input-group-label" title="Limpiar"><i class="fi-calendar size-24"></i></a>
          </div>
        </div>
        <div class="large-2  medium-3  small-3  columns">
          <select id="dia-end" name="dia-end" class="no-margin">
            <option value="00"></option>
            <?php
            for($i = 1; $i<=31; $i++)
            {
                $selected = '';
                if ($i === (int)$in['dia-end'])
                {
                    $selected = 'selected';
                }
                printf('<option value="%\'.02d" ' . $selected . '>%\'.02d</option>'
                     , $i, $i
                );
            }            
            ?>
          </select>
        </div> 
      </div>
    </div>
    <div class="large-6 medium-6 small-12 columns">
      <?php if( 'Supervisor' != trim($_SESSION['perfiles'])): ?>
        <div class="row">
          <div class="large-3  medium-2  small-2  columns">
            Supervisor
          </div>
          <div class="large-9  medium-10  small-10  columns">
            <div id="supervisor"></div>
            <select id="supervisor_id" name="supervisor_id" class="no-margin">
              <option value="<?php echo $in['supervisor_id']  ?>"></option>
            </select>
          </div>
        </div>
      <?php else: ?>
        <input type="hidden" id="supervisor_id" name="supervisor_id" value="<?php echo $_SESSION['user_id'] ?>">
      <?php endif ?>
      <div class="row">
        <div class="large-3  medium-2  small-2  columns">
          Asesor
        </div>
        <div class="large-9  medium-10  small-10  columns">
          <div id="asesor_comercial"></div>
          <select id="asesor_comercial_id" name="asesor_comercial_id" class="no-margin">            
            <option value="<?php echo $in['asesor_comercial_id']  ?>"></option>
          </select>
        </div>
      </div>
    </div>
  </div>
</form>

<?php if (isset($data)):  ?>
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
