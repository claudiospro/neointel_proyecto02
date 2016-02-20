<div class="reveal" id="<?php echo $prefix ?>modal_declarativo_div" data-reveal >
  <table width="100%">
    <tr>
      <td>Inicio</td>
      <td>
        <div class="input-group datapicker-simple no-margin">
          <input id="declarativo_field_ini" type="text" readonly="" class="no-margin" value="<?php echo date('Y-m-d') ?>">
          <a class="input-group-label" title="Limpiar"><i class="fi-calendar size-24"></i></a>
        </div>
      </td>
    </tr>
    <tr>
      <td>Fin</td>
      <td>
        <div class="input-group datapicker-simple no-margin">
          <input id="declarativo_field_end" type="text" readonly="" class="no-margin" value="<?php echo date('Y-m-d') ?>">
          <a class="input-group-label" title="Limpiar"><i class="fi-calendar size-24"></i></a>
        </div>
      </td>
    </tr>
    <tr>
      <td>Campaña</td>
      <td>
        <select class="no-margin" id="declarativo_field_campanias"></select>
      </td>
    </tr>
    <tr>
      <td colspan="2">
        <a id="declarativo_field_export" class="expanded success button no-margin" >Declarativo</a>
      </td>
    </tr>
  </table>
</div>
