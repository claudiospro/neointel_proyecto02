<?php
$title = 'Modal';
$prefix = 'test_modal_';
?>

<?php ob_start() ?>
<?php $css = ob_get_clean() ?>


<?php ob_start() ?>
<script>
 $(document).ready(function() {
     var option_empty='<option value=""></option>';
     var prefixId    = '#test_modal_';
     var prefixClass = '.test_modal_';

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
<p>
  <a id="<?php echo $prefix ?>modal_link"
      data-open="<?php echo $prefix ?>modal_div"
   >Click modal
  </a>
</p>

<div class="reveal" id="<?php echo $prefix ?>modal_div" data-reveal>
  <p>aaa</p>
  <button class="close-button" data-close aria-label="Close modal" type="button">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
<?php $content = ob_get_clean() ?>

<?php include '../autentificacion/vista/layout.tpl.php' ?>
