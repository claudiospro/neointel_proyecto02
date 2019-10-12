<?php
$title = 'Ventas Listado';
$prefix = 'venta_listado_';
?>

<?php ob_start() ?>
<link rel="stylesheet" href="../../static/importado/importado_listado.css?v=1.0.0">
<?php $css = ob_get_clean() ?>


<?php ob_start() ?>
<!--<script src="../../static/importado/importado_listado.js?v=1.0.0"></script>-->
<?php $js = ob_get_clean() ?>


<?php ob_start() ?>
<?php include '../autentificacion/vista/url.php' ?>
<?php include '../autentificacion/vista/menu.tpl.php' ?>
<?php // print_r($_SESSION) ?>


<form action="./procesos/importado.php"
      method="post"
      class="form_importado"
      enctype="multipart/form-data">
    <div class="input-group no-margin">
        <label>Delimitador</label>
        <select class="no-margin" name="delimiter">
            <option value="|">|</option>
        </select>
        <label>Campaña</label>
        <select class="no-margin" name="campania">
          <?php
          foreach($in['campanias'] as $row)
          {
            $selected = '';
            if ($row['id'] == $in['campania'])
            {
              $selected = 'selected';
            }
            echo '<option value="' . $row['id'] . '" ' . $selected . '>' . ($row['nombre']) . '</option>';
          }
          ?>
        </select>
        <input type="file" name="myfile" required>
        <button class="button success no-margin">Importar</button>
    </div>

</form>


<?php $content = ob_get_clean() ?>

<?php include '../autentificacion/vista/layout.tpl.php' ?>
