<?php
$title = 'Modal';
$prefix = 'test_modal_';
?>

<?php ob_start() ?>
<link rel="stylesheet" href="../../lib/vendor/foundation-datepicker/css/foundation-datepicker.min.css">
<?php $css = ob_get_clean() ?>


<?php ob_start() ?>
<script src="../../lib/vendor/foundation-datepicker/js/foundation-datepicker.min.js"></script>
<script src="../../lib/vendor/foundation-datepicker/js/locales/foundation-datepicker.es.js"></script>
<script src="../../static/ventas/ventas_datapicker.js"></script>
<?php $js = ob_get_clean() ?>


<?php ob_start() ?>
<div class="input-group datapicker-simple">
  <input type="text" readonly="" class="no-margin">
  <a class="input-group-label" title="Limpiar"><i class="fi-calendar size-24"></i></a>
</div>
<?php $content = ob_get_clean() ?>

<?php include '../autentificacion/vista/layout.tpl.php' ?>
