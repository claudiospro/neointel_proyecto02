<?php
include "../../../../../lib/mysql/dbconnector.php";
include "../../../../../lib/mysql/conexion01.php";
include "../../../../../lib/mysql/utilidades.php";
include "../../../modelo/ModeloComision.php";
 
require_once  '../../../../../lib/vendor/phpExcel-1.8.0/Classes/PHPExcel.php';
 
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
 

session_start();
$modelo = new ModeloComision();
// -------------------------------------------------------- INPUT
$in['campania_id'] = Utilidades::clear_input($_GET['campania_id']);
$in['anio-mes'] = Utilidades::clear_input($_GET['fecha']);
$in['campania_info'] = $modelo->campania_info($in['campania_id']);
$in['lineas'] = trim($_SESSION['lineas']);
// -------------------------------------------------------- Data
if (
    $in['campania_info']['indice'] == 'campania_001' &&
    'Vodafone One' == trim($in['campania_info']['nombre'])
)
{
    $pr = $modelo->campania_001_Vodafon_one($in);
    if (is_array($pr['datos']))
    {
        $ou = $modelo->campania_001_Vodafon_one_process($pr);
    }
    else
    {
        $ou = null;
    }        
}


// -------------------------------------------------------- TEST
// Utilidades::printr($in);
// Utilidades::printr($ou);
 
// -------------------------------------------------------- OUT
$objPHPExcel = new PHPExcel();
$objPHPExcel->getProperties()->setCreator("Claudio Rodriguez Ore");
$objPHPExcel->getActiveSheet()->setTitle('Total');

$myWorkSheet = new PHPExcel_Worksheet($objPHPExcel, 'Supervisores');
$objPHPExcel->addSheet($myWorkSheet, 1);

$myWorkSheet = new PHPExcel_Worksheet($objPHPExcel, 'Asesores');
$objPHPExcel->addSheet($myWorkSheet, 2);

$border_style= array (
    'borders' => array (
        'allborders' => array (
            'style' => PHPExcel_Style_Border::BORDER_HAIR,
            'color' => array('argb' => '000000'),
        ),
    ),    
);

$objPHPExcel->setActiveSheetIndex(0);
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(6);
$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(6);
$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(6);
$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(6);
$objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(6);
$objPHPExcel->getActiveSheet()->getColumnDimension('M')->setWidth(6);
$objPHPExcel->getActiveSheet()->getColumnDimension('O')->setWidth(6);
$objPHPExcel->getActiveSheet()->getColumnDimension('Q')->setWidth(6);
$objPHPExcel->getActiveSheet()->getColumnDimension('S')->setWidth(6);
$objPHPExcel->getActiveSheet()->getStyle("A1:T2")->applyFromArray($border_style);

$objPHPExcel->setActiveSheetIndex(1);
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(6);
$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(6);
$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(6);
$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(6);
$objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(6);
$objPHPExcel->getActiveSheet()->getColumnDimension('M')->setWidth(6);
$objPHPExcel->getActiveSheet()->getColumnDimension('O')->setWidth(6);
$objPHPExcel->getActiveSheet()->getColumnDimension('Q')->setWidth(6);
$objPHPExcel->getActiveSheet()->getColumnDimension('S')->setWidth(6);
$objPHPExcel->getActiveSheet()->getStyle("A1:T2")->applyFromArray($border_style);

$objPHPExcel->setActiveSheetIndex(2);
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(6);
$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(6);
$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(6);
$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(6);
$objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(6);
$objPHPExcel->getActiveSheet()->getColumnDimension('M')->setWidth(6);
$objPHPExcel->getActiveSheet()->getColumnDimension('O')->setWidth(6);
$objPHPExcel->getActiveSheet()->getColumnDimension('Q')->setWidth(6);
$objPHPExcel->getActiveSheet()->getColumnDimension('S')->setWidth(6);
$objPHPExcel->getActiveSheet()->getStyle("A1:T2")->applyFromArray($border_style);

if (
    $in['campania_info']['indice'] == 'campania_001' &&
    'Vodafone One' == trim($in['campania_info']['nombre'])
) {
    // encabezados

    $objPHPExcel->setActiveSheetIndex(0)
        ->getStyle('A1:T2')
        ->getFill()
        ->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
        ->getStartColor()
        ->setARGB('FFFFBF00');
    $objPHPExcel->setActiveSheetIndex(1)
        ->getStyle('A1:T2')
        ->getFill()
        ->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
        ->getStartColor()
        ->setARGB('FFFFBF00');
    $objPHPExcel->setActiveSheetIndex(2)
        ->getStyle('A1:T2')
        ->getFill()
        ->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
        ->getStartColor()
        ->setARGB('FFFFBF00');
    
    $objPHPExcel->setActiveSheetIndex(0)
        ->setCellValue('A1', '')
        ->mergeCells('A1:B2')
        ->setCellValue('C1', 'Residencial')
        ->mergeCells('C1:L1')
        ->setCellValue('M1', 'Autonomos')
        ->mergeCells('M1:T1')
        ->setCellValue('C2', '2P')->mergeCells('C2:D2')
        ->setCellValue('E2', '3P')->mergeCells('E2:F2')
        ->setCellValue('G2', 'S')->mergeCells('G2:H2')
        ->setCellValue('I2', 'M')->mergeCells('I2:J2')
        ->setCellValue('K2', 'L')->mergeCells('K2:L2')
        ->setCellValue('M2', '')->mergeCells('M2:N2')
        ->setCellValue('O2', 'S')->mergeCells('O2:P2')
        ->setCellValue('Q2', 'M')->mergeCells('Q2:R2')
        ->setCellValue('S2', 'L')->mergeCells('S2:T2')
        ;
    $objPHPExcel->setActiveSheetIndex(1)
        ->setCellValue('A1', '')
        ->mergeCells('A1:B2')
        ->setCellValue('C1', 'Residencial')
        ->mergeCells('C1:L1')
        ->setCellValue('M1', 'Autonomos')
        ->mergeCells('M1:T1')
        ->setCellValue('C2', '2P')->mergeCells('C2:D2')
        ->setCellValue('E2', '3P')->mergeCells('E2:F2')
        ->setCellValue('G2', 'S')->mergeCells('G2:H2')
        ->setCellValue('I2', 'M')->mergeCells('I2:J2')
        ->setCellValue('K2', 'L')->mergeCells('K2:L2')
        ->setCellValue('M2', '')->mergeCells('M2:N2')
        ->setCellValue('O2', 'S')->mergeCells('O2:P2')
        ->setCellValue('Q2', 'M')->mergeCells('Q2:R2')
        ->setCellValue('S2', 'L')->mergeCells('S2:T2')
        ;
    $objPHPExcel->setActiveSheetIndex(2)
        ->setCellValue('A1', '')
        ->mergeCells('A1:B2')
        ->setCellValue('C1', 'Residencial')
        ->mergeCells('C1:L1')
        ->setCellValue('M1', 'Autonomos')
        ->mergeCells('M1:T1')
        ->setCellValue('C2', '2P')->mergeCells('C2:D2')
        ->setCellValue('E2', '3P')->mergeCells('E2:F2')
        ->setCellValue('G2', 'S')->mergeCells('G2:H2')
        ->setCellValue('I2', 'M')->mergeCells('I2:J2')
        ->setCellValue('K2', 'L')->mergeCells('K2:L2')
        ->setCellValue('M2', '')->mergeCells('M2:N2')
        ->setCellValue('O2', 'S')->mergeCells('O2:P2')
        ->setCellValue('Q2', 'M')->mergeCells('Q2:R2')
        ->setCellValue('S2', 'L')->mergeCells('S2:T2')
        ;

}
$objPHPExcel->setActiveSheetIndex(0);



header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="comisiones-' . date('Y-m') . '.xls"');
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