<?php
include "../../../../../lib/mysql/dbconnector.php";
include "../../../../../lib/mysql/conexion01.php";
include "../../../../../lib/mysql/utilidades.php";
include "../../../modelo/ModeloUsuario.php";
session_start();
$modelo = new ModeloUsuario();
// -------------------------------------------------------- INPUT
$in['usuario_id'] = Utilidades::clear_input_id($_POST['usuario_id']);
$in['perfil'] = trim($_SESSION['perfiles']);

// -------------------------------------------------------- Data
$dato = $modelo->getUsuario($in);
$form['usuario_id']   = array('type' => 'hidden'  , 'label' => '');
$form['nombre']       = array('type' => 'text'    , 'label' => 'Nombre');
$form['nombre_corto'] = array('type' => 'text'    , 'label' => 'Nombre Corto');
$form['login']        = array('type' => 'text'    , 'label' => 'Usuario (DNI)');
$form['pwd']          = array('type' => 'pwd'     , 'label' => 'Contraseña');
$form['perfil_id']    = array('type' => 'select1' , 'label' => 'Perfil', 'combo' => 'usu_perfil');
$form['vigente']      = array('type' => 'bool'    , 'label' => 'Vigente');
$form['comentario']   = array('type' => 'textarea', 'label' => 'Comentario');

$combo['usu_perfil'] = $modelo->getPerfil($in);

$grupos = $modelo->getGrupoByUsuario($in);


// -------------------------------------------------------- TEST
// Utilidades::printr($in);
// Utilidades::printr($_SESSION);
// Utilidades::printr($dato);
// Utilidades::printr($grupos);

// -------------------------------------------------------- OUT
echo '<form class="myform">';
echo '<div class="row">';
echo '<div class="large-12 medium-12 small-12 columns">';
foreach($form as $name => $row) {
    if ($row['type'] == 'hidden') {
        echo '<input type="hidden" 
                     name = "' . $name . '"
                     id = "field_' . $name . '"
                     value="' . utf8_encode($dato[$name]) . '"
              >';
    } elseif ($row['type'] == 'text') {
        echo '<div class="row">';
        echo '<div class="large-3  medium-3 small-3 columns">' . $row['label'] . '</div>';
        echo '<div class="large-9 medium-9 small-9 columns" style="background-color: #71b4e4">
                <input type="text"
                       name = "' . $name . '"
                       value="' . utf8_encode($dato[$name]) . '"
                       class="no-margin" 
                />
              </div>';
        echo '</div>';
    } elseif ($row['type'] == 'pwd') {
        echo '<div class="row">';
        echo '<div class="large-3  medium-3 small-3 columns">' . $row['label'] . '</div>';
        echo '<div class="large-9 medium-9 small-9 columns" style="background-color: #71b4e4">
                <a class="reseteo-pwd button warning no-margin" nombre="' . $name . '">Resetear</a>
              </div>';
        echo '</div>';
    } elseif ($row['type'] == 'textarea') {
        echo '<div class="row">';
        echo '<div class="large-3  medium-3 small-3 columns">' . $row['label'] . '</div>';
        echo '<div class="large-9 medium-9 small-9 columns" style="background-color: #71b4e4">
                <textarea name = "' . $name . '"
                          rows = "2"
                          class="no-margin">' . utf8_encode($dato[$name]) . '</textarea>
              </div>';
        echo '</div>';
    } elseif ($row['type'] == 'bool') {
        $checked = '';
        if ($dato[$name] == '1') {
            $checked = 'checked';
        }
        echo '<div class="row">';
        echo '<div class="large-3  medium-3 small-3 columns">' . $row['label'] . '</div>';
        echo '<div class="large-9 medium-9 small-9 columns" style="background-color: #71b4e4">
                <input type ="checkbox" 
                       name = "' . $name . '"
                       style="margin: 6px 0 0 0"
                       ' . $checked . ' 
                />
              </div>';
        echo '</div>';
    } elseif ($row['type'] == 'select1') {
        echo '<div class="row">';
        echo '<div class="large-3  medium-3 small-3 columns">' . $row['label'] . '</div>';
        echo '<div class="large-9 medium-9 small-9 columns" style="background-color: #71b4e4">
                <select name = "' . $name . '"
                        id = "field_' . $name . '"
                        class="no-margin"
                >';
        foreach ($combo[$row['combo']]  as $r) {
            $selected = '';
            if ($r['id'] == $dato[$name])
                $selected = 'selected';
            echo '<option value="' . $r['id'] . '" ' . $selected . '>' . $r['nombre'] . '</option>';
        }
        echo '</select>';
        echo '</div>';
        echo '</div>';
    }
}
echo '<div class="row">';
echo '<div class="large-3  medium-3 small-3 columns">Grupos</div>';
echo '<div class="large-9 medium-9 small-9 columns" style="background-color: #71b4e4">';
if (isset($grupos))
{
    foreach($grupos as $row)
    {
        $checked = '';
        if ($row['usuario_id'] != '')
            $checked = 'checked';
        echo '<input type="checkbox"
                     name="lineales[' . $row['id'] . ']"
                     class="no-margin item-grupo"
                     ' . $checked . '
              />';
        echo utf8_encode($row['nombre']) . ' (' . utf8_encode($row['campania']) . ')<br>';
    }
}
echo '</div>';
echo '</div>';
echo '</div>';
echo '</div><!-- row -->';

$display = 'display:none';
if($dato['perfil'] == 'Supervisor'  || $dato['perfil'] == 'Coordinador') {
    $display = '';
}

echo '
      <div class="row ">
         <div class="large-12 medium-12 small-12 columns text-right no-padding">
           <a class="button no-margin validar" style="' . $display . '">Validar</a>
           <a data-close="" class="button success no-margin save-exit">Guardar y Cerrar</a>
         </div>
      </div>
';
echo '</form>';
?>
