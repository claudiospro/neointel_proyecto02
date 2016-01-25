<?php

abstract class Tabla {

    protected $index = array();
    protected $id;
    protected $class;
    protected $name;
    protected $utf8=FALSE;


    public function set_index($name, $value) {
        $this->index = array('name' => $name, 'value' => $value);
    }

    public function set_name($name) {
        $this->name = $name;
    }

    public function set_class($class) {
        $this->class = $class;
    }

    public function set_id($id) {
        $this->id = $id;
    }
    public function set_utf8() {
        $this->utf8 = TRUE;
    }

    protected function ini_table() {
        
    }

    protected function end_table() {
        
    }

    protected function ini_tr() {
        
    }

    protected function end_tr() {
        
    }

    protected function td() {
        
    }

}

abstract class TablaSimple extends Tabla {

    function imprimir($data) {
        $this->ini_table();
	$tot = count($data);
        for ($i = 0; $i < $tot; $i++) {
	    $this->ini_tr($data[$i]);
	    $this->td($data[$i]);
	    $this->end_tr($data[$i]);	  
        }/* end foreach */
        $this->end_table();
    }

}

class ComboSimple extends TablaSimple {

    protected $label;
    protected $option;
    protected $format;

    public function set_label($label) {
        $this->label = $label;
    }

    public function set_option($option) {
        $this->option = $option;
    }

    public function set_format($format) {
        $this->format = $format;
    }

    protected function ini_table() {
        printf(''
                . '<select id="%s" class="%s" name="%s">'
                , $this->id
                , $this->class
                , $this->name
        );
        if (isset($this->label)) {
            printf(''
                    . '<option value="0">%1$s</option>'
                    , $this->label
            );
        }
    }

    protected function end_table() {
        printf('</select>');
    }

    protected function td($args) {
        $selected = '';
        if ($args[$this->format[0]] == $this->option) {
            $selected = 'selected';
        }
	
        printf(''
                . '<option %3$s value="%1$s">%2$s</option>'
                , $args[$this->format[0]]
	       , utf8_encode( $args[$this->format[1]] )
                , $selected
        );
    }

}

class ComboSimple_Upper extends TablaSimple {

    protected $label;
    protected $option;
    protected $format;

    public function set_label($label) {
        $this->label = $label;
    }

    public function set_option($option) {
        $this->option = $option;
    }

    public function set_format($format) {
        $this->format = $format;
    }

    protected function ini_table() {
        printf(''
                . '<select id="%s" class="%s" name="%s">'
                , $this->id
                , $this->class
                , $this->name
        );
        if (isset($this->label)) {
            printf(''
                    . '<option value="0">%1$s</option>'
                    , $this->label
            );
        }
    }

    protected function end_table() {
        printf('</select>');
    }

    protected function td($args) {
        $selected = '';
        if ($args[$this->format[0]] == $this->option) {
            $selected = 'selected';
        }
	
        printf(''
                . '<option %3$s value="%1$s">%2$s</option>'
                , $args[$this->format[0]]
	       , utf8_encode( strtoupper( $args[$this->format[1]] ) )
                , $selected
        );
    }

}

class OptionComboSimple extends ComboSimple {
    protected function ini_table() {
	print '<option value=""></option>';
    }
    protected function end_table() {
        print '';
    }
}
class OptionComboSimple0 extends ComboSimple {
    protected function ini_table() {
	print '';
    }
    protected function end_table() {
        print '';
    }
}

class OptionComboSimple_Upper extends ComboSimple_Upper {
    protected function ini_table() {
	print '<option value=""></option>';
    }
    protected function end_table() {
        print '';
    }
}

class TablaAdminSimple extends TablaSimple {

    protected $th;

    public function set_th($th) {
        $this->th = $th;
    }

    protected function ini_table() {
        printf(''
                . '<table id="%s" class="%s">'
                , $this->id
                , $this->class
        );
        if (isset($this->th)):
            printf(''
		   . '<thead><tr>%s</tr></thead><tbody>'
		   , $this->th
            );
        endif;
    }

    protected function end_table() {
        print '</tbody></table>';
    }

    protected function ini_tr($args) {
        printf(''
	       . '<tr id="%s-tr-%s" codigo="%s">'
	       , $this->id
	       , $args[$this->index['name']]
	       , $args[$this->index['name']]
        );
    }

    protected function end_tr($args) {
        print '</tr>';
    }

    public function imprimir_tr($args) {
        printf('<tr id="%s-tr-%s" codigo="%s">'
	       , $this->id
	       , $args[$this->index['name']]
	       , $args[$this->index['name']]
	       );	
	$this->td($args);
	echo '</tr>';
    }
    public function imprimir_td($args) {
	$this->td($args);
    }
}

abstract class TablaDoble extends Tabla {

    function imprimir($data) {
        $anterior = $data[0][$this->index['name']];
        $data[] = array($this->index['name'] => $this->index['value']);
        $this->ini_table();
        $this->ini_tr($data[0]);
        for ($i = 0; $i < count($data) - 1; $i++) {
            $actual = $data[$i][$this->index['name']];
            if ($anterior != $actual) {
                $this->end_tr($data[$i - 1]);
                $this->ini_tr($data[$i]);
                $anterior = $actual;
            }
            $this->td($data[$i]);
        }/* end foreach */
        $this->end_tr($data[count($data) - 2]);
        $this->end_table();
    }

}
