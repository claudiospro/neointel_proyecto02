<?php $title = 'Ventas' ?>

<?php ob_start() ?>
<link rel="stylesheet" href="../../lib/vendor/foundation-datepicker/css/foundation-datepicker.min.css">
<?php $css = ob_get_clean() ?>


<?php ob_start() ?>
<script src="../../lib/vendor/foundation-datepicker/js/foundation-datepicker.min.js"></script>
<script src="../../lib/vendor/foundation-datepicker/js/locales/foundation-datepicker.es.js"></script>
<script>
 $('.datapicker-simple').fdatepicker({
     format: 'dd-mm-yyyy'
     , language: 'es'
     , weekStart: 1
 });
</script>
<?php $js = ob_get_clean() ?>


<?php ob_start() ?>
<?php include '../autentificacion/vista/menu.tpl.php' ?>
<?php $content = ob_get_clean() ?>

<?php include '../autentificacion/vista/layout.tpl.php' ?>
