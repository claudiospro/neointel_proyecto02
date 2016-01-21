<?php 
class ModeloVenta {
    private $q;
    function __construct() {
        $this->q = new Query();        
    }
    function getUbigeo($in) {
        $this->q->fields = array();
        $this->q->sql = '
        UPDATE ubigeo SET nombre="' . $in['nombre'] . '", info_update="' . $in['info_update'] . '" 
        WHERE id="' . $in['id'] . '"
        ';
        print $this->q->sql;
        
        $this->q->data = NULL;
        $this->q->exe();
    }

}
