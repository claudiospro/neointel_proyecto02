<style>
 .timer-tramitacion {
     background-color: #acacac;
     color: white;
     font-size: 40px;
     padding: 15px 12px;
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
        <span class="item-1 active">Falta Aprobar</span>
        <span class="item-2">Falta Validar</span>
        <span class="item-3">Falta Cargar</span>
      </div>
      <div class="div00 div02">
        <a item="1" class="item-1 active">0</a>
        <a item="2" class="item-2">0</a>
        <a item="3" class="item-3">0</a>
      </div>
      <div style="clear:both"></div>
    </div>
  </div>
</div>
