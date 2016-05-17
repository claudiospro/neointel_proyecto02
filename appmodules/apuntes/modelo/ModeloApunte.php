<?php 
class ModeloApunte {
    private $q;
    function __construct() {
        $this->q = new Query();        
    }
    function apuntes_get_pagina() {
        return 6;
    }
    function apuntes_listado($in) {
        $this->q->fields = array(
            'id' => '',
            'info_create_fecha' => '',
            'pendiente' => '',
            'telefono' => '',
            'texto' => '',
        );
        $this->q->sql = '
        SELECT id, info_create_fecha, pendiente, telefono, texto  FROM apunte
        WHERE info_create_user = "' . $in['user_id'] . '"        
        ';
        if ($in['search_ini'] != '') {
            $this->q->sql.= '
            AND info_create_fecha >= "' . $in['search_ini'] . ' 00:00:00"
            ';
        }
        if ($in['search_end'] != '') {
            $this->q->sql.= '
            AND info_create_fecha <= "' . $in['search_end'] . ' 23:59:59"
            ';
        }
        if ($in['search_pendiente'] != '-1') {
            $this->q->sql.= '
            AND pendiente = ' . $in['search_pendiente'] . '
            ';
        }
        $this->q->sql.= '
        ORDER BY 2 DESC
        LIMIT ' . ($in['pagina'] * $in['items'])  . ', ' .  $in['items'] . '
        ';
        // Utilidades::printr($this->q->sql);
        $this->q->data = NULL;
        $data = $this->q->exe();
        return $data;
    }
    function apuntes_item($in) {
        $this->q->fields = array(
            'id' => '',
            'info_create_fecha' => '',
            'pendiente' => '',
            'telefono' => '',
            'texto' => '',
        );
        $this->q->sql = '
        SELECT id, info_create_fecha, pendiente, telefono, texto  FROM apunte
        WHERE id = "' . $in['id'] . '"
        ';
        // Utilidades::printr($this->q->sql);
        $this->q->data = NULL;
        $data = $this->q->exe();
        return $data[0];
    }
    function apuntes_save($in) {
        $this->q->fields = array(
        );
        if ($in['id'] != '0')
        {
            $this->q->sql = '
            UPDATE apunte SET
              texto = "' . $in['texto'] . '"
            , pendiente = "' . $in['pendiente'] . '"
            , telefono = "' . $in['telefono'] . '"
            , info_update_fecha = "' . $in['fecha'] . '"
            , info_update_user  = "' . $in['user_id'] . '"
            WHERE id = "' . $in['id'] . '"
            ';
        }
        else {
            $this->q->sql = '
            INSERT INTO apunte (texto, pendiente, telefono, info_create_fecha, info_create_user)
            VALUES(
                   "' . $in['texto'] . '"
                 , "' . $in['pendiente'] . '"
                 , "' . $in['telefono'] . '"
                 , "' . $in['fecha'] . '"
                 , "' . $in['user_id'] . '"
            )
            ';
        }
        // Utilidades::printr($this->q->sql);
        $this->q->data = NULL;
        $this->q->exe();
    }
}
