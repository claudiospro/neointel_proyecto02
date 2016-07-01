<?php
$title = 'Ventas Listado';
$prefix = 'venta_listado_';
?>

<?php ob_start() ?>
<link rel="stylesheet" href="../../lib/vendor/datatable-1.10.10/DataTables-1.10.10/css/dataTables.foundation.min.css">

<link rel="stylesheet" href="../../lib/vendor/jquery-ui-1.11.4.custom/jquery-ui.min.css">

<link rel="stylesheet" href="../../lib/vendor/foundation-datepicker/css/foundation-datepicker.min.css">
<link rel="stylesheet" href="../../lib/main/editable.css?v=1.5.1">
<!-- <link rel="stylesheet" href="../../lib/vendor/zclip/style.css"> -->

<?php $css = ob_get_clean() ?>


<?php ob_start() ?>
<script src="../../lib/vendor/datatable-1.10.10/datatables.min.js"></script>
<script src="../../lib/vendor/datatable-1.10.10/DataTables-1.10.10/js/dataTables.foundation.min.js"></script>

<script src="../../lib/vendor/foundation-datepicker/js/foundation-datepicker.min.js"></script>
<script src="../../lib/vendor/foundation-datepicker/js/locales/foundation-datepicker.es.js"></script>
<script src="../../static/ventas/ventas_datapicker.js"></script>

<script src="../../lib/vendor/jquery-ui-1.11.4.custom/jquery-ui.min.js"></script>

<!-- <script src="../../lib/main/sesion.js?v=1.1.0"></script> -->

<!-- <script type="text/javascript" src="../../lib/vendor/zclip/jquery.zclip.js"></script> -->

<script src="../../static/ventas/ventas_listado2.js?v=1.5.1"></script>
<script src="../../static/ventas/ventas_editable_inline.js?v=1.0.6"></script>

<script src="../../static/ventas/ventas_timer_estructura.js?v=1.0.3"></script>
<script src="../../static/ventas/ventas_timer_por_aprobar.js?v=1.0.3"></script>

<script src="../../static/ventas/ventas_declarativo_03.js?v=1.0.0"></script>
<?php $js = ob_get_clean() ?>


<?php ob_start() ?>

<?php
    include '../autentificacion/vista/url.php';
include '../autentificacion/vista/menu.tpl.php';
// print_r($_SESSION);
?>

<input type="hidden" id="<?php echo $prefix . 'perfiles' ?>" value="<?php echo trim($_SESSION['perfiles']) ?>">

<?php include './vista/timer-estructura.tpl.php' ?>

<!-- --------------------------------------------------------------------------- -->

<div class="row">
  <div class="large-12 columns">
    <div class="timer-por-aprobar" style="display:none">
      Ventas por Aprobar
      <span class="ajax">
      </span>
    </div>
  </div>
</div>

<div class="reveal"
     id="<?php echo $prefix ?>modal_por_aprobar"
     style="background-color: rgb(242, 216, 177); height:550px"
     data-reveal>
  <div class="row">
    <div class="large-12 columns">
      <div class="ajax">
      </div>      
    </div>
  </div>
  <button class="close-button" data-close aria-label="Close modal" type="button">
    <span aria-hidden="true">&times;</span>
  </button>
</div>

<!-- --------------------------------------------------------------------------- -->

<div class="row">
  <div class="large-3 medium-4 small-8 columns">
    <div class="input-group no-margin">
      <?php if(trim($_SESSION['perfiles']) == 'Asesor Comercial' || trim($_SESSION['perfiles']) == 'Supervisor'): ?>
        <a id="<?php echo $prefix ?>add"
           class="button success no-margin input-group-label"
           data-open="venta_listado_modal_div"
           title="Añadir">
          <i class="fi-plus"></i>
        </a>
      <?php endif ?>
      <select class="no-margin" id="<?php echo $prefix ?>campanias">
        <?php
        foreach($in['campanias'] as $row)
        {
            $selected = '';
            if ($row['id'] == $in['campania'])
            {
                $selected = 'selected';
            }
            echo '<option value="' . $row['id'] . '" ' . $selected . '>' . utf8_decode($row['nombre']) . '</option>';
        }
        ?>
      </select>
    </div>      
  </div>
  <div class="large-1 medium-1 small-2 columns text-right">
  </div>
</div>


<div class="reveal full" id="<?php echo $prefix ?>modal_div" data-reveal style="background-color: rgb(242, 216, 177)">
  <div class="ajax">
  </div>
  <button class="close-button" data-close aria-label="Close modal" type="button">
    <span aria-hidden="true">&times;</span>
  </button>
</div>

<?php
include './vista/declarativo.tpl.php';
include './vista/colores.tpl.php';
include './vista/tabla_' . $in['campania'] . '.tpl.php';
?>

<?php $content = ob_get_clean() ?>

<?php include '../autentificacion/vista/layout.tpl.php' ?>
