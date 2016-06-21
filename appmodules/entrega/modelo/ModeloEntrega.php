<?php 
class ModeloEntrega {
    private $q;
    function __construct() {
        $this->q = new Query();        
    }
    //
    function getCampaniaActivasParaEntrega($in) {
        $this->q->fields = array(
            'id' => '',
            'nombre' => '',
        );        
        $this->q->sql = '
        SELECT DISTINCT c.indice, c.nombre FROM campania c
        JOIN campania_lineal cl ON cl.campania_id = c.id
        WHERE c.info_status = 1 AND c.entrega=1';
        if ('' != trim($in['lineas'])) {
            $this->q->sql.= ' AND cl.lineal_id IN (' . $in['lineas'] . ')';
        }
        // echo $this->q->sql;        
        $this->q->data = NULL;
        $data = $this->q->exe();
        return $data;
    }
    function getEstadoReal($in) {
        $this->q->fields = array(
            'id' => '',
            'nombre' => '',
        );        
        $this->q->sql = '
        SELECT id, nombre FROM venta_estado_real 
        WHERE info_status = 1 AND campania LIKE "%' . $in['campania'] . '%"';
        // echo $this->q->sql;        
        $this->q->data = NULL;
        $data = $this->q->exe();
        return $data;
    }
    //
    function getCampaniaEditable($id) {
        $this->q->fields = array(
            'campania' => '',
        );
        $this->q->sql = '
        SELECT campania FROM venta where id = ' . $id . '
        ' ;
        // print $this->q->sql .'<br>';
        $this->q->data = NULL;
        $data = $this->q->exe();
        return $data[0]['campania'];
    }
    function getValorEditable($in) {
        $this->q->fields = array(
            'valor' => '',
        );
        $this->q->sql = '                                                                             
        SELECT ' . $in['campo']  . ' FROM venta_' . $in['campania'] . ' 
        WHERE id = "' . $in['id'] . '"
        ' ;
        // print $this->q->sql .'<br>';
        $this->q->data = NULL;
        $data = $this->q->exe();
        return $data[0]['valor'];
    }
    function setValorEditable($in) {
        $this->q->fields = array(
        );
        $this->q->sql = '
        UPDATE venta_' . $in['campania'] . ' SET ' . $in['campo']  . ' = "' . $in['valor']  . '" 
        WHERE id = "' . $in['venta_id'] . '"
        ';
        // print $this->q->sql;
        $this->q->data = NULL;
        $this->q->exe();
    }
    function setSQL($fields, $sql) {
        $this->q->fields = $fields;
        $this->q->sql = $sql;
        // print $this->q->sql .'<br>';
        $this->q->data = NULL;
        $data = $this->q->exe();
        return $data;
    }
    
}
