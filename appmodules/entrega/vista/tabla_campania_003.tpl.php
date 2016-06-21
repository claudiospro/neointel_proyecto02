<?php
$combo = new OptionComboSimple();

$estados_reales = $modelo->getEstadoReal($in);
$test = false;
?>

<thead>
  <?php if($test): ?>
    <tr>
      <?php
      for ($i=0; $i<=11; $i++) echo '<td>' .$i .'</td>';
      ?>
    </tr>
  <?php endif ?>
  
  <?php $col = -1; ?>
  <tr>
    <td><input class="no-margin search-input-text" data-column="<?php print ++$col ?>" type="text"></td>
    <td><input class="no-margin search-input-text" data-column="<?php print ++$col ?>" type="text"></td>
    <td><?php ++$col ?></td>
    <td><?php ++$col ?></td>
    <td><?php ++$col ?></td>
    <td><?php ++$col ?></td>
    <td><input class="no-margin search-input-text" data-column="<?php print ++$col ?>" type="text"></td>
    <td><input class="no-margin search-input-text" data-column="<?php print ++$col ?>" type="text"></td>
    <td><?php ++$col ?></td>
    <td>
      <select class="no-margin search-input-select"
              style="padding: 0px; width: 130px;"
              data-column="<?php print ++$col ?>">
        <?php
        $combo->set_format(array('id', 'nombre'));
        $combo->imprimir($estados_reales);
        ?>
      </select>
    </td>
    <td><input class="no-margin search-input-text" data-column="<?php print ++$col ?>" type="text"></td>
    <td><input class="no-margin search-input-text" data-column="<?php print ++$col ?>" type="text"></td>
  </tr>
  <tr>
    <th><span style="display: block; width: 80px;">Fecha Creación</span></th>
    <th><span style="display: block; width: 80px;">Fecha Entrega</span></th>
    <th><span style="display: block; width: 100px;">Observaciones</span></th>
    <th><span style="display: block; width: 85px;">Pago<br>Entrega</span></th>
    <th><span style="display: block; width: 200px;">Producto</span></th>
    <th><span style="display: block; width: 100px;">Montos</span></th>
    <th><span style="display: block; width: 200px;">Cliente</span></th>
    <th><span style="display: block; width: 150px;">Ubigeo</span></th>
    <th><span style="display: block; width: 150px;">Referencia</span></th>
    <th><span style="display: block; width: 150px;">Estado Real</span></th>
    <th><span style="display: block; width: 150px;">Recibio Dinero</span></th>
    <th><span style="display: block; width: 150px;">Comprobante</span></th>
  </tr>
</thead>
