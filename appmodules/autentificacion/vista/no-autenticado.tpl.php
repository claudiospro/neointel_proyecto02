<?php $title = 'Autentificación' ?>

<?php ob_start() ?>
<style>
 body {
      background-color: #959493;
 } 
</style>
<div class="row">
  <div class="large-3 column">&nbsp;</div>
  <div class="large-6 column">
    <img src="../../static/logo.png" style="margin: 3rem 0 2rem 0" />
  </div>
  <div class="large-3 column">&nbsp;</div>
</div>
<div class="row">
  <div class="large-3 column">&nbsp;</div>
  <div class="large-6 column">
    <fieldset class="fieldset callout primary">
      <legend
      >Autentificación</legend>
      <form action="./procesos/login.php" method="POST">
        <div class="row"> 
          <div class="large-2 columns text-right">
            <label for="nombre">Usuario</label>          
          </div> 
          <div class="large-10 columns">
            <input type="text" name="nombre" id="nombre">
          </div>
        </div>
        <div class="row"> 
          <div class="large-2 columns text-right">
            <label for="pwd">Password</label>          
          </div> 
          <div class="large-10 columns">
            <input type="password" name="pwd" id="pwd">
          </div>
        </div>
        <div class="row"> 
          <div class="large-12 columns text-right">
            <input class="button no-margin" type="submit" name="enviar" value="Acceder">
          </div>
        </div>            
      </form>
    </fieldset>
  </div>
  <div class="large-3 column">&nbsp;</div>
</div>

<?php $content = ob_get_clean() ?>

<?php include 'layout.tpl.php' ?>
