<?php
$title = 'Modal';
$prefix = 'test_modal_';
?>

<?php ob_start() ?>
<link rel="stylesheet" href="../../lib/vendor/foundation-datepicker/css/foundation-datepicker.min.css">
<style>
 .button.datepicker-close{
     width: 30px !important;
     line-height: 30px;
 }
</style>
<?php $css = ob_get_clean() ?>


<?php ob_start() ?>
<script src="../../lib/vendor/foundation-datepicker/js/foundation-datepicker.min.js"></script>
<script src="../../lib/vendor/foundation-datepicker/js/locales/foundation-datepicker.es.js"></script>
<script>
 $('.datapicker-simple input').fdatepicker({
     format: 'yyyy-mm-dd'
     , language: 'es'
     , weekStart: 1
 });
 $('.datapicker-simple').on('click', 'a', function (event) {
     $(this).parent().find('input').val('');
 });
 var checkin = $('.datapicker-simple-1 input').fdatepicker({
     format: 'yyyy-mm'
     , weekStart: 1
     , language: 'es'
     , startView: 3
     , minView: 3

 });
 console.log(checkin);
 $('.datapicker-simple-2').fdatepicker({
     format: 'dd'
     , weekStart: 1
     , language: 'es'
     , startView: 2
     , minView: 2
     , onRender: function (date) {
	 // return date.valueOf() < checkin.date.valueOf() ? 'disabled' : '';
         console.log(date);
     }
 });
</script>
<?php $js = ob_get_clean() ?>


<?php ob_start() ?>
<div class="input-group datapicker-simple">
  <input type="text" readonly="" class="no-margin">
  <a class="input-group-label" title="Limpiar"><i class="fi-calendar size-24"></i></a>
</div>
<hr>
<div class="input-group datapicker-simple-1">
  <input type="text" readonly="" class="no-margin">
  <a class="input-group-label" title="Limpiar"><i class="fi-calendar size-24"></i></a>
</div>
<input type="text" readonly="" class="datapicker-simple-2 no-margin">
<?php $content = ob_get_clean() ?>

<?php include '../autentificacion/vista/layout.tpl.php' ?>
