<?php
include "../../../../../lib/mysql/dbconnector.php";
include "../../../../../lib/mysql/conexion01.php";
include "../../../../../lib/mysql/utilidades.php";
include "../../../modelo/ModeloVenta.php";
 
require_once  '../../../../../lib/vendor/phpExcel-1.8.0/Classes/PHPExcel.php';

$border_style= array (
    'borders' => array (
        'allborders' => array (
            'style' => PHPExcel_Style_Border::BORDER_HAIR,
            'color' => array('argb' => '000000'),
        ),
    ),    
);

function getNameFromNumber($num) {
    $numeric = ($num - 1) % 26;
    $letter = chr(65 + $numeric);
    $num2 = intval(($num - 1) / 26);
    if ($num2 > 0) {
        return getNameFromNumber($num2) . $letter;
    } else {
        return $letter;
    }
}

function c0($num) {
    $numeric = ($num - 1) % 26;
    $letter = chr(65 + $numeric);
    $num2 = intval(($num - 1) / 26);
    if ($num2 > 0) {
        return c0($num2) . $letter;
    } else {
        return $letter;
    }
}

function c1($num, $i) {
    return c0($num) . $i;
}

function c2($num1, $num2, $i1, $i2) {
    return c0($num1) . $i1 . ':' . c0($num2) . $i2;
}
 
$objPHPExcel = new PHPExcel();
$objPHPExcel->getProperties()->setCreator("Claudio Rodriguez Ore");
 
session_start();
$venta = new ModeloVenta();
// -------------------------------------------------------- INPUT
$in['ini'] = Utilidades::clear_input($_GET['ini']);
$in['end'] = Utilidades::clear_input($_GET['end']);
 
// -------------------------------------------------------- Data
$ou = $venta->getDeclarativo_02($in);
 

 
// -------------------------------------------------------- TEST
// Utilidades::printr($in);
// Utilidades::printr($_SESSION);
// Utilidades::printr($campos);
// Utilidades::printr($ou);
 
// -------------------------------------------------------- OUT
$objPHPExcel->getActiveSheet()->setTitle('Data');
$objPHPExcel->setActiveSheetIndex(0);
 
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="data-' . date('Y-m-d His') . '.xls"');
header('Cache-Control: max-age=0');
// If you're serving to IE 9, then the following may be needed
header('Cache-Control: max-age=1');
 
// If you're serving to IE over SSL, then the following may be needed
header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
header ('Pragma: public'); // HTTP/1.0
 
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$objWriter->save('php://output');
exit;