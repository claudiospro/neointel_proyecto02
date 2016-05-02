<style>
 .timer-tramitacion {
     /*background-color: #acacac;*/
     background-color: #343434;
     /*color: white;*/
     color: #bab916;
     font-size: 26px;
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
     /*background-color: #858585;*/
     background-color: #7d7d7d;
     /*color: white;*/
     color: #000000;
     
     margin: 0 10px 0 0;
     padding: 0 10px;
 }
 .timer-tramitacion .div02 a.active{
     /*background-color: #646464;*/
     background-color: #d7d794;
 }
 .div00.div02 b {
     background-color: #b33a3a;
     color: transparent;
     margin: 0 10px 0 0;
 }
 
</style>

<div class="row">
  <div class="large-12 columns">
    <div class="timer-tramitacion" style="display:none">
      <div class="div00 div01">
        <span class="item-1 active"><u>Falta Aprobar</u> (Supervisor - Venta)</span>
        <span class="item-2"><u>Falta Validar</u> (BackOffice - Venta)</span>
        <span class="item-3"><u>Falta Cargar</u> (BackOffice - Venta)</span>
        <span class="item-4"><u>Falta Validar</u> (BackOffice - PostVenta)</span>
        <span class="item-5"><u>Falta Cita</u> (BackOffice - PostVenta)</span>
        <span class="item-6"><u>Falta Verificar Instalación</u> (BackOffice - PostVenta)</span>
      </div>
      <div class="div00 div02">
        <a item="1" data-open="timer-tramitacion_modal" class="item-1 active">0</a>
        <a item="2" data-open="timer-tramitacion_modal" class="item-2">0</a>
        <a item="3" data-open="timer-tramitacion_modal" class="item-3">0</a>
        <b>i</b>
        <a item="4" data-open="timer-tramitacion_modal" class="item-4">0</a>
        <a item="5" data-open="timer-tramitacion_modal" class="item-5">0</a>
        <a item="6" data-open="timer-tramitacion_modal" class="item-6">0</a>
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
