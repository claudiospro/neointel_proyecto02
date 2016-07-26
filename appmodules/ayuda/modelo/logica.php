<?php
class LogicaAyuda {
    private $recurces = array();
    function __construct() {
        $l = explode(" ", trim($_SESSION['resources']));
        foreach($l as $row) {
            $this->resources[] = trim($row);
        }
    }
    function imprimirPermisos() {
        return $this->resources;
    }
    function permisoModulo($in) {
        if (array_search($in, $this->resources) === false)
            return false;
        else
            return true;    
    }
    static function img($src) {
        $path = '';
        echo '<img class="thumbnail" src="' . $src . '">';
    }
    static function esPerfil($in) {
        $l = explode("||", trim($in));
        $perfil = trim($_SESSION['perfiles']);
        $ou = false;
        foreach($l as $row)
        {
            if ($perfil == trim($row))
            {
                $ou = true;
                break;
            }
        }        
        return $ou;
    }
}