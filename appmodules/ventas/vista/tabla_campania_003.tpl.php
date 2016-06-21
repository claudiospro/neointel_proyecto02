<?php
$combo = new OptionComboSimple();

$pr['campania'] = Utilidades::clear_input($in['campania']);
$estados = $modelo->getEstadoActivas($pr);
$estados_reales = $modelo->getEstadoRealActivas($in);
$test = false;
?>

<thead>
  <?php if($test): ?>
    <tr>
      <?php
      for ($i=0; $i<=20; $i++) echo '<td>' .$i .'</td>';
      ?>
    </tr>
  <?php endif ?>
  
  <?php $col = -1; ?>
  <tr>
    <td><input class="no-margin search-input-text" data-column="<?php print ++$col ?>"  type="text"></td>
    <td><input class="no-margin search-input-text" data-column="<?php print ++$col ?>"  type="text"></td>
    <td><input class="no-margin search-input-text" data-column="<?php print ++$col ?>"  type="text"></td>
    <td><input class="no-margin search-input-text" data-column="<?php print ++$col ?>"  type="text"></td>
    <td><input class="no-margin search-input-text" data-column="<?php print ++$col ?>"  type="text"></td>
    <td><input class="no-margin search-input-text" data-column="<?php print ++$col ?>"  type="text"></td>
    <td><input class="no-margin search-input-text" data-column="<?php print ++$col ?>"  type="text"></td>   
    <td><input class="no-margin search-input-text" data-column="<?php print ++$col ?>"  type="text"></td>
    <td><input class="no-margin search-input-text" data-column="<?php print ++$col ?>"  type="text"></td>
    <td><input class="no-margin search-input-text" data-column="<?php print ++$col ?>"  type="text"></td>
    <td>
      <select class="no-margin search-input-select"
              style="padding: 0px; width: 130px;"
              data-column="<?php print ++$col ?>">
        <option value=""></option>
        <option value="b0" style="color:blue">PostVenta</option>
        <option value="b1">Validación:Pendiente</option>
        <option value="b2" style="color:red">Validación:Caida</option>
        <option value="b3">Cita:Pendiente</option>
        <option value="b4" style="color:red">Cita:Caida</option>
        <option value="b5">Instalación:Pendiente</option>
        <option value="b6" style="color:red">Instalación:Caida</option>
        <option value="b7" style="color:green">Instalación:Si</option>
      </select>
    </td>
    <td>
      <select class="no-margin search-input-select"
              style="padding: 0px; width: 120px;"
              data-column="<?php print ++$col ?>">
        <?php
        $combo->set_format(array('id', 'nombre'));
        $combo->imprimir($estados);
        ?>
      </select>
    </td>
    <td>
      <select class="no-margin search-input-select"
              style="padding: 0px; width: 200px;"
              data-column="<?php print ++$col ?>">
        <?php
        $combo->set_format(array('id', 'nombre'));
        $combo->imprimir($estados_reales);
        ?>
      </select>
    </td>
    <td><!-- <?php print ++$col ?>: onservacion --></td>
    <td> <!-- <?php print ++$col ?>: acciones -->
      <center>
        <span style="width: 90px; display: block;">
          <a title="ReCargar" class="reload"><i class="fi-refresh size-36"></i></a>
          <?php if(
              trim($_SESSION['perfiles']) =='Admin' || trim($_SESSION['perfiles']) =='Gerencia' || $_SESSION['user_id'] == '47' || $_SESSION['user_id'] == '189'
          ): ?> 
            &nbsp;&nbsp;
            <a class="report" title="Declarativo" data-open="venta_listado_modal_declarativo_div"><i class="fi-page-add size-36" style="color: rgb(204, 146, 12);"></i></a> 
          <?php endif ?>
        </span>
      </center>
    </td>      
    <td><input class="no-margin search-input-text" data-column="<?php print ++$col ?>"  type="text"></td>
    <td><input class="no-margin search-input-text" data-column="<?php print ++$col ?>"  type="text"></td>
    <td><input class="no-margin search-input-text" data-column="<?php print ++$col ?>" type="text"></td>
    <td><input class="no-margin search-input-text" data-column="<?php print ++$col ?>" type="text"></td>
    <td><input class="no-margin search-input-text" data-column="<?php print ++$col ?>" type="text"></td>
    <td>
      <select id="<?php echo $prefix ?>eliminado-tbl"
              class="no-margin search-input-select"
              style="padding: 0px; width: 70px;"
              data-column="<?php print ++$col ?>">
        <option value=""></option>          
        <option value="no">No</option>
        <option value="si">Si</option>
      </select>
    </td>
  </tr>
  <tr>
    <th><span style="display: block; width: 50px;">Producto</span></th>
    <th>Tipo Cliente</th>
    <th><span style="display: block; width: 180px;">Cliente</span></th>
    <th><span style="display: block; width: 180px;">Entrega</span></th>
    <th>Cnt</th>
    <th>Precio</th>
    <th>Precio<br>Final</th>
    <th>Tipo<br>Pago</th>
    <th><span style="display: block; width: 200px;">Recivio Dinero</span></th>
    <th>Comprobante</th>
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
  </tr>
</thead>
