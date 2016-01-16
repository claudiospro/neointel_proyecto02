<?php
$title = 'DataTable';
$prefix = 'test_datable_';
?>

<?php ob_start() ?>
<link rel="stylesheet" href="../../lib/vendor/datatable-1.10.10/DataTables-1.10.10/css/dataTables.foundation.min.css">
<style>

 
</style>
<?php $css = ob_get_clean() ?>


<?php ob_start() ?>
<script src="../../lib/vendor/datatable-1.10.10/datatables.min.js"></script>
<script src="../../lib/vendor/datatable-1.10.10/DataTables-1.10.10/js/dataTables.foundation.min.js"></script>
<script>
 dataTable_listado = $(prefixId+'tabla').DataTable({
     "processing" : true,
     "serverSide" : true,
     "lengthChange": false,
     // "searching": false,
     "info": false,
     //"bAutoWidth" : false,

     // "scrollY": false,
     // "scrollX": true,
     
     "pageLength": 50,
     "order" : [ 0, 'desc' ],
     "aoColumnDefs": [
         { 'aTargets': [ 13 ], 'bSortable': false },
         { "targets": ver, "visible": false }
     ],

     "ajax": {
         url :"./datatable/ajax.php", 
         type: "post",
     },
 });
 $(prefixId+'tabla_filter').hide();
</script>
<?php $js = ob_get_clean() ?>


<?php ob_start() ?>
<input type="hidden" id="<?php echo $prefix . 'perfiles' ?>" value="<?php echo trim($_SESSION['perfiles']) ?>">
<table id="<?php echo $prefix . 'tabla' ?>">
  <thead>
    <tr>
      <td><input class="no-margin search-input-text" data-column="0" type="text"></td>
      <td><input class="no-margin search-input-text" data-column="1" type="text"></td>
      <td><input class="no-margin search-input-text" data-column="2" type="text"></td>
      <td></td>      
    </tr>
    <tr>
      <th>Fecha de Creación</th>
      <th>Fecha de Venta</th>
      <th>Fecha Instalada</th>
      <th></th>
    </tr>
  </thead>
</table>

<?php $content = ob_get_clean() ?>

<?php include '../autentificacion/vista/layout.tpl.php' ?>
