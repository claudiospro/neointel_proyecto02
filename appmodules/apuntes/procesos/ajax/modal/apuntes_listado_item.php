<?php
include "../../../../../lib/mysql/dbconnector.php";
include "../../../../../lib/mysql/conexion01.php";
include "../../../../../lib/mysql/utilidades.php";
include "../../../modelo/ModeloApunte.php";
session_start();
$prefix = 'apuntes_listado_';
$modelo = new ModeloApunte();
// -------------------------------------------------------- INPUT
$in['id']  = Utilidades::clear_input_id($_POST['id']);


// --------------------------------------------------------- DATA
if ($in['id'] != '0')
{
    $ou = $modelo->apuntes_item($in);
}
else
{
    $ou = array('id' => '0'
              , 'info_create_user' => ''
              , 'pendiente' => 1
              , 'telefono' => ''
              , 'texto' => ''
    );
}


// --------------------------------------------------------- TEST
// Utilidades::printr($in);
// Utilidades::printr($ou);


// ------------------------------------------------------- OUTPUT
?>
<div class="formulario">
  <input type="hidden" class="apunte-id" value="<?php echo $ou['id'] ?>">
  <?php $pendiente = array( 1 => 'Si', 0 => 'No') ?>
  <div class="row">
    <div class="large-3 medium-4 small-5 columns">
      Pendiente
    </div>
    <div class="large-2 medium-3 small-4 columns">
      <select class="apunte-pendiente no-margin">
        <?php
        foreach($pendiente as $key => $value)
        {
            if ($key == $ou['pendiente'])
                echo '<option value="' . $key . '" selected>' . $value . '</option>';
            else
                echo '<option value="' . $key . '">' . $value . '</option>';
        }
        ?>
      </select>
    </div>
    <div class="large-1 medium-1 small-1 columns">
    </div>
  </div>

  <div class="row">
    <div class="large-3 medium-4 small-5 columns">
      Teléfono
    </div>
    <div class="large-9 medium-8 small-7 columns">
      <input class="apunte-telefono no-margin" 
             value="<?php echo utf8_decode($ou['telefono']) ?>"
             type="text"
             
      >
    </div>
  </div>
  
  <textarea class="apunte-texto" style=""><?php echo utf8_decode($ou['texto']) ?></textarea>
  <a class="button tiny no-margin apunte-save" data-close>Guardar</a>
</div>


<script>
tinymce.init({
    body_class: 'formulario',
    selector:'textarea.apunte-texto',
    hidden_input: false,
    elementpath: true,
    height: 200,
    menubar: false,
    toolbar: 'bold italic underline strikethrough removeformat',
    language: 'es',
    force_br_newlines: true,
    force_p_newlines: false,
    forced_root_block: '',    
});
</script>

