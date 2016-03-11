<?php
$title = 'Ventas Listado';
$prefix = 'venta_listado_';
?>

<?php ob_start() ?>
<link rel="stylesheet" href="../../lib/vendor/datatable-1.10.10/DataTables-1.10.10/css/dataTables.foundation.min.css">
<?php $css = ob_get_clean() ?>


<?php ob_start() ?>
<script src="../../lib/vendor/datatable-1.10.10/datatables.min.js"></script>
<script src="../../lib/vendor/datatable-1.10.10/DataTables-1.10.10/js/dataTables.foundation.min.js"></script>


<script src="../../static/barrido/barrido_listado.js?v=1.0.5"></script>
<?php $js = ob_get_clean() ?>


<?php ob_start() ?>
<?php include '../autentificacion/vista/url.php' ?>
<?php include '../autentificacion/vista/menu.tpl.php' ?>
<?php // print_r($_SESSION) ?>
<input type="hidden" id="<?php echo $prefix . 'perfiles' ?>" value="<?php echo trim($_SESSION['perfiles']) ?>">

<table id="<?php echo $prefix . 'tabla' ?>">
  <thead>
    <!-- <tr> -->
    <!--   <td>0</td> -->
    <!--   <td>1</td> -->
    <!--   <td>2</td> -->
    <!--   <td>3</td> -->
    <!--   <td>4</td> -->
    <!--   <td>5</td> -->
    <!--   <td>6</td> -->
    <!--   <td>7</td> -->
    <!-- </tr> -->
    <tr>
      <td>
        <select id="<?php echo $prefix ?>campanias-tbl"
                class="no-margin search-input-select"
                style="padding: 0px; width: 250px;"
                data-column="0">          
        </select>
      </td>
      <td>
        <select id="<?php echo $prefix ?>estado-tbl"
                class="no-margin search-input-select"
                style="padding: 0px; width: 250px;"
                data-column="1">          
        </select>
      </td>
      <td><input class="no-margin search-input-text" data-column="2"  type="text"></td>
      <td><input class="no-margin search-input-text" data-column="3"  type="text"></td>
      <td><input class="no-margin search-input-text" data-column="4"  type="text"></td>
      <td><input class="no-margin search-input-text" data-column="5"  type="text"></td>
    </tr>
    <tr>
      <th>Acciones</th>
      <th>Estado</th>
      <th>Asesor de Venta</th>
      <th>Fecha Creación</th>
      <th>Producto</th>
      <th>Cliente</th>
    </tr>
  </thead>
</table>
<div class="row">
  <div class="large-6 columns">
    <select id="<?php echo $prefix ?>estados">
    </select>
  </div>
  <div class="large-6 columns">
    <a id="<?php echo $prefix ?>cambiar" class="button">Cambiar</a>
  </div>
</div>
<?php $content = ob_get_clean() ?>

<?php include '../autentificacion/vista/layout.tpl.php' ?>
