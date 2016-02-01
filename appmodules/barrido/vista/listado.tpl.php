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


<script src="../../static/barrido/barrido_listado.js"></script>
<?php $js = ob_get_clean() ?>


<?php ob_start() ?>
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
    <!-- </tr> -->
    <tr>
      <td><input class="no-margin search-input-text" data-column="0"  type="text"></td>
      <td><input class="no-margin search-input-text" data-column="1"  type="text"></td>
      <td><input class="no-margin search-input-text" data-column="2"  type="text"></td>
      <td><input class="no-margin search-input-text" data-column="3"  type="text"></td>
      <td><input class="no-margin search-input-text" data-column="4"  type="text"></td>
      <td><input class="no-margin search-input-text" data-column="5"  type="text"></td>
      <td></td>      
    </tr>
    <tr>
      <th>Producto</th>
      <th>Cliente</th>
      <th>Asesor de Venta</th>
      <th>Fecha Creación</th>
      <th>Fecha Actualización</th>
      <th>Fecha Instalación</th>      
      <th>Acciones</th>
    </tr>
  </thead>
</table>
<?php $content = ob_get_clean() ?>

<?php include '../autentificacion/vista/layout.tpl.php' ?>
