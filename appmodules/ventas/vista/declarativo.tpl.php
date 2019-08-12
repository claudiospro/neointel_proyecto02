<?php
$first_date = new DateTime('first day of this month');
$last_date = new DateTime('last day of this month');
?>

<div class="reveal" id="<?php echo $prefix ?>modal_declarativo_div" data-reveal >
  <table width="100%">
    <tr>
      <td>Inicio</td>
      <td>
        <div class="input-group datapicker-simple no-margin">
          <input id="declarativo_field_ini" type="text" readonly="" class="no-margin" value="<?php echo $first_date->format('Y-m-d') ?>">
          <span class="input-group-label" title="Limpiar"><i class="fi-calendar size-24"></i></span>
        </div>
      </td>
    </tr>
    <tr>
      <td>Fin</td>
      <td>
        <div class="input-group datapicker-simple no-margin">
          <input id="declarativo_field_end" type="text" readonly="" class="no-margin" value="<?php echo $last_date->format('Y-m-d') ?>">
          <span class="input-group-label" title="Limpiar"><i class="fi-calendar size-24"></i></span>
        </div>
      </td>
    </tr>
    <tr>
      <td colspan="2">
          <input type="hidden"
                 value="<?php echo $in['campania']  ?>"
                 id="declarativo_field_campanias"
          >
        <a id="declarativo_field_export"
           class="expanded success button no-margin"
           target="_blank"

        >
          Declarativo
        </a>
      </td>
    </tr>
  </table>
</div>
