<?php $title = 'Autentificación' ?>

<?php ob_start() ?>
<?php include 'url.php' ?>
<?php include 'menu.tpl.php' ?>

<div class="row">
  <div class="large-3 column">&nbsp;</div>
  <div class="large-6 column">
    <div class="row">
      <div class="large-3 columns">Usuario</div>
      <div class="large-9 columns"><?php echo $_SESSION['user_full_name'] ?></div>
    </div>
  </div>
  <div class="large-3 column">&nbsp;</div>
</div>
<div class="row">
  <div class="large-3 column">&nbsp;</div>
  <fieldset class="fieldset large-6 columns callout warning">
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
  <div class="large-3 column">&nbsp;</div>
</div>

<?php $content = ob_get_clean() ?>

<?php include 'layout.tpl.php' ?>
