<?php

if (!isset($in['campania']))
{
    $in['campania'] = 'campania_001';
}

$timerEstructura['campania_001']['1'] = '<u>Falta Aprobar</u> (Supervisor - Venta)';
$timerEstructura['campania_001']['2'] = '<u>Falta Validar</u> (BackOffice - Venta)';
$timerEstructura['campania_001']['3'] = '<u>Falta Cargar</u> (BackOffice - Venta)';
$timerEstructura['campania_001']['4'] = '<u>Pendiente de Validación Externa</u> (BackOffice - PostVenta)';
$timerEstructura['campania_001']['5'] = '<u>Pendiente de Cita</u> (BackOffice - PostVenta)';
$timerEstructura['campania_001']['6'] = '<u>Pendiente de Instalación</u> (BackOffice - PostVenta)';

$timerEstructura['campania_002']['1'] = '<u>Falta Aprobar</u> (Supervisor - Venta)';
$timerEstructura['campania_002']['2'] = '<u>Falta Validar</u> (BackOffice - Venta)';
$timerEstructura['campania_002']['3'] = '<u>Falta Cargar</u> (BackOffice - Venta)';
$timerEstructura['campania_002']['4'] = '<u>Pendiente de Validación Externa</u> (BackOffice - PostVenta)';
$timerEstructura['campania_002']['5'] = '<u>Pendiente de Cita</u> (BackOffice - PostVenta)';
$timerEstructura['campania_002']['6'] = '<u>Pendiente de Instalación</u> (BackOffice - PostVenta)';

$timerEstructura['campania_003']['1'] = '';
$timerEstructura['campania_003']['2'] = '';
$timerEstructura['campania_003']['3'] = '';
$timerEstructura['campania_003']['4'] = '<u>Pendiente de Validación Externa</u> (BackOffice - PostVenta)';
$timerEstructura['campania_003']['5'] = '<u>Pendiente de Cita</u> (BackOffice - PostVenta)';
$timerEstructura['campania_003']['6'] = '<u>Pendiente de Instalación</u> (BackOffice - PostVenta)';

?>

<div class="row">
  <div class="large-12 columns">
    <div class="timer-tramitacion" style="display:none">
      <div class="div00 div01">
        <span class="item-1 active"><?php if (isset($timerEstructura[ $in['campania'] ]['1'])) echo $timerEstructura[ $in['campania'] ]['1'] ?></span>
        <span class="item-2">       <?php if (isset($timerEstructura[ $in['campania'] ]['2'])) echo $timerEstructura[ $in['campania'] ]['2'] ?></span>
        <span class="item-3">       <?php if (isset($timerEstructura[ $in['campania'] ]['3'])) echo $timerEstructura[ $in['campania'] ]['3'] ?></span>
        <span class="item-4">       <?php if (isset($timerEstructura[ $in['campania'] ]['4'])) echo $timerEstructura[ $in['campania'] ]['4'] ?></span>
        <span class="item-5">       <?php if (isset($timerEstructura[ $in['campania'] ]['5'])) echo $timerEstructura[ $in['campania'] ]['5'] ?></span>
        <span class="item-6">       <?php if (isset($timerEstructura[ $in['campania'] ]['6'])) echo $timerEstructura[ $in['campania'] ]['6'] ?></span>
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
