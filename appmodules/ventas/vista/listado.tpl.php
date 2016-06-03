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

<script src="../../lib/main/sesion.js?v=1.1.0"></script>

<!-- <script type="text/javascript" src="../../lib/vendor/zclip/jquery.zclip.js"></script> -->

<script src="../../static/ventas/ventas_listado.js?v=1.4.4"></script>
<script src="../../static/ventas/ventas_editable_inline.js?v=1.0.3"></script>
<script src="../../static/ventas/ventas_timer_estructura.js?v=1.0.3"></script>
<script src="../../static/ventas/ventas_timer_por_aprobar.js?v=1.0.3"></script>
<?php $js = ob_get_clean() ?>


<?php ob_start() ?>

<?php
include '../autentificacion/vista/url.php';
include '../autentificacion/vista/menu.tpl.php';
// print_r($_SESSION);
?>

<input type="hidden" id="<?php echo $prefix . 'perfiles' ?>" value="<?php echo trim($_SESSION['perfiles']) ?>">

<?php include './vista/timer-estructura.tpl.php' ?>

<!-- --------------------------------------------------------------------------- -->

<div class="row">
  <div class="large-12 columns">
    <div class="timer-por-aprobar" style="display:none">
      Ventas por Aprobar
      <span class="ajax">
      </span>
    </div>
  </div>
</div>

<div class="reveal"
     id="<?php echo $prefix ?>modal_por_aprobar"
     style="background-color: rgb(242, 216, 177); height:550px"
     data-reveal>
  <div class="row">
    <div class="large-12 columns">
      <div class="ajax">
      </div>      
    </div>
  </div>

  <button class="close-button" data-close aria-label="Close modal" type="button">
    <span aria-hidden="true">&times;</span>
  </button>
</div>

<!-- --------------------------------------------------------------------------- -->

<?php if(trim($_SESSION['perfiles']) == 'Asesor Comercial' || trim($_SESSION['perfiles']) == 'Supervisor'): ?>
  <div class="row">
    <div class="large-3 medium-4 small-8 columns">
      <div class="input-group no-margin">
        <a id="<?php echo $prefix ?>add"
           class="button success no-margin input-group-label"
           data-open="venta_listado_modal_div"
           title="Añadir">
          <i class="fi-plus"></i>
        </a>
        <select class="no-margin" id="<?php echo $prefix ?>campanias"></select>
      </div>      
    </div>
    <div class="large-1 medium-1 small-2 columns text-right">
    </div>
  </div>
<?php endif ?>

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
    </tr>
    -->
    <tr>
      <td colspan="20" class="text-center">
        <select id="<?php echo $prefix ?>campanias-tbl"
                class="no-margin search-input-select"
                style="padding: 0px; width: 250px;"
                data-column="0">          
        </select>
      </td>
    </tr>
    <tr>
      <td><input class="no-margin search-input-text" data-column="1"  type="text"></td>
      <td><input class="no-margin search-input-text" data-column="2"  type="text"></td>
      <td><input class="no-margin search-input-text" data-column="3"  type="text"></td>
      <td><input class="no-margin search-input-text" data-column="4"  type="text"></td>
      <td>
        <select class="no-margin search-input-select"
                style="padding: 0px; width: 130px;"
                data-column="5">
          <option value=""></option>
          <optgroup label="Venta">
            <option value="a0" style="color:blue">Venta</option>
            <option value="a1">Aprobación:Pendiente</option>
            <option value="a2" style="color:red">Aprobación:Caida</option>
            <option value="a3">Validación:Pendiente</option>
            <option value="a4" style="color:red">Validación:Caida</option>
            <option value="a5">Cargado:Pendiente</option>
            <option value="a6" style="color:red">Cargado:Caida</option>
          </optgroup>
          <optgroup label="PostVenta">
            <option value="b0" style="color:blue">PostVenta</option>
            <option value="b1">Validación:Pendiente</option>
            <option value="b2" style="color:red">Validación:Caida</option>
            <option value="b3">Cita:Pendiente</option>
            <option value="b4" style="color:red">Cita:Caida</option>
            <option value="b5">Instalación:Pendiente</option>
            <option value="b6" style="color:red">Instalación:Caida</option>
            <option value="b7" style="color:green">Instalación:Si</option>
          </optgroup>
        </select>
      </td>
      <td>
        <select id="<?php echo $prefix ?>estado-tbl"
                class="no-margin search-input-select"
                style="padding: 0px; width: 120px;"
                data-column="6">
        </select>
      </td>
      <td>
        <select id="<?php echo $prefix ?>estado-real-tbl"
                class="no-margin search-input-select"
                style="padding: 0px; width: 200px;"
                data-column="7">          
        </select>
      </td>
      <td><!-- 8: onservacion --></td>
      <td> <!-- 9: acciones -->
        <center>
          <span style="width: 90px; display: block;">
            <a title="ReCargar" class="reload"><i class="fi-refresh size-36"></i></a>
            <?php if(
                trim($_SESSION['perfiles']) =='Admin' || 
            
                trim($_SESSION['perfiles']) =='Gerencia' ||
                trim($_SESSION['perfiles']) =='Coordinador' ||
                trim($_SESSION['perfiles']) =='Tramitacion' ||
                $_SESSION['user_id'] == '47'
            ): ?> 
              &nbsp;&nbsp;
              <a class="report" title="Declarativo" data-open="venta_listado_modal_declarativo_div"><i class="fi-page-add size-36" style="color: rgb(204, 146, 12);"></i></a> 
            <?php endif ?>
          </span>
        </center>
      </td>      
      <td><input class="no-margin search-input-text" data-column="10"  type="text"></td>
      <td><input class="no-margin search-input-text" data-column="11"  type="text"></td>
      <td><input class="no-margin search-input-text" data-column="12" type="text"></td>
      <td><input class="no-margin search-input-text" data-column="13" type="text"></td>
      <td><input class="no-margin search-input-text" data-column="14"  type="text"></td>
      <td>
        <select id="<?php echo $prefix ?>eliminado-tbl"
                class="no-margin search-input-select"
                style="padding: 0px; width: 70px;"
                data-column="15">
          <option value=""></option>          
          <option value="no">No</option>
          <option value="si">Si</option>
        </select>
      </td>
      <td></td>
    </tr>
    <tr>
      <th><span style="display: block; width: 150px;">Producto</span></th>
      <th>Tipo Cliente</th>
      <th><span style="display: block; width: 180px;">Cliente</span></th>
      <th>Documento</th>
      <th>Proceso</th>
      <th>Estado</th>
      <th>Estado Real</th>
      <th><span style="display: block; width: 220px;">Observación</span></th>
      <th>Acciones</th>
      <th>Fecha Creación</th>
      <th>Fecha Ultima</th>
      <th><span style="display: block; width: 160px;">Asesor de Venta</span></th>
      <th><span style="display: block; width: 160px;">Supervisor</span></th>
      <th><span style="display: block; width: 160px;">Coordinador</span></th>
      <th>Eliminado</th>
      <th></th>
    </tr>
  </thead>
</table>
<?php $content = ob_get_clean() ?>

<?php include '../autentificacion/vista/layout.tpl.php' ?>
