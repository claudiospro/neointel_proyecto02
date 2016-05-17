<div class="reveal tiny"
     id="<?php echo $prefix ?>modal_search"
     style="background-color: rgb(242, 216, 177); height:300px;"
     data-reveal>
  <div class="row">
    <div class="large-12 columns">
      Desde
    </div>
    <div class="large-12 columns">
      <div class="input-group datapicker-simple">
        <input type="text" readonly="" id="search_ini" class="no-margin">
        <a class="input-group-label" title="Limpiar"><i class="fi-calendar size-24"></i></a>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="large-12 columns">
      Hasta
    </div>
    <div class="large-12 columns">
      <div class="input-group datapicker-simple">
        <input type="text" readonly="" id="search_end" class="no-margin">
        <a class="input-group-label" title="Limpiar"><i class="fi-calendar size-24"></i></a>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="large-12 columns">
      Pendiente
    </div>
    <div class="large-12 columns">
      <select  class="no-margin" id="search_pendiente">
        <option value="-1"></option>
        <option value="01">Si</option>
        <option value="00">No</option>
      </select>
    </div>
  </div>
  <button class="close-button" data-close aria-label="Close modal" type="button">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
