<?php

$json = array();
for ($i=0; $i<= 100; $i++) {
    $tmp = array();
    $tmp['value'] = 'value-'.$i.'-'.$_REQUEST['campo'];
    $tmp['label'] = 'label-'.$i.'-'.$_REQUEST['campo'];
    $json[]=$tmp;
}
echo json_encode($json);