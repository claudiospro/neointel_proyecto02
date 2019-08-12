<?php
session_start();
include "../../../../../lib/mysql/dbconnector.php";
include "../../../../../lib/mysql/conexion01.php";
include "../../../../../lib/mysql/utilidades.php";
include "../../../modelo/ModeloVenta.php";
include "../table/datatables_libs.php";

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

$ou = [];

$objPHPExcel = new PHPExcel();
$objPHPExcel->getProperties()->setCreator("Claudio Rodriguez Ore");

$venta = new ModeloVenta();

// -------------------------------------------------------- INPUT
$in['ini'] = Utilidades::clear_input($_GET['ini']);
$in['end'] = Utilidades::clear_input($_GET['end']);
$in['campania'] = Utilidades::clear_input($_GET['campania']);
$libs = new datatables_libs($in);
//Utilidades::dump($in);

// -------------------------------------------------------- Data

$out['head'] = $libs->header_excel();
$out['head_width'] = $libs->header_width_excel();
$out['body'] = $libs->data_excel($libs->sql(), $in);
//Utilidades::dump($out); die();

$j = 1;
if ($out['head'] != null) {
    foreach($out['head'] as $i => $value ) {
        // $objPHPExcel->setActiveSheetIndex(0)->mergeCells('A1:C1');
//      Utilidades::dump($row);
        $objPHPExcel
          ->setActiveSheetIndex(0)
          ->setCellValue(getNameFromNumber($i+1).$j, $value);
    }
    $objPHPExcel
      ->getActiveSheet()
      ->getStyle(c2(1,$i+1,1,1))
      ->applyFromArray($border_style);
    $objPHPExcel
      ->setActiveSheetIndex(0)
      ->getStyle(c2(1,$i+1,1,1))
      ->getFill()
      ->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
      ->getStartColor()
      ->setARGB('FFFFBF00');
}

//die();


$x = $j + 1;
if ($out['body'] != null) {
    foreach($out['body'] as $j => $row ) {
        $j += $x;
        foreach($row  as $i => $value) {
          $objPHPExcel
            ->setActiveSheetIndex(0)
            ->setCellValue(
              getNameFromNumber($i+1).$j,
              strval($value) . ' ',
              PHPExcel_Cell_DataType::TYPE_STRING
            );
        }
      $objPHPExcel
        ->getActiveSheet()
        ->getRowDimension($j)->setRowHeight(60);
      $objPHPExcel
        ->getActiveSheet()
        ->getStyle(c2(1,$i+1,$x,$j))
        ->applyFromArray($border_style);
    }
}


if ($out['head_width'] != null) {
  foreach($out['head_width'] as $i => $value ) {
    $objPHPExcel
      ->getActiveSheet()
      ->getColumnDimension(getNameFromNumber($i+1))
      ->setWidth($value);

  }
}


//die();
 
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