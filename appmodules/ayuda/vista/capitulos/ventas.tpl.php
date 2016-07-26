<div class="callout">
  Menu &#x25B8; Ventas
</div>
<?php if(LogicaAyuda::esPerfil('Supervisor || Asesor Comercial')):  ?>
  <h2>Boton Añadir Venta</h2>
  <p>
    <?php LogicaAyuda::img('./images/introduccion/02.jpg') ?>
  </p>
  <ul>
    <li><span class="success label">+</span> Boton para Añadir Venta</li>
    <li><span class="secondary label">Vodafone One</span> esta es la campaña a añadir</li>
  </ul>
<?php endif ?>


<?php if(LogicaAyuda::esPerfil('Admin || Gerencia || Tramitacion || Supervisor || Asesor Comercial || Coordinador || Tramitacion-Carga || Tramitacion-Validacion || Tramitacion-Validacion-Carga')):  ?>
  <h2>Cambiar Campaña</h2>
  <p>
    <?php LogicaAyuda::img('./images/introduccion/03.jpg') ?>
  </p>
  <ul>
    <li>puede cambiar a otras campañas</li>  
  </ul>
<?php endif ?>


<?php if(LogicaAyuda::esPerfil('Admin || Gerencia || Tramitacion || Supervisor || Asesor Comercial || Coordinador || Tramitacion-Carga || Tramitacion-Validacion || Tramitacion-Validacion-Carga')):  ?>
  <h2>Listado Ventas</h2>
  <p>
    <?php LogicaAyuda::img('./images/introduccion/04.jpg') ?>
    El lista contiene todas las ventas, vamos a  revisar los elementos, estos son los listados generales
  </p>
  <ul>
    <li><span class="alert label">Filtros</span> Es el criterio de filtrado de la venta, hay que tener en
      cuenta lo siguiente:  cuando esta de color blanco es que no esta haciendo filtro, pero cuado esta de
      color verde esta filtrando <br>
      <?php LogicaAyuda::img('./images/introduccion/05.jpg') ?>
    </li>
    <li><span class="alert label">Orden</span> Con esto se indica que columna ordena a el listado, en este
      ejemplo esta ordena do por la "Fecha de Creación" de Forma Descendente, para cambiar de criterio
      solo falta dar click al nombre de la Columna </li>
    <li><span class="alert label">Cantidad de Entradas</span> Esto se refiere a la cantidad total de
      ventas</li>  
  </ul>
<?php endif ?>


<h2>Acciones</h2>
<ul>
  <?php if(LogicaAyuda::esPerfil('Admin || Gerencia || Tramitacion || Supervisor || Coordinador || Tramitacion-Carga || Tramitacion-Validacion || Tramitacion-Validacion-Carga')):  ?>
    <li> <?php LogicaAyuda::img('./images/introduccion/06.jpg') ?>Editar la venta creada </li>
  <?php endif ?>
  <?php if(LogicaAyuda::esPerfil('Admin || Gerencia || Tramitacion || Supervisor || Asesor Comercial || Coordinador || Tramitacion-Carga || Tramitacion-Validacion || Tramitacion-Validacion-Carga')):  ?>
    <li> <?php LogicaAyuda::img('./images/introduccion/07.jpg') ?>Ver todos los datos de la venta </li>
  <?php endif ?>
  <?php if(LogicaAyuda::esPerfil('Admin || Gerencia || Coordinador')):  ?>
    <li> <?php LogicaAyuda::img('./images/introduccion/08.jpg') ?>Ver Los cambios de la venta </li>
  <?php endif ?>
  <?php if(LogicaAyuda::esPerfil('Admin || Gerencia || Tramitacion || Coordinador || Tramitacion-Carga || Tramitacion-Validacion || Tramitacion-Validacion-Carga')):  ?>
    <li> <?php LogicaAyuda::img('./images/introduccion/09.jpg') ?>Cambia el estado Si(Eliminado) ocultado la venta a los demas, si quiere recuperarla dale click de
      nuevo al mismo boton </li>
  <?php endif ?>
</ul>
