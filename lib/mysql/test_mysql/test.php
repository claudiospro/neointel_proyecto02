<?php
// ---------------------------------------------- ini-libs
include('../dbconnector.php');
include('../conexion01.php');

class Example_Modelo {
    private $q;
    function __construct() {
        $this->q = new Query();        
    }
    function show_tables() {
        $this->q->fields = array(
            "name" => ""
        );
        $this->q->sql = "
           SHOW TABLES
           ";
        $this->q->data;
        return $this->q->exe();
    }
    function desc_table($name) {
        $this->q->fields = array(
            "field" => ""
            , "type" => ""
            , "null" => ""
            , "key" => ""
            , "default" => ""
            , "extra" => ""
        );
        $this->q->sql = "DESC $name";
        $this->q->data;
        return $this->q->exe();
    }
    function count_table($name) {
        $this->q->fields = array(
            "count" => ""
        );
        $this->q->sql = "
           SELECT COUNT(*) FROM " . $name
            ;
        $this->q->data = NULL;
        return $this->q->exe()[0]['count'];
    }
    function insert_table() {
        $this->q->fields = NULL;
        $this->q->sql = '
                INSERT INTO mensajes (mensaje, timestamp, status)
                VALUES (?, ?, ?)        
              '
            ;

        $mensaje = 'test mensaje';
        $timestamp= ' 2015-11-22';
        $status = 1;
        ;
        // isbd, integer, string, ¿?, decimal
        $this->q->data = array("ssi"
        , "{$mensaje}"
        , "{$timestamp}"
        , "{$status}"
        );
        $this->q->exe();
    }
}
// ---------------------------------------------------------
$model = new Example_Modelo();
$tables = $model->show_tables();
echo '<h2>tablas</h2>';
echo '<pre style="border: 1px solid; max-height: 6rem; overflow-y: scroll;">';
print_r($tables);
echo '</pre>';

$desc[$tables[0]['name']] = $model->desc_table($tables[0]['name']);
echo '<h2>Desc ' . $tables[0]['name'] . '</h2>';
echo '<pre style="border: 1px solid; max-height: 6rem; overflow-y: scroll;">';
print_r($desc);
echo '</pre>';

$count[$tables[0]['name']]['antes'] = $model->count_table($tables[0]['name']);
echo '<h2>Cantidad de elementos</h2>';
echo '<pre style="border: 1px solid">';
print_r($count);
echo '</pre>';

$model->insert_table();

$count[$tables[0]['name']]['despues'] = $model->count_table($tables[0]['name']);
echo '<h2>Cantidad de elementos</h2>';
echo '<pre style="border: 1px solid">';
print_r($count);
echo '</pre>';


