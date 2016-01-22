<?php 
class ModeloVenta {
    private $q;
    function __construct() {
        $this->q = new Query();        
    }
    function getCampos($in) {
        $this->q->fields = array(
            'grupo' => '',
            'grupo_etiqueta' => '',
            'nombre' => '',
            'etiqueta' => '',
            'tabla' => '',
            'diccionario' => '',
            'tipo' => '',
            'perfiles' => '',
            'permisos' => ''
        );
        $this->q->sql = '
        SELECT
          grupo
        , grupo_etiqueta
        , nombre
        , etiqueta
        , tabla
        , diccionario
        , tipo
        , perfiles
        , permisos
        FROM venta_' . $in['campania'] . '_campos
        ORDER BY orden
        ';
        // echo $this->q->sql;        
        $this->q->data = NULL;
        $data = $this->q->exe();
        return $data;
    }
    function getUnDato($in) {
        $this->q->fields = $in['fields'];
        $this->q->sql = '
        SELECT * FROM venta_' . $in['campania'] . '
        WHERE id="' . $in['venta_id'] . '"
        ';
        // echo $this->q->sql;        
        $this->q->data = NULL;
        $data = $this->q->exe();
        return $data[0];
    }
    function imprimirCampo($dato, $campo) {
        if ($campo['diccionario']!='0') {
            $this->q->fields = array(
                'nombre' => ''
            );
            $this->q->sql = '
            SELECT
            nombre
            FROM venta_' . $campo['nombre'] . '
            WHERE id="' . $dato . '"
            ';
            $this->q->data = NULL;
            $dato = $this->q->exe();
            $dato = $dato[0]['nombre'];
        }
        if ('TIMESTAMP' == strtoupper($campo['tipo'])) {
            $dato = substr($dato, 0, 10);
        } else {
            $dato = utf8_encode($dato);
        }

        return $dato;
    }
}
