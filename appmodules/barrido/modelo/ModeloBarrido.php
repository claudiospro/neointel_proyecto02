<?php 
class ModeloBarrido {
    private $q;
    function __construct() {
        $this->q = new Query();        
    }
    function getEstadosReales() {
        $this->q->fields = array(
            'id' => '',
            'nombre' => '',
        );
        $this->q->sql = '
        SELECT id, nombre FROM venta_estado_real WHERE info_status= 1 
        ';
        // echo $this->q->sql;        
        $this->q->data = NULL;
        $data = $this->q->exe();
        return $data;
    }
    function updateVenta($in) {
        $this->q->fields = array();
        $this->q->sql = '
        UPDATE venta_' . $in['campania'] . ' SET estado_real="' . $in['estado_real'] . '" WHERE id="' . $in['id'] . '"
        ';
        // echo $this->q->sql . '\n';
        $this->q->data = NULL;
        $this->q->exe();
    }    
}
