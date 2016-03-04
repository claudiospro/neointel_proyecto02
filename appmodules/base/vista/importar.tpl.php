<?php
$title = 'Base Importar';
$prefix = 'base_importar_';
?>

<?php ob_start() ?>

<?php $css = ob_get_clean() ?>


<?php ob_start() ?>

<?php $js = ob_get_clean() ?>


<?php ob_start() ?>
<?php include '../autentificacion/vista/url.php' ?>
<?php include '../autentificacion/vista/menu.tpl.php' ?>
<?php include './vista/menu.tpl.php' ?>
<div class="row fields">
  <div class="large-2 small-3 columns">
    <label class="">Informacipón:</label>
  </div>
  <div class="large-10 small-9 columns">
    <div class="callout primary">
      <div class="row">
        <div class="large-3 small-5 columns">
          <label class="">¿Es Nueva?:</label>
        </div>
        <div class="large-9 small-7 columns">
          <input name="<?php echo $prefix . 'field_es_nuevo' ?>"
                 id="<?php echo $prefix . 'field_es_nuevo' ?>"
                 type="checkbox" >
        </div>
      </div>
      <div class="row">
        <div class="large-3 small-5 columns">
          <label class="">¿Preparada para Venta?:</label>
        </div>
        <div class="large-9 small-7 columns">
          <input name="<?php echo $prefix . 'field_venta' ?>"
                 id="<?php echo $prefix . 'field_venta_si' ?>"
                 class="no-margin"
                 type="radio"><label for="<?php echo $prefix . 'field_venta_si' ?>">Si</label>
          <input name="<?php echo $prefix . 'field_venta' ?>"
                 id="<?php echo $prefix . 'field_venta_no' ?>"
                 class="no-margin"
                 type="radio"><label for="<?php echo $prefix . 'field_venta_no' ?>">No</label>
        </div>
      </div>
      <div class="row">
        <div class="large-3 small-5 columns">
          <label class="">Tipo:</label>
        </div>
        <div class="large-9 small-7 columns">
          <select name="<?php echo $prefix . 'field_informacion_tipo' ?>"
                  id="<?php echo $prefix . 'field_informacion_tipo' ?>"
                  class="no-margin"
          >
            
            <option>Caption</option>
          </select>
        </div>
      </div>
    </div>
  </div> 
</div>
<div class="row">
  <div class="large-2 small-3 columns">
    <label class="">Archivo: <span data-tooltip aria-haspopup="true" class="has-tip" data-disable-hover='false' tabindex=1 title="Es un archivo CSV">?</span></label>
  </div>
  <div class="large-10 small-9 columns">
    <input type="file"
           name="<?php echo $prefix . 'field_archivo' ?>"           
           class="no-margin">
  </div>
</div>

<div class="row">
  <div class="large-2 small-3 columns">
  </div>
  <div class="large-10 small-9 columns">
    <input name="<?php echo $prefix . 'field_save' ?>"           
           class="button tiny success expanded no-margin"
           value="Importar"
    >
  </div>
</div>

<?php $content = ob_get_clean() ?>


<?php include '../autentificacion/vista/layout.tpl.php' ?>
