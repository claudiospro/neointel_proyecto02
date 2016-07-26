<?php
$title = 'Ayuda a usuario';
$prefix = 'ayuda_principal_';
?>

<?php ob_start() ?>
<style>
 h2 {
     background-color: #0084FF;
     color: #FFFFFF;
     padding: .1em .2em;
 }
</style>
<?php $css = ob_get_clean() ?>

<?php ob_start() ?>
<?php $js = ob_get_clean() ?>

<?php ob_start() ?>
<?php
include '../autentificacion/vista/url.php';
include '../autentificacion/vista/menu.tpl.php';
// Utilidades::printr($_SESSION);
//  Utilidades::printr($logica->imprimirPermisos());
?>
<div class="row collapse">
  <div class="medium-3 columns">
    <?php $i = 0 ?>
    <ul class="tabs vertical" id="example-vert-tabs" data-tabs>
      <li class="tabs-title is-active"><a href="#capitulo<?php echo ++$i ?>">Introduccion</a></li>
      <?php if ($logica->permisoModulo('Ventas')):  ?>
        <li class="tabs-title"><a href="#capitulo<?php echo ++$i ?>">Ventas</a></li>
      <?php endif ?>
      <?php if ($logica->permisoModulo('Usuario')):  ?>
        <li class="tabs-title"><a href="#capitulo<?php echo ++$i ?>">Usuario</a></li>
      <?php endif ?>
      <?php if ($logica->permisoModulo('Reporte-01-Venta')):  ?>
        <li class="tabs-title"><a href="#capitulo<?php echo ++$i ?>">Reporte</a></li>
      <?php endif ?>
      <?php if ($logica->permisoModulo('Apuntes')):  ?>
        <li class="tabs-title"><a href="#capitulo<?php echo ++$i ?>">Apuntes</a></li>
      <?php endif ?>
      <?php if ($logica->permisoModulo('Comisiones')):  ?>
        <li class="tabs-title"><a href="#capitulo<?php echo ++$i ?>">Comisiones</a></li>
      <?php endif ?>
    </ul>
  </div>
  <?php $i = 0 ?>
  <div class="medium-9 columns">
    <div class="tabs-content vertical" data-tabs-content="example-vert-tabs">
      <div class="tabs-panel is-active" id="capitulo<?php echo ++$i ?>">
        <?php include './vista/capitulos/introduccion.tpl.php' ?>
      </div>
      <?php if ($logica->permisoModulo('Ventas')):  ?>
        <div class="tabs-panel" id="capitulo<?php echo ++$i ?>">
          <?php include './vista/capitulos/ventas.tpl.php' ?>
        </div>
      <?php endif ?>
      <?php if ($logica->permisoModulo('Usuario')):  ?>
        <div class="tabs-panel" id="capitulo<?php echo ++$i ?>">
          <?php include './vista/capitulos/usuarios.tpl.php' ?>
        </div>
      <?php endif ?>
      <?php if ($logica->permisoModulo('Reporte-01-Venta')):  ?>
        <div class="tabs-panel" id="capitulo<?php echo ++$i ?>">
          <?php include './vista/capitulos/reportes.tpl.php' ?>
        </div>
      <?php endif ?>
      <?php if ($logica->permisoModulo('Apuntes')):  ?>
        <div class="tabs-panel" id="capitulo<?php echo ++$i ?>">
          <?php include './vista/capitulos/apuntes.tpl.php' ?>
        </div>
      <?php endif ?>
      <?php if ($logica->permisoModulo('Comisiones')):  ?>
        <div class="tabs-panel" id="capitulo<?php echo ++$i ?>">
          <?php include './vista/capitulos/comisiones.tpl.php' ?>
        </div>
      <?php endif ?>
    </div>
  </div>
</div>

<?php $content = ob_get_clean() ?>

<?php include '../autentificacion/vista/layout.tpl.php' ?>
