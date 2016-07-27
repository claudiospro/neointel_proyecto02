<?php $perfiles = trim($_SESSION['perfiles']); ?>
<form action="index.php">
  <div class="row">
    <div class="large-3 medium-5 small-12 columns">
      <select name="campania_id" id="campania_id" class="no-margin">
        <option value="<?php echo $in['campania_id']  ?>"></option>
      </select>
    </div>
    <div class="large-3 medium-5 small-9 columns">
      <select id="tipo" name="tipo" class="no-margin" style="font-size:.8em">
        <?php
        $ll = array('1'=> 'Estados',
                    '2'=>'Tipo Cliente',
                    '7'=>'Producto',
                    '3'=>'Comparativo de Asesores Activos',
                    '4'=>'Comparativo de Asesores Cesados',
                    '5'=>'Historico',                    
        );
        if ($perfiles == 'Admin' || $perfiles == 'Gerencia')
        {
            $ll['6'] = 'Ventas Instaladas Fecha';
        }
        $total = count($ll);
        foreach($ll as $i => $row)
        {
            $selected = '';
            if ($i === (int)$in['tipo'])
            {
                $selected = 'selected';
            }
            printf('<option value="%\'.02d" ' . $selected . '>%s</option>'
                 , $i, $row
            );
        }
        ?>
      </select>
    </div>
    <div class="large-2 medium-2 small-3 columns" id="rango_fechas_div">
      <select  name="rango_fechas" id="rango_fechas" class="no-margin" style="font-size:.8em">
        <?php
        $ll = array('1'=> 'Día',
                    '2'=> 'Semana',
                    // '3'=> '14 Días',
                    '4'=> 'Mes',
        );
        foreach($ll as $k => $r)
        {
            $selected = '';
            if ($k === (int)$in['rango_fechas'])
            {
                $selected = 'selected';
            }

            printf('<option value="%\'.02d" ' . $selected . '>%s</option>'
                 , $k, $r
            );            
        }
        ?>        
      </select>
    </div>
    <div class="large-2 medium-2 small-3 columns" id="cliente_tipo_div">
      <select  name="cliente_tipo" id="cliente_tipo" class="no-margin" style="font-size:.8em">
        <option value="<?php echo $in['cliente_tipo'] ?>"></option>
      </select>
    </div>
    <div class="large-1 medium-2 small-3 columns">
      <button type="submit" class="button no-margin expanded success">Ver</button>
    </div>
    <div class="large-1 medium-1 small-1 columns"></div>
  </div>  
  <div class="row">
    <div class="large-6 medium-6 small-12 columns">
      <div class="row">
        <div class="large-4  medium-2  small-2  columns">
          Inicio
        </div>
        <div class="large-6  medium-7  small-7  columns">
          <div class="input-group datapicker-month no-margin">
            <input type="text" id="anio-mes-ini" name="anio-mes-ini" readonly="" class="no-margin" value="<?php echo $in['anio-mes-ini'] ?>" >
            <a class="input-group-label" title="Limpiar"><i class="fi-calendar size-24"></i></a>
          </div>
        </div>
        <div class="large-2  medium-3  small-3  columns">
          <select id="dia-ini" name="dia-ini" class="no-margin">
            <option value="00"></option>
            <?php
            for($i = 1; $i<=31; $i++)
            {
                $selected = '';
                if ($i === (int)$in['dia-ini'])
                {
                    $selected = 'selected';
                }
                printf('<option value="%\'.02d" ' . $selected . '>%\'.02d</option>'
                     , $i, $i
                );
            }            
            ?>
          </select>
        </div>
      </div>
      <div class="row">
        <div class="large-4  medium-2  small-2  columns">
          Fin
        </div>
        <div class="large-6  medium-7  small-7  columns">
          <div class="input-group datapicker-month no-margin">
            <input type="text" id="anio-mes-end" name="anio-mes-end" readonly="" class="no-margin" value="<?php echo $in['anio-mes-end'] ?>" >
            <a class="input-group-label" title="Limpiar"><i class="fi-calendar size-24"></i></a>
          </div>
        </div>
        <div class="large-2  medium-3  small-3  columns">
          <select id="dia-end" name="dia-end" class="no-margin">
            <option value="00"></option>
            <?php
            for($i = 1; $i<=31; $i++)
            {
                $selected = '';
                if ($i === (int)$in['dia-end'])
                {
                    $selected = 'selected';
                }
                printf('<option value="%\'.02d" ' . $selected . '>%\'.02d</option>'
                     , $i, $i
                );
            }            
            ?>
          </select>
        </div> 
      </div>
    </div>
    <div class="large-6 medium-6 small-12 columns">
      <?php if( 'Supervisor' != trim($_SESSION['perfiles'])): ?>
        <div class="row">
          <div class="large-3  medium-2  small-2  columns">
            Supervisor
          </div>
          <div class="large-9  medium-10  small-10  columns">
            <div id="supervisor"></div>
            <select id="supervisor_id" name="supervisor_id" class="no-margin">
              <option value="<?php echo $in['supervisor_id']  ?>"></option>
            </select>
          </div>
        </div>
      <?php else: ?>
        <input type="hidden" id="supervisor_id" name="supervisor_id" value="<?php echo $_SESSION['user_id'] ?>">
      <?php endif ?>
      <div class="row">
        <div class="large-3  medium-2  small-2  columns">
          Asesor
        </div>
        <div class="large-9  medium-10  small-10  columns">
          <div id="asesor_comercial"></div>
          <select id="asesor_comercial_id" name="asesor_comercial_id" class="no-margin">            
            <option value="<?php echo $in['asesor_comercial_id']  ?>"></option>
          </select>
        </div>
      </div>
    </div>
  </div>
</form>
