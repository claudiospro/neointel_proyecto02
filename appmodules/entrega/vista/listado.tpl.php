<?php
$title = 'Entregas';
$prefix = 'entrega_listado_';
?>

<?php ob_start() ?>
<link rel="stylesheet" href="../../lib/vendor/datatable-1.10.10/DataTables-1.10.10/css/dataTables.foundation.min.css">
<link rel="stylesheet" href="../../lib/vendor/jquery-ui-1.11.4.custom/jquery-ui.min.css">
<link rel="stylesheet" href="../../lib/vendor/foundation-datepicker/css/foundation-datepicker.min.css">
<link rel="stylesheet" href="../../lib/main/editable.css?v=1.5.0">
<!-- <link rel="stylesheet" href="../../lib/vendor/zclip/style.css"> -->

<?php $css = ob_get_clean() ?>


<?php ob_start() ?>
<script src="../../lib/vendor/datatable-1.10.10/datatables.min.js"></script>
<script src="../../lib/vendor/datatable-1.10.10/DataTables-1.10.10/js/dataTables.foundation.min.js"></script>

<script src="../../lib/vendor/foundation-datepicker/js/foundation-datepicker.min.js"></script>
<script src="../../lib/vendor/foundation-datepicker/js/locales/foundation-datepicker.es.js"></script>
<script src="../../static/entrega/entrega_datapicker.js"></script>

<script src="../../lib/vendor/jquery-ui-1.11.4.custom/jquery-ui.min.js"></script>

<script src="../../static/entrega/entrega_listado.js?v=1.0.0"></script>
<script src="../../static/entrega/entrega_editable_inline.js?v=1.0.0"></script>
<?php $js = ob_get_clean() ?>


<?php ob_start() ?>

<?php
include '../autentificacion/vista/url.php';
include '../autentificacion/vista/menu.tpl.php';
// print_r($_SESSION);
?>

<input type="hidden" id="<?php echo $prefix . 'perfiles' ?>" value="<?php echo trim($_SESSION['perfiles']) ?>">

<div class="row">
  <div class="large-3 medium-4 small-8 columns">
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
  <div class="large-1 medium-1 small-2 columns text-right">
  </div>
</div>

<table id="<?php echo $prefix . 'tabla' ?>">
  <?php include './vista/tabla_' . $in['campania'] . '.tpl.php'  ?>
</table>
<?php $content = ob_get_clean() ?>

<?php include '../autentificacion/vista/layout.tpl.php' ?>
