<?php 
class ModeloBarrido {
    private $q;
    function __construct() {
        $this->q = new Query();        
    }
    function getEstados() {
        $this->q->fields = array(
            'id' => '',
            'nombre' => '',
        );
        $this->q->sql = '
        SELECT id, nombre FROM venta_estado WHERE info_status= 1 
        ';
        // echo $this->q->sql;        
        $this->q->data = NULL;
        $data = $this->q->exe();
        return $data;
    }
    function updateVenta($in) {
        $this->q->fields = array();
        $this->q->data = NULL;
        // estado
        $this->q->sql = '
        UPDATE venta_' . $in['campania'] . ' SET estado="' . $in['estado'] . '" WHERE id="' . $in['id'] . '"
        ';
        // echo $this->q->sql . '\n';
        $this->q->exe();
        // usuario
        $this->q->sql = '
        UPDATE venta SET info_update_user="' . $in['usuario'] . '", info_update_fecha="' . $in['fecha'] . '" WHERE id="' . $in['id'] . '"
        ';
        $this->q->exe();
    }    
}
