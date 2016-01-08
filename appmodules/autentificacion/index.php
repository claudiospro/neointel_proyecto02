<?php 
require_once 'modelo/logica.php';

if(!ModeloAuten::exist()) {
    require 'vista/no-autenticado.tpl.php';
} else {
    require 'vista/autenticado.tpl.php';
}

