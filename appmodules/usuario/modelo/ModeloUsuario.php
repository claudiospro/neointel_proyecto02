<?php 
class ModeloVenta {
    private $q;
    function __construct() {
        $this->q = new Query();        
    }
    function getGrupo($in) {
        $this->q->fields = array(
            'id' => '',
            'nombre' => '',
        );
        $this->q->sql = '
        SELECT l.id, concat(l.nombre, ": ", u.nombre_corto) nombre
        FROM lineal l
        JOIN usu_usuario_lineal ul ON ul.lineal_id=l.id
        JOIN usu_usuario_perfil up ON up.usuario_id=ul.usuario_id AND up.perfil_id = 4
        JOIN usu_usuario u ON u.id=ul.usuario_id
        WHERE l.info_status = 1
        ';
        // echo $this->q->sql;        
        $this->q->data = NULL;
        $data = $this->q->exe();
        return $data;
    }
    function getPerfil($in) {
        $this->q->fields = array(
            'id' => '',
            'nombre' => '',
        );
        $this->q->sql = '
        SELECT id, nombre FROM usu_perfil
        ';
        // echo $this->q->sql;        
        $this->q->data = NULL;
        $data = $this->q->exe();
        return $data;
    }
}
