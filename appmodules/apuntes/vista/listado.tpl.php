<?php
$title = 'Apuntes Listados';
$prefix = 'apuntes_listado_';
?>

<?php ob_start() ?>
<!-- <link rel="stylesheet" href="../../lib/vendor/"> -->
<link rel="stylesheet" href="../../lib/vendor/foundation-datepicker/css/foundation-datepicker.min.css">
<?php $css = ob_get_clean() ?>


<?php ob_start() ?>
<script src="../../lib/vendor/foundation-datepicker/js/foundation-datepicker.min.js"></script>
<script src="../../lib/vendor/foundation-datepicker/js/locales/foundation-datepicker.es.js"></script>
<script src="../../lib/vendor/tinymce/js/tinymce/tinymce.min.js"></script>

<script src="../../static/apuntes/apuntes_datapicker.js"></script>
<script src="../../static/apuntes/apuntes_listado.js?v=1.0.0"></script>
<?php $js = ob_get_clean() ?>


<?php ob_start() ?>

<?php
include '../autentificacion/vista/url.php';
include '../autentificacion/vista/menu.tpl.php';
?>

<style>
 #apuntes_listado_principal {
     margin-top: .5em;
 }
 #apuntes_listado_principal .item {
     margin-bottom: 1.5em;
 }

 #apuntes_listado_principal .item a:hover {
     opacity: 0.8;
 }
 #apuntes_listado_principal .item a {
     color: black;
     display: block;
     float: left;
     font-size: 14px;
     height: 300px;
     overflow: hidden;
     padding: 1.5em;
     width: 100%;
 }
 #apuntes_listado_principal .item a.pendiente-si {
     background: rgba(0, 0, 0, 0) linear-gradient(#ffe401, #fffe9f) repeat scroll 0 0;
 }
 #apuntes_listado_principal .item a.pendiente-no {
     background: rgba(0, 0, 0, 0) linear-gradient(#a2a2a2, #e1e1e1) repeat scroll 0 0;
 }
 #apuntes_listado_principal .item a .resumen {
     max-height: 200px;
     overflow-y: scroll;
 }
</style>
<div class="erda"></div>
<div class="row">
  <div class="large-12 medium-12 small-12 columns">
    <a id="<?php echo $prefix ?>add"
       class="button success no-margin"
       data-open="<?php echo $prefix ?>modal"
       item="0"
       title="Añadir">
      <i class="fi-plus"></i>
    </a>
    <a id="<?php echo $prefix ?>search"
       class="button no-margin"
       data-open="<?php echo $prefix ?>modal_search"
       title="Buscar">
      <i class="fi-magnifying-glass"></i>
    </a>
  </div>
</div>

<?php include './vista/modal.tpl.php' ?>
<?php include './vista/modal-search.tpl.php' ?>

<div id="apuntes_listado_principal"
     pagina="0"
     class="row small-up-1 medium-up-2 large-up-3"
></div>
<div class="row">
  <div class="large-12 medium-12 small-12 columns text-center">
    <h1 id="<?php echo $prefix ?>paginacion">
      <a class="prev">&#x25C0;</a>
      <a class="next">&#x25B6;</a>
    </h1>  
  </div>
</div>

<?php $content = ob_get_clean() ?>

<?php include '../autentificacion/vista/layout.tpl.php' ?>
