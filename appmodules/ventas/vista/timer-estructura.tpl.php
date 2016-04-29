<style>
 .timer-tramitacion {
     background-color: #acacac;
     color: white;
     font-size: 30px;
     padding: 10px;
 }
 .timer-tramitacion .div00 {
 }
 .timer-tramitacion .div01 {
     float: left;
 }
 .timer-tramitacion .div01 span {
     display:none;
 }
 .timer-tramitacion .div01 span.active {
     display:inline;
 }
 .timer-tramitacion .div02 {
     text-align: right;
 }
 .timer-tramitacion .div02 a{
     background-color: #858585;
     color: white;
     margin: 0 10px 0 0;
     padding: 0 10px;
 }
 .timer-tramitacion .div02 a.active{
     background-color: #646464;
 }
 
</style>

<div class="row">
  <div class="large-12 columns">
    <div class="timer-tramitacion" style="display:none">
      <div class="div00 div01">
        <span class="item-1 active">Falta Aprobar (Supervisor - Venta)</span>
        <span class="item-2">Falta Validar (BackOffice - Venta)</span>
        <span class="item-3">Falta Cargar (BackOffice - Venta)</span>
      </div>
      <div class="div00 div02">
        <a item="1" data-open="timer-tramitacion_modal" class="item-1 active">0</a>
        <a item="2" data-open="timer-tramitacion_modal" class="item-2">0</a>
        <a item="3" data-open="timer-tramitacion_modal" class="item-3">0</a>
      </div>
      <div style="clear:both"></div>
    </div>
  </div>
</div>
<div class="reveal full"
     id="timer-tramitacion_modal"
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
