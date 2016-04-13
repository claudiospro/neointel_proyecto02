<?php
$title = 'Listado de Usuarios';
$prefix = 'usuario_listado_';
?>

<?php ob_start() ?>
<link rel="stylesheet" href="../../lib/vendor/datatable-1.10.10/DataTables-1.10.10/css/dataTables.foundation.min.css">
<style>
 thead td, thead th {
     padding-bottom: 0;
     padding-top: 0;
     text-align: center;
 }
 tbody td {
     
 }
</style>

<?php $css = ob_get_clean() ?>


<?php ob_start() ?>
<script src="../../lib/vendor/datatable-1.10.10/datatables.min.js"></script>
<script src="../../lib/vendor/datatable-1.10.10/DataTables-1.10.10/js/dataTables.foundation.min.js"></script>

<script src="../../lib/main/sesion.js"></script>

<script src="../../static/usuario/usuario_listado.js?v=1.0.0"></script>
<?php $js = ob_get_clean() ?>


<?php ob_start() ?>
<?php include '../autentificacion/vista/url.php' ?>
<?php include '../autentificacion/vista/menu.tpl.php' ?>
<?php // print_r($_SESSION) ?>
<input type="hidden" id="<?php echo $prefix . 'perfiles' ?>" value="<?php echo trim($_SESSION['perfiles']) ?>">
<div class="row">
  <div class="large-12 columns">
    <a id="<?php echo $prefix ?>add"
       class="button success no-margin"     
       data-open="<?php echo $prefix ?>modal_div"
       title="Añadir">
      <i class="fi-plus"></i>
    </a>
  </div>
</div>

<div class="reveal full" id="<?php echo $prefix ?>modal_div" data-reveal style="background-color: rgb(242, 216, 177)">
  <div class="ajax">
  </div>
  <button class="close-button" data-close aria-label="Close modal" type="button">
    <span aria-hidden="true">&times;</span>
  </button>
</div>

<div class="row">
  <div class="large-12 columns">
    <table id="<?php echo $prefix . 'tabla' ?>" width="100%">
      <thead>
        <!--
        <tr>
        <td>0</td>
        <td>1</td>
        <td>2</td>
        <td>3</td>
        <td>4</td>
        </tr>
        -->
        <tr>
          <td colspan="5">Grupo
            <select id="<?php echo $prefix ?>grupo-tbl"
                    class="no-margin search-input-select"
                    style="padding: 0px; width: 350px;"
                    data-column="0">
            </select>
          </td>
        </tr>
        <tr>
          <td><input class="no-margin search-input-text" data-column="1"  type="text"></td>
          <td><input class="no-margin search-input-text" data-column="2"  type="text"></td>
          <td>
            <select id="<?php echo $prefix ?>perfil-tbl"
                    class="no-margin search-input-select"
                    style="padding: 0px; width: 230px;"
                    data-column="3">
            </select>
          </td>
          <td>
            <select id="<?php echo $prefix ?>campanias-tbl"
                    class="no-margin no-padding search-input-select"
                    style="width: 45px;"
                    data-column="4">
              <option value=""></option>
              <option value="01">Si</option>
              <option value="00">No</option>
            </select>
          </td>
          <td>
            <center>
              <span style="width: 90px; display: block;">
                <a title="ReCargar" class="reload"><i class="fi-refresh size-36"></i></a>
              </span>
            </center>
          </td>
        </tr>
        <tr>
          <th>Nombre</th>
          <th>Login</th>      
          <th>Perfil</th>
          <th>Vigente</th>
          <th>Acciones</th>
        </tr>
      </thead>
    </table>
  </div>
</div>


<?php $content = ob_get_clean() ?>

<?php include '../autentificacion/vista/layout.tpl.php' ?>
