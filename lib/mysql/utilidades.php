<?php 
class Utilidades {
    static function clear_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    static function clear_input_text($data) {
        $data = self::clear_input($data);
        // $data = str_replace('"', "'", $data);
        return utf8_decode($data);
    }
    static function clear_input_ruta($data) {
        $data = str_replace('\\', '\\\\', $data);
        $data = str_replace('"', '\"', $data);
        // $data = self::clear_input($data);
        return utf8_decode($data);
    }
    static function clear_input_id($data) {
        return self::validar_vacio_a_cero((self::clear_input($data)));
    }
    static function clear_input_date($data) {
        $l = explode("-", self::clear_input($data));
        if (count($l)==3) {
            return $l[2].'-'.$l[1].'-'.$l[0];
        } else {
            return '';
        }
    }
    static function clear_input_bool($data) {
        if (self::clear_input($data)=='true') {
            return '1';
        } elseif(self::clear_input($data)=='false') {
            return '0';
        }
    }
    static function fechas_de_militar_a_meridiano($in) {
        $in['meridiano'] = '';
        if ($in['hora'] == 0) {
            $in['hora'] = 12;
            $in['meridiano'] = 'am';
        } elseif ($in['hora']<12) {
            $in['meridiano'] = 'am';
        } elseif ($in['hora']==12) {
            $in['meridiano'] = 'pm';
        } elseif ($in['hora']>12) {
            $in['hora'] -=12;
            $in['meridiano'] = 'pm';	
        }
        if ($in['return']==='array') {
            return $in;
        } else {
            return sprintf("%02d:%02d %s"
            , $in['hora']
            , $in['minuto']
            , $in['meridiano']
            );	
        }
    }
    static function fechas_de_meridiano_a_militar($in) {
        if ( $in['hora'] == '12') {
            if ( $in['meridiano'] == 'am' ) {
                $in['hora'] = 0;
            }
        } else {
            if ( $in['meridiano'] == 'pm' ) {
                $in['hora'] += 12;
            }
        }
        if ($in['return']==='array') {
            return $in;
        } else {
            return sprintf("%02d:%02d"
            , $in['hora']
            , $in['minuto']
            );	
        }

    }
    static function fechas_de_MysqlTimeStamp_a_array($f) {
        $out = array();
        if ( strlen($f) == 19 ) {
            $l  = explode(' ',$f);
            $l1 = explode('-', $l[0]);
            $l2 = explode(':', $l[1]);
            $out = array (
                'anio' => $l1[0]
                , 'mes' => $l1[1]
                , 'dia' => $l1[2]
                , 'hora' => $l2[0]
                , 'minuto' => $l2[1]
                , 'segundo' => $l2[2]
            );
        }
        return $out;	
    }
    static function fechas_de_array_a_MysqlTimeStamp($a) {
        $out = '';    
        if ( is_array($a) ) {
            if ( isset( $a['anio'] ) )
                $out.= sprintf('%02d', $a['anio']);
            else
                $out.= '00';
            $out.= '-';	
            if ( isset( $a['mes'] ) )
                $out.= sprintf('%02d', $a['mes']);
            else
                $out.= '00';
            $out.= '-';
	
            if ( isset( $a['dia'] ) )
                $out.= sprintf('%02d', $a['dia']);
            else
                $out.= '00';
            $out.= ' ';

            if ( isset( $a['hora'] ) )
                $out.= sprintf('%02d', $a['hora']);
            else
                $out.= '00';
            $out.= ':';

            if ( isset( $a['minuto'] ) )
                $out.= sprintf('%02d', $a['minuto']);
            else
                $out.= '00';
            $out.= ':';
            if ( isset( $a['segundo'] ) )
                $out.= sprintf('%02d', $a['segundo']);
            else
                $out.= '00';
        } else {
            $out = '0000-00-00 00:00:00';
        }
        return $out;	
    }
    static function validar_vacio_a_cero($in) {
        $in = trim($in);
        if ($in=='') {
            return 0;
        } else {
            return $in;
        }
    }
    static function validar_true_false_string_to_boolean_or_01($in) {
        $in['value'] = trim($in['value']);
        if ( $in['return'] == 'boolean' ) {
            if ($in['value']=='') {
                return false;
            } elseif ($in['value']=='0') {
                return false;
            } elseif ($in['value']=='false') {
                return false;
            } elseif ($in['value']=='0') {
                return false;
            } elseif ($in['value']=='true') {
                return true;
            } elseif ($in['value']=='1') {
                return true;
            } else {
                return true;
            }
        }elseif ( $in['return'] == '01' ) {
            if ($in['value']=='') {
                return '0';
            } elseif ($in['value']=='false') {
                return '0';
            } elseif ($in['value']=='true') {
                return '1';
            } else {
                return '1';
            }
        }

    }
    static function sanear_string($string) {
        $string = trim($string);
        // $string = utf8_encode($string);
        $string = str_replace(
            array('á', 'à', 'ä', 'â', 'ª', 'Á', 'À', 'Â', 'Ä'),
            array('a', 'a', 'a', 'a', 'a', 'A', 'A', 'A', 'A'),
            $string
        );
        $string = str_replace(
            array('é', 'è', 'ë', 'ê', 'É', 'È', 'Ê', 'Ë'),
            array('e', 'e', 'e', 'e', 'E', 'E', 'E', 'E'),
            $string
        );
        $string = str_replace(
            array('í', 'ì', 'ï', 'î', 'Í', 'Ì', 'Ï', 'Î'),
            array('i', 'i', 'i', 'i', 'I', 'I', 'I', 'I'),
            $string
        );
        $string = str_replace(
            array('ó', 'ò', 'ö', 'ô', 'Ó', 'Ò', 'Ö', 'Ô'),
            array('o', 'o', 'o', 'o', 'O', 'O', 'O', 'O'),
            $string
        );
        $string = str_replace(
            array('ú', 'ù', 'ü', 'û', 'Ú', 'Ù', 'Û', 'Ü'),
            array('u', 'u', 'u', 'u', 'U', 'U', 'U', 'U'),
            $string
        );
        $string = str_replace(
            array('ç', 'Ç'),
            array('c', 'C'),
            $string
        );
        return $string;
    }
}

    

?>