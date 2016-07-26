<?php
$combo = new OptionComboSimple();

$pr['campania'] = Utilidades::clear_input($in['campania']);
$estados = $modelo->getEstadoActivas($pr);
$estados_reales = $modelo->getEstadoRealActivas($in);
$test = false;
?>

<table id="<?php echo $prefix . 'tabla' ?>">
  <thead>
    <?php if($test): ?>
      <tr>
        <?php
        for ($i=0; $i<=20; $i++) echo '<td>' .$i .'</td>';
        ?>
      </tr>
    <?php endif ?>      
    
    <tr>
      <?php $i = -1 ?>
      <td><input class="no-margin search-input-text" data-column="<?php echo ++$i ?>"  type="text"></td>
      <td><input class="no-margin search-input-text" data-column="<?php echo ++$i ?>"  type="text"></td>
      <td><input class="no-margin search-input-text" data-column="<?php echo ++$i ?>"  type="text"></td>
      <td><input class="no-margin search-input-text" data-column="<?php echo ++$i ?>"  type="text"></td>
      <td><input class="no-margin search-input-text" data-column="<?php echo ++$i ?>"  type="text"></td>
      <td><input class="no-margin search-input-text" data-column="<?php echo ++$i ?>"  type="text"></td>
      <td><input class="no-margin search-input-text" data-column="<?php echo ++$i ?>"  type="text"></td>
      <td>
        <select class="no-margin search-input-select"
                style="padding: 0px; width: 130px;"
                data-column="<?php echo ++$i ?>">
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
        <select class="no-margin search-input-select"
                style="padding: 0px; width: 120px;"
                data-column="<?php echo ++$i ?>">
          <?php
          $combo->set_format(array('id', 'nombre'));
          $combo->imprimir($estados);
          ?>
        </select>
      </td>
      <td>
        <select class="no-margin search-input-select"
                style="padding: 0px; width: 200px;"
                data-column="<?php echo ++$i ?>">
          <?php
          $combo->set_format(array('id', 'nombre'));
          $combo->imprimir($estados_reales);
          ?>
        </select>
      </td>
      <td><!-- <?php echo ++$i ?>: onservacion --></td>      
      <td> <!-- <?php echo ++$i ?>: acciones -->
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
      <td><input class="no-margin search-input-text" data-column="<?php echo ++$i ?>"  type="text"></td>
      <td><input class="no-margin search-input-text" data-column="<?php echo ++$i ?>"  type="text"></td>
      <td><input class="no-margin search-input-text" data-column="<?php echo ++$i ?>"  type="text"></td>
      <td><input class="no-margin search-input-text" data-column="<?php echo ++$i ?>" type="text"></td>
      <td><input class="no-margin search-input-text" data-column="<?php echo ++$i ?>" type="text"></td>
      <td><input class="no-margin search-input-text" data-column="<?php echo ++$i ?>"  type="text"></td>
      <td><input class="no-margin search-input-text" data-column="<?php echo ++$i ?>" type="text"></td>
      <td><input class="no-margin search-input-text" data-column="<?php echo ++$i ?>"  type="text"></td>
      <td>
        <select id="<?php echo $prefix ?>eliminado-tbl"
                class="no-margin search-input-select"
                style="padding: 0px; width: 70px;"
                data-column="<?php echo ++$i ?>">
          <option value=""></option>          
          <option value="no">No</option>
          <option value="si">Si</option>
        </select>
      </td>
    </tr>
    <tr>
      <th><span style="display: block; width: 150px;">Producto</span></th>
      <th>Tipo Cliente</th>
      <th><span style="display: block; width: 150px;">Producto (BackOffice)</span></th>
      <th>Tipo Cliente (BackOffice)</th>
      <th><span style="display: block; width: 180px;">Cliente</span></th>
      <th>DirecciónID</th>
      <th>Documento</th>
      <th>Proceso</th>
      <th>Estado</th>
      <th>Estado Real</th>
      <th><span style="display: block; width: 220px;">Observación</span></th>
      <th>Acciones</th>
      <th>Fecha Creación</th>
      <th>Fecha Ultima</th>
      <th>Agendado</th>
      <th><span style="display: block; width: 160px;">Asesor de Venta</span></th>
      <th><span style="display: block; width: 160px;">Supervisor</span></th>
      <th><span style="display: block; width: 160px;">Coordinador</span></th>
      <th><span style="display: block; width: 150px;">Producto</span></th>
      <th>Tipo Cliente</th>
      <th>Eliminado</th>
    </tr>
  </thead>
</table>
