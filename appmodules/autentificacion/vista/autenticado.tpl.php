<?php $title = 'Autentificación' ?>

<?php ob_start() ?>
<?php include 'menu.tpl.php' ?>
<div class="row"> 
  <fieldset class="fieldset large-6 columns">
    <legend>Cambiar Contraseña</legend>
    <form action="./procesos/pwd.php" method="POST">
      <div class="row">
        <div class="large-3 columns">Anterior</div>
        <div class="large-9 columns"><input name="pwd-old" type="password"></div>
      </div>
      <div class="row">
        <div class="large-3 columns">Nuevo</div>
        <div class="large-9 columns"><input name="pwd-new-1" type="password"></div>
      </div>
      <div class="row">
        <div class="large-3 columns">Repetir Nuevo</div>
        <div class="large-9 columns"><input name="pwd-new-2" type="password"></div>
      </div>
      <div class="row">
        <div class="large-12 columns"><button type="submit" class="button">Guardar</button></div>
      </div>
    </form>
  </fieldset>
</div>

<?php $content = ob_get_clean() ?>

<?php include 'layout.tpl.php' ?>
