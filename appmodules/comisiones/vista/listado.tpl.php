<?php
$title = 'Comisiones Listados';
$prefix = 'comisiones_listado_';

?>


<?php ob_start() ?>
<!-- <link rel="stylesheet" href="../../lib/vendor/"> -->
<link rel="stylesheet" href="../../lib/vendor/foundation-datepicker/css/foundation-datepicker.min.css">
<style>
 .tablas-comisiones table {
     float: left;
     margin: 0 0 0 1em;
 }
 .tablas-comisiones table  th,
 .tablas-comisiones table  td
 {
     border: 1px solid;
     text-align: center;
 }
 .tablas-comisiones tbody tr:nth-child(2n)  {
     background-color: transparent;
 }
 .tablas-comisiones thead th,
 .tablas-comisiones tbody th
 {
     background-color: #ffe9be;
 }
 .item-asesor-venta {
     border:  1px solid #dedede;
     padding: 0 0 1em 0;
     margin:  0 0 1em 0;
 }
 .item-asesor-venta  h4 {
     background-color: #dedede;
 }
</style>
<?php $css = ob_get_clean() ?>


<?php ob_start() ?>
<script src="../../lib/vendor/foundation-datepicker/js/foundation-datepicker.min.js"></script>
<script src="../../lib/vendor/foundation-datepicker/js/locales/foundation-datepicker.es.js"></script>
<!-- <script src="../../lib/vendor/"></script> -->

<script src="../../static/comisiones/comisiones_listado.js?v=1.0.0"></script>
<script type="text/javascript">
 $('.datapicker-month input').fdatepicker({
     format: 'yyyy-mm',
     language: 'es',
     startView: 3,
     minView: 3,
 });
</script>
<?php $js = ob_get_clean() ?>


<?php 
ob_start();
include '../autentificacion/vista/url.php';
include '../autentificacion/vista/menu.tpl.php';
?>

<form type="GET">
  <div class="row">
    <div class="large-3  medium-4  small-6  columns">
      <select id="campania_id"
              name="campania_id"
              class="no-margin"
      >
        <option value="<?php echo $in['campania_id']  ?>"></option>
      </select>
    </div>
    <div class="large-2  medium-3  small-6  columns">
      <div class="input-group datapicker-month no-margin">
        <input id="anio-mes"
               name="anio-mes"
               type="text"
               readonly=""
               class="no-margin"
               value="<?php echo $in['anio-mes'] ?>"
        >
        <a class="input-group-label" title="">
          <i class="fi-calendar size-24"></i>
        </a>
      </div>
    </div>
    <div class="large-1  medium-2  small-3 columns">
      <button class="button no-margin">Buscar</button>
    </div>
    <div class="large-1  medium-1  small-1 columns">
    </div>
  </div>
</form>
<div class="row">
  <div class="large-12  medium-12  small-12  columns">
    <?php if ( isset($ou) ): ?>
      <?php if(
          $in['campania_info']['indice'] == 'campania_001' &&
          'Vodafone One' == trim($in['campania_info']['nombre'])
      ): ?>
        <ul class="tabs" data-tabs id="example-tabs">
          <li class="tabs-title is-active"><a href="#panel1" aria-selected="true">Total</a></li>
          <li class="tabs-title"><a href="#panel2">Supervisores</a></li>
          <li class="tabs-title"><a href="#panel3">Aserores de Ventas</a></li>
        </ul>
        <div class="tabs-content" data-tabs-content="example-tabs">
          <div class="tabs-panel is-active" id="panel1">
            <?php $modelo->campania_001_Vodafon_one_imprimir($ou['fibra']['total'], $ou['movil']['total']) ?>
          </div>
          <div class="tabs-panel" id="panel2">

            <div class="row collapse">
              <div class="medium-2 columns">
                <ul class="tabs vertical" id="supervisores-vert-tabs" data-tabs>
                  <?php
                  $first = true;
                  $i = 0;
                  foreach($ou['fibra']['supervisor'] as $name => $r) {
                      $i++;
                      $is_active = '';
                      $aria_selected = '';
                      if ($first) {
                          $is_active = 'is-active';
                          $aria_selected = 'aria-selected="true"';
                          $first = false;
                      }
                      echo '<li class="tabs-title ' .$is_active . '">
                             <a href="#panel_supervisores_' . $i . '"
                              ' . $aria_selected . ' >' . utf8_encode(strtoupper($name)) . '
                             </a>
                            </li>';
                  }
                  ?>
                </ul>
              </div>
              <div class="medium-10 columns">
                <div class="tabs-content vertical" data-tabs-content="supervisores-vert-tabs">
                  <?php
                  $first = true;
                  $i = 0;
                  foreach($ou['fibra']['supervisor'] as $name => $r) {
                      $i++;
                      $is_active = '';
                      if ($first) {
                          $is_active = 'is-active';
                          $first = false;
                      }
                      echo '<div class="tabs-panel ' . $is_active . '" id="panel_supervisores_' . $i . '">';
                      $modelo->campania_001_Vodafon_one_imprimir($ou['fibra']['supervisor'][$name], $ou['movil']['supervisor'][$name]);
                      echo '</div>';
                  }
                  ?>
                </div>
              </div>              
            </div>
            
          </div>
          <div class="tabs-panel" id="panel3">

            <?php
            $i = 0;
            echo '<ul class="accordion" data-accordion role="tablist">';
            foreach($ou['fibra']['asesor_venta'] as $name => $r) {
                echo '<li class="accordion-item">';
                $i++;
                echo '
                <a href="#panel_asesor_venta_' . $i . '"
                   role="tab"
                   class="accordion-title"
                   id="panel_heading_asesor_venta_' . $i . '"
                   aria-controls="panel1d">
                  ' . utf8_encode($name) . '
                </a>
                <div id="panel_asesor_venta_' . $i . '"
                     class="accordion-content"
                     role="tabpanel"
                     data-tab-content
                     aria-labelledby="panel_heading_asesor_venta_' . $i . '">
                ';
                
                if (!isset($ou['fibra']['asesor_venta'][$name]))
                    $ou['fibra']['asesor_venta'][$name] = array();
                if (!isset($ou['movil']['asesor_venta'][$name]))
                    $ou['movil']['asesor_venta'][$name] = array();                      
                $modelo->campania_001_Vodafon_one_imprimir(
                    $ou['fibra']['asesor_venta'][$name]
                  , $ou['movil']['asesor_venta'][$name]
                );
                echo ' </div>';
                echo '</li>';
            }
            echo '</ul>';
            ?>
          </div>
        </div>
      <?php endif ?>
    <?php endif ?>
  </div>
</div>

<?php $content = ob_get_clean() ?>


<?php include '../autentificacion/vista/layout.tpl.php' ?>
