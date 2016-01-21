<?php
$title = 'Modal';
$prefix = 'test_ajax_data_';
?>

<?php ob_start() ?>
<?php $css = ob_get_clean() ?>


<?php ob_start() ?>
<script>
 $(document).ready(function() {
     var option_empty='<option value=""></option>';
     var prefixId    = '#test_ajax_data_';
     var prefixClass = '.test_ajax_data_';

     $(prefixId+'modal_link').on('click', function (event) {
         exampleModal($(this));
     });
     // ajax dinamico
     $(prefixId+'tabla').on('click', '.view', function (event) {
         exampleModal($(this));
     });
     
     function exampleModal(item) {
         var enviar = {
             '': item.attr(''),
         }
         console.log(enviar);

     }
 });
</script>
<?php $js = ob_get_clean() ?>


<?php ob_start() ?>
<div id="<?php echo $prefix ?>data">
  
</div>
<?php $content = ob_get_clean() ?>

<?php include '../autentificacion/vista/layout.tpl.php' ?>
