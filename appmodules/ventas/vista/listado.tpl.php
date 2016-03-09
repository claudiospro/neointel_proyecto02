<?php
$title = 'Ventas Listado';
$prefix = 'venta_listado_';
?>

<?php ob_start() ?>
<link rel="stylesheet" href="../../lib/vendor/datatable-1.10.10/DataTables-1.10.10/css/dataTables.foundation.min.css">

<link rel="stylesheet" href="../../lib/vendor/jquery-ui-1.11.4.custom/jquery-ui.min.css">

<link rel="stylesheet" href="../../lib/vendor/foundation-datepicker/css/foundation-datepicker.min.css">
<!-- <link rel="stylesheet" href="../../lib/vendor/zclip/style.css"> -->

<?php $css = ob_get_clean() ?>


<?php ob_start() ?>
<script src="../../lib/vendor/datatable-1.10.10/datatables.min.js"></script>
<script src="../../lib/vendor/datatable-1.10.10/DataTables-1.10.10/js/dataTables.foundation.min.js"></script>

<script src="../../lib/vendor/foundation-datepicker/js/foundation-datepicker.min.js"></script>
<script src="../../lib/vendor/foundation-datepicker/js/locales/foundation-datepicker.es.js"></script>
<script src="../../static/ventas/ventas_datapicker.js"></script>

<script src="../../lib/vendor/jquery-ui-1.11.4.custom/jquery-ui.min.js"></script>

<script src="../../lib/main/sesion.js"></script>

<!-- <script type="text/javascript" src="../../lib/vendor/zclip/jquery.zclip.js"></script> -->

<script src="../../static/ventas/ventas_listado.js?v=1.1.3"></script>
<?php $js = ob_get_clean() ?>


<?php ob_start() ?>
<?php include '../autentificacion/vista/url.php' ?>
<?php include '../autentificacion/vista/menu.tpl.php' ?>
<?php // print_r($_SESSION) ?>
<input type="hidden" id="<?php echo $prefix . 'perfiles' ?>" value="<?php echo trim($_SESSION['perfiles']) ?>">
<div class="row">
  <div class="large-1 columns">
    <a id="<?php echo $prefix ?>add"
       class="button success no-margin"     
       data-open="venta_listado_modal_div"
       title="Añadir">
      <i class="fi-plus"></i>
    </a>
  </div>
  <div class="large-11 columns">
    <select class="no-margin" id="<?php echo $prefix ?>campanias"></select>
  </div>  

</div>

<div class="reveal full" id="<?php echo $prefix ?>modal_div" data-reveal style="background-color: rgb(242, 216, 177)">
  <div class="ajax">
  </div>
  <button class="close-button" data-close aria-label="Close modal" type="button">
    <span aria-hidden="true">&times;</span>
  </button>
</div>

<?php include './vista/declarativo.tpl.php' ?>

<table id="<?php echo $prefix . 'tabla' ?>">
  <thead>
    <!--
    <tr>
      <td>0</td>
      <td>1</td>
      <td>2</td>
      <td>3</td>
      <td>4</td>
      <td>5</td>
      <td>6</td>
      <td>7</td>
      <td>8</td>
      <td>9</td>
      <td>10</td>
      <td>11</td>
      <td>12</td>
      <td>13</td>
      <td>14</td>
      <td>15</td>
    </tr>
    -->
    <tr>
      <td>
        <select id="<?php echo $prefix ?>campanias-tbl"
                class="no-margin search-input-select"
                style="padding: 0px; width: 250px;"
                data-column="0">          
        </select>
      </td>
      <td><input class="no-margin search-input-text" data-column="1"  type="text"></td>
      <td><input class="no-margin search-input-text" data-column="2"  type="text"></td>
      <td><input class="no-margin search-input-text" data-column="3"  type="text"></td>
      <td>
        <select id="<?php echo $prefix ?>estado-tbl"
                class="no-margin search-input-select"
                style="padding: 0px; width: 250px;"
                data-column="4">          
        </select>

      </td>
      <td>
        <select id="<?php echo $prefix ?>estado-real-tbl"
                class="no-margin search-input-select"
                style="padding: 0px; width: 250px;"
                data-column="5">          
        </select>
      </td>
      <td><input class="no-margin search-input-text" data-column="6"  type="text"></td>
      <td><input class="no-margin search-input-text" data-column="7"  type="text"></td>
      <td><input class="no-margin search-input-text" data-column="8"  type="text"></td>
      <td><input class="no-margin search-input-text" data-column="9"  type="text"></td>
      <td><input class="no-margin search-input-text" data-column="10" type="text"></td>
      <td><input class="no-margin search-input-text" data-column="11" type="text"></td>
      <td><input class="no-margin search-input-text" data-column="12" type="text"></td>
      <td><input class="no-margin search-input-text" data-column="13" type="text"></td>
      <td>
        <center>
          <span style="width: 90px; display: block;">
            <a title="ReCargar" class="reload"><i class="fi-refresh size-36"></i></a>
            <?php if(trim($_SESSION['perfiles']) !='Asesor Comercial'): ?>
              &nbsp;&nbsp;
              <a class="report" title="Declarativo" data-open="venta_listado_modal_declarativo_div"><i class="fi-page-add size-36" style="color: rgb(204, 146, 12);"></i></a>
            <?php endif ?>
          </span>
        </center>
      </td>
    </tr>
    <tr>
      <th>Campaña</th>
      <th>Producto</th>      
      <th>Cliente</th>
      <th>Documento</th>
      <th>Estado</th>
      <th>Estado Real</th>
      <th>Fecha Creación</th>
      <th>Fecha Ultima</th>
      <th>Fecha Instalada</th>
      <th>Asesor de Venta</th>
      <th>Tramitación</th>
      <th>Supervisor</th>
      <th>Coordinador</th>
      <th>Eliminado</th>
      <th>Acciones</th>
    </tr>
  </thead>
</table>
<?php $content = ob_get_clean() ?>

<?php include '../autentificacion/vista/layout.tpl.php' ?>
