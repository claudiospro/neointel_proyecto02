<?php
include "../../../../../lib/mysql/dbconnector.php";
include "../../../../../lib/mysql/conexion01.php";
include "../../../../../lib/mysql/utilidades.php";
include "../../../modelo/ModeloComision.php";
 
require_once  '../../../../../lib/vendor/phpExcel-1.8.0/Classes/PHPExcel.php';
 
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
function imprimir($index, $i, $titulo, $fibra, $movil) {
    global $objPHPExcel;
    global $border_style;

        if (!isset($movil['residencial']['S']))
            $movil['residencial']['S'] = array();
        if (!isset($movil['residencial']['M']))
            $movil['residencial']['M'] = array();
        if (!isset($movil['residencial']['L']))
            $movil['residencial']['L'] = array();
        //
        if (!isset($movil['autonomo']['linea 1']['S']))
            $movil['autonomo']['linea 1']['S'] = array();
        if (!isset($movil['autonomo']['linea 1']['M']))
            $movil['autonomo']['linea 1']['M'] = array();
        if (!isset($movil['autonomo']['linea 1']['L']))
            $movil['autonomo']['linea 1']['L'] = array();
        
        if (!isset($movil['autonomo']['linea 2']['S']))
            $movil['autonomo']['linea 2']['S'] = array();
        if (!isset($movil['autonomo']['linea 2']['M']))
            $movil['autonomo']['linea 2']['M'] = array();
        if (!isset($movil['autonomo']['linea 2']['L']))
            $movil['autonomo']['linea 2']['L'] = array();
        
        // --------------------------------------------- 300
        if (!isset($fibra['residencial']['2P']['300MB']))
            $fibra['residencial']['2P']['300MB'] = array();
        if (!isset($fibra['residencial']['3P']['300MB']))
            $fibra['residencial']['3P']['300MB'] = array();
        //
        if (!isset($fibra['autonomo']['fibra']['300MB']['Alta Nueva']))
            $fibra['autonomo']['fibra']['300MB']['Alta Nueva'] = array();
        if (!isset($fibra['autonomo']['fibra']['300MB']['Portabilidad']))
            $fibra['autonomo']['fibra']['300MB']['Portabilidad'] = array();

        // ----------------------------------------- 120
        if (!isset($fibra['residencial']['2P']['120MB']))
            $fibra['residencial']['2P']['120MB'] = array();
        if (!isset($fibra['residencial']['3P']['120MB']))
            $fibra['residencial']['3P']['120MB'] = array();
        //
        if (!isset($fibra['autonomo']['fibra']['120MB']['Alta Nueva']))
            $fibra['autonomo']['fibra']['120MB']['Alta Nueva'] = array();
        if (!isset($fibra['autonomo']['fibra']['120MB']['Portabilidad']))
            $fibra['autonomo']['fibra']['120MB']['Portabilidad'] = array();

        // ----------------------------------------- 50        
        if (!isset($fibra['residencial']['2P']['50MB']))
            $fibra['residencial']['2P']['50MB'] = array();
        if (!isset($fibra['residencial']['3P']['50MB']))
            $fibra['residencial']['3P']['50MB'] = array();
        //
        if (!isset($fibra['autonomo']['fibra']['50MB']['Alta Nueva']))
            $fibra['autonomo']['fibra']['50MB']['Alta Nueva'] = array();
        if (!isset($fibra['autonomo']['fibra']['50MB']['Portabilidad']))
            $fibra['autonomo']['fibra']['50MB']['Portabilidad'] = array();
        
        // ----------------------------------------- adsl
        if (!isset($fibra['residencial']['2P']['adsl']))
            $fibra['residencial']['2P']['adsl'] = array();
        if (!isset($fibra['residencial']['3P']['adsl']))
            $fibra['residencial']['3P']['adsl'] = array();
        //
        if (!isset($fibra['autonomo']['adsl']['Alta Nueva']))
            $fibra['autonomo']['adsl']['Alta Nueva'] = array();
        if (!isset($fibra['autonomo']['adsl']['Portabilidad']))
            $fibra['autonomo']['adsl']['Portabilidad'] = array();

        // ------------------------------------------ TOTAL
        $total_1 = count($fibra['residencial']['2P']['300MB']) 
                 + count($fibra['residencial']['2P']['120MB'])
                 + count($fibra['residencial']['2P']['50MB'])
                 + count($fibra['residencial']['3P']['300MB']) 
                 + count($fibra['residencial']['3P']['120MB'])
                 + count($fibra['residencial']['3P']['50MB'])
                 ;
        $total_2 = count($movil['residencial']['S'])
                 + count($movil['residencial']['M'])
                 + count($movil['residencial']['L'])
                 ;
        $total_3 = count($fibra['autonomo']['fibra']['300MB']['Alta Nueva'])
                 + count($fibra['autonomo']['fibra']['300MB']['Portabilidad'])
                 + count($fibra['autonomo']['fibra']['120MB']['Alta Nueva'])
                 + count($fibra['autonomo']['fibra']['120MB']['Portabilidad'])
                 + count($fibra['autonomo']['fibra']['50MB']['Alta Nueva'])
                 + count($fibra['autonomo']['fibra']['50MB']['Portabilidad'])
                 + count($fibra['autonomo']['adsl']['Alta Nueva'])
                 + count($fibra['autonomo']['adsl']['Portabilidad'])
                 ;        
        $total_4 = count($movil['autonomo']['linea 1']['S'])
                 + count($movil['autonomo']['linea 1']['M'])
                 + count($movil['autonomo']['linea 1']['L'])
                 + count($movil['autonomo']['linea 2']['S'])
                 + count($movil['autonomo']['linea 2']['M'])
                 + count($movil['autonomo']['linea 2']['L'])
                 ;
        $total_5 = $total_1 + $total_3;
        $total_6 = $total_2 + $total_4;

    
    $objPHPExcel->getActiveSheet()->getStyle( c2(1,34,$i,$i+3) )->applyFromArray($border_style);
    $objPHPExcel->setActiveSheetIndex($index)
        ->setCellValue(c1(1,$i), $titulo)->mergeCells(c2(1,1,$i,$i+3))
        ->setCellValue(c1(2,$i), 'Fibra 300MB')
        ->setCellValue(c1(3,$i), count($fibra['residencial']['2P']['300MB']))
        ->setCellValue(c1(4,$i), '')
        ->setCellValue(c1(5,$i), count($fibra['residencial']['3P']['300MB']))
        ->setCellValue(c1(6,$i), '')
        ->setCellValue(c1(7,$i), $total_1)->mergeCells(c2(7,7,$i,$i+3))
        ->setCellValue(c1(8,$i), count($movil['residencial']['S']))->mergeCells(c2(8,8,$i,$i+3))
        ->setCellValue(c1(9,$i), '')->mergeCells(c2(9,9,$i,$i+3))
        ->setCellValue(c1(10,$i), count($movil['residencial']['M']))->mergeCells(c2(10,10,$i,$i+3))
        ->setCellValue(c1(11,$i), '')->mergeCells(c2(11,11,$i,$i+3))
        ->setCellValue(c1(12,$i), count($movil['residencial']['L']))->mergeCells(c2(12,12,$i,$i+3))
        ->setCellValue(c1(13,$i), '')->mergeCells(c2(13,13,$i,$i+3))
        ->setCellValue(c1(14,$i), $total_2)->mergeCells(c2(14,14,$i,$i+3))
        ->setCellValue(c1(15,$i), count($fibra['autonomo']['fibra']['300MB']['Alta Nueva']))
        ->setCellValue(c1(16,$i), '')
        ->setCellValue(c1(17,$i), count($fibra['autonomo']['fibra']['300MB']['Portabilidad']))
        ->setCellValue(c1(18,$i), '')
        ->setCellValue(c1(19,$i), $total_3)->mergeCells(c2(19,19,$i,$i+3))
        ->setCellValue(c1(20,$i), count($movil['autonomo']['linea 1']['S']))->mergeCells(c2(20,20,$i,$i+3))
        ->setCellValue(c1(21,$i), '')->mergeCells(c2(21,21,$i,$i+3))
        ->setCellValue(c1(22,$i), count($movil['autonomo']['linea 1']['M']))->mergeCells(c2(22,22,$i,$i+3))
        ->setCellValue(c1(23,$i), '')->mergeCells(c2(23,23,$i,$i+3))
        ->setCellValue(c1(24,$i), count($movil['autonomo']['linea 1']['L']))->mergeCells(c2(24,24,$i,$i+3))
        ->setCellValue(c1(25,$i), '')->mergeCells(c2(25,25,$i,$i+3))
        ->setCellValue(c1(26,$i), count($movil['autonomo']['linea 2']['S']))->mergeCells(c2(26,26,$i,$i+3))
        ->setCellValue(c1(27,$i), '')->mergeCells(c2(27,27,$i,$i+3))
        ->setCellValue(c1(28,$i), count($movil['autonomo']['linea 2']['M']))->mergeCells(c2(28,28,$i,$i+3))
        ->setCellValue(c1(29,$i), '')->mergeCells(c2(29,29,$i,$i+3))
        ->setCellValue(c1(30,$i), count($movil['autonomo']['linea 1']['L']))->mergeCells(c2(30,30,$i,$i+3))
        ->setCellValue(c1(31,$i), '')->mergeCells(c2(31,31,$i,$i+3))
        ->setCellValue(c1(32,$i), $total_4)->mergeCells(c2(32,32,$i,$i+3))
        ->setCellValue(c1(33,$i), $total_5)->mergeCells(c2(33,33,$i,$i+3))
        ->setCellValue(c1(34,$i), $total_6)->mergeCells(c2(34,34,$i,$i+3))

        ->setCellValue(c1(2,$i+1), 'Fibra 120MB')
        ->setCellValue(c1(3,$i+1), count($fibra['residencial']['2P']['120MB']))
        ->setCellValue(c1(4,$i+1), '')
        ->setCellValue(c1(5,$i+1), count($fibra['residencial']['3P']['120MB']))
        ->setCellValue(c1(6,$i+1), '')
        ->setCellValue(c1(15,$i+1), count($fibra['autonomo']['fibra']['120MB']['Alta Nueva']))
        ->setCellValue(c1(16,$i+1), '')
        ->setCellValue(c1(17,$i+1), count($fibra['autonomo']['fibra']['120MB']['Portabilidad']))
        ->setCellValue(c1(18,$i+1), '')

        ->setCellValue(c1(2,$i+2), 'Fibra 50MB')
        ->setCellValue(c1(3,$i+2), count($fibra['residencial']['2P']['50MB']))
        ->setCellValue(c1(4,$i+2), '')
        ->setCellValue(c1(5,$i+2), count($fibra['residencial']['3P']['50MB']))
        ->setCellValue(c1(6,$i+2), '')
        ->setCellValue(c1(15,$i+2), count($fibra['autonomo']['fibra']['50MB']['Alta Nueva']))
        ->setCellValue(c1(16,$i+2), '')
        ->setCellValue(c1(17,$i+2),  count($fibra['autonomo']['fibra']['50MB']['Portabilidad']))
        ->setCellValue(c1(18,$i+2), '')

        ->setCellValue(c1(2,$i+3), 'ADSL')
        // ->setCellValue(c1(3,$i+3), '')->mergeCells(c2(3,14,$i+3,$i+3))
        ->setCellValue(c1(3,$i+3), count($fibra['residencial']['2P']['adsl']))
        ->setCellValue(c1(4,$i+3), '')
        ->setCellValue(c1(5,$i+3), count($fibra['residencial']['3P']['adsl']))
        ->setCellValue(c1(6,$i+3), '')        
        ->setCellValue(c1(15,$i+3), count($fibra['autonomo']['adsl']['Alta Nueva']))
        ->setCellValue(c1(16,$i+3), '')
        ->setCellValue(c1(17,$i+3), count($fibra['autonomo']['adsl']['Portabilidad']))
        ->setCellValue(c1(18,$i+3), '')
        ;
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
$objPHPExcel->getActiveSheet()->getColumnDimension(c0(3))->setWidth(6);
$objPHPExcel->getActiveSheet()->getColumnDimension(c0(5))->setWidth(6);
$objPHPExcel->getActiveSheet()->getColumnDimension(c0(8))->setWidth(6);
$objPHPExcel->getActiveSheet()->getColumnDimension(c0(10))->setWidth(6);
$objPHPExcel->getActiveSheet()->getColumnDimension(c0(12))->setWidth(6);
$objPHPExcel->getActiveSheet()->getColumnDimension(c0(15))->setWidth(6);
$objPHPExcel->getActiveSheet()->getColumnDimension(c0(17))->setWidth(6);
$objPHPExcel->getActiveSheet()->getColumnDimension(c0(20))->setWidth(6);
$objPHPExcel->getActiveSheet()->getColumnDimension(c0(22))->setWidth(6);
$objPHPExcel->getActiveSheet()->getColumnDimension(c0(24))->setWidth(6);
$objPHPExcel->getActiveSheet()->getColumnDimension(c0(26))->setWidth(6);
$objPHPExcel->getActiveSheet()->getColumnDimension(c0(28))->setWidth(6);
$objPHPExcel->getActiveSheet()->getColumnDimension(c0(30))->setWidth(6);
$objPHPExcel->getActiveSheet()->getStyle("A1:AH2")->applyFromArray($border_style);

$objPHPExcel->setActiveSheetIndex(1);
$objPHPExcel->getActiveSheet()->getColumnDimension(c0(3))->setWidth(6);
$objPHPExcel->getActiveSheet()->getColumnDimension(c0(5))->setWidth(6);
$objPHPExcel->getActiveSheet()->getColumnDimension(c0(8))->setWidth(6);
$objPHPExcel->getActiveSheet()->getColumnDimension(c0(10))->setWidth(6);
$objPHPExcel->getActiveSheet()->getColumnDimension(c0(12))->setWidth(6);
$objPHPExcel->getActiveSheet()->getColumnDimension(c0(15))->setWidth(6);
$objPHPExcel->getActiveSheet()->getColumnDimension(c0(17))->setWidth(6);
$objPHPExcel->getActiveSheet()->getColumnDimension(c0(20))->setWidth(6);
$objPHPExcel->getActiveSheet()->getColumnDimension(c0(22))->setWidth(6);
$objPHPExcel->getActiveSheet()->getColumnDimension(c0(24))->setWidth(6);
$objPHPExcel->getActiveSheet()->getColumnDimension(c0(26))->setWidth(6);
$objPHPExcel->getActiveSheet()->getColumnDimension(c0(28))->setWidth(6);
$objPHPExcel->getActiveSheet()->getColumnDimension(c0(30))->setWidth(6);
$objPHPExcel->getActiveSheet()->getStyle("A1:AH2")->applyFromArray($border_style);

$objPHPExcel->setActiveSheetIndex(2);
$objPHPExcel->getActiveSheet()->getColumnDimension(c0(3))->setWidth(6);
$objPHPExcel->getActiveSheet()->getColumnDimension(c0(5))->setWidth(6);
$objPHPExcel->getActiveSheet()->getColumnDimension(c0(8))->setWidth(6);
$objPHPExcel->getActiveSheet()->getColumnDimension(c0(10))->setWidth(6);
$objPHPExcel->getActiveSheet()->getColumnDimension(c0(12))->setWidth(6);
$objPHPExcel->getActiveSheet()->getColumnDimension(c0(15))->setWidth(6);
$objPHPExcel->getActiveSheet()->getColumnDimension(c0(17))->setWidth(6);
$objPHPExcel->getActiveSheet()->getColumnDimension(c0(20))->setWidth(6);
$objPHPExcel->getActiveSheet()->getColumnDimension(c0(22))->setWidth(6);
$objPHPExcel->getActiveSheet()->getColumnDimension(c0(24))->setWidth(6);
$objPHPExcel->getActiveSheet()->getColumnDimension(c0(26))->setWidth(6);
$objPHPExcel->getActiveSheet()->getColumnDimension(c0(28))->setWidth(6);
$objPHPExcel->getActiveSheet()->getColumnDimension(c0(30))->setWidth(6);
$objPHPExcel->getActiveSheet()->getStyle("A1:AH2")->applyFromArray($border_style);


if (
    $in['campania_info']['indice'] == 'campania_001' &&
    'Vodafone One' == trim($in['campania_info']['nombre'])
) {
    // encabezados

    $objPHPExcel->setActiveSheetIndex(0)
        ->getStyle('A1:AH2')
        ->getFill()
        ->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
        ->getStartColor()
        ->setARGB('FFFFBF00');
    $objPHPExcel->setActiveSheetIndex(0)
        ->setCellValue(c1(1,1), '')->mergeCells( c2(1,2,1,2) )
        ->setCellValue(c1(3,1), 'Residencial')->mergeCells( c2(3,7,1,1) )
        ->setCellValue(c1(8,1), 'Lineas')     ->mergeCells( c2(8,14,1,1) )
        ->setCellValue(c1(15,1), 'Autonomos') ->mergeCells( c2(15,19,1,1) )
        ->setCellValue(c1(20,1), '1ra Linea')->mergeCells( c2(20,25,1,1) )
        ->setCellValue(c1(26,1), '2da Linea')->mergeCells( c2(26,31,1,1) )
        ->setCellValue(c1(32,1), 'Lineas')
        ->setCellValue(c1(33,1), 'Total')->mergeCells( c2(33,34,1,1) )

        ->setCellValue(c1(3,2), '2P')->mergeCells(c2(3,4,2,2))
        ->setCellValue(c1(5,2), '3P')->mergeCells(c2(5,6,2,2))
        ->setCellValue(c1(7,2), 'SubTotal')
        ->setCellValue(c1(8,2), 'S')->mergeCells(c2(8,9,2,2))
        ->setCellValue(c1(10,2), 'M')->mergeCells(c2(10,11,2,2))
        ->setCellValue(c1(12,2), 'L')->mergeCells(c2(12,13,2,2))
        ->setCellValue(c1(14,2), 'SubTotal')
        ->setCellValue(c1(15,2), 'Alta Nueva')->mergeCells(c2(15,16,2,2))
        ->setCellValue(c1(17,2), 'Portabilidad')->mergeCells(c2(17,18,2,2))
        ->setCellValue(c1(19,2), 'SubTotal')
        ->setCellValue(c1(20,2), 'S')->mergeCells(c2(20,21,2,2))
        ->setCellValue(c1(22,2), 'M')->mergeCells(c2(22,23,2,2))
        ->setCellValue(c1(24,2), 'L')->mergeCells(c2(24,25,2,2))
        ->setCellValue(c1(26,2), 'S')->mergeCells(c2(26,27,2,2))
        ->setCellValue(c1(28,2), 'M')->mergeCells(c2(28,29,2,2))
        ->setCellValue(c1(30,2), 'L')->mergeCells(c2(30,31,2,2))
        ->setCellValue(c1(32,2), 'SubTotal')
        ->setCellValue(c1(33,2), 'Ventas')
        ->setCellValue(c1(34,2), 'Lineas')
        ;
    $objPHPExcel->setActiveSheetIndex(1)
        ->getStyle('A1:AH2')
        ->getFill()
        ->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
        ->getStartColor()
        ->setARGB('FFFFBF00');
    $objPHPExcel->setActiveSheetIndex(1)
        ->setCellValue(c1(1,1), '')->mergeCells( c2(1,2,1,2) )
        ->setCellValue(c1(3,1), 'Residencial')->mergeCells( c2(3,7,1,1) )
        ->setCellValue(c1(8,1), 'Lineas')     ->mergeCells( c2(8,14,1,1) )
        ->setCellValue(c1(15,1), 'Autonomos') ->mergeCells( c2(15,19,1,1) )
        ->setCellValue(c1(20,1), '1ra Linea')->mergeCells( c2(20,25,1,1) )
        ->setCellValue(c1(26,1), '2da Linea')->mergeCells( c2(26,31,1,1) )
        ->setCellValue(c1(32,1), 'Lineas')
        ->setCellValue(c1(33,1), 'Total')->mergeCells( c2(33,34,1,1) )

        ->setCellValue(c1(3,2), '2P')->mergeCells(c2(3,4,2,2))
        ->setCellValue(c1(5,2), '3P')->mergeCells(c2(5,6,2,2))
        ->setCellValue(c1(7,2), 'SubTotal')
        ->setCellValue(c1(8,2), 'S')->mergeCells(c2(8,9,2,2))
        ->setCellValue(c1(10,2), 'M')->mergeCells(c2(10,11,2,2))
        ->setCellValue(c1(12,2), 'L')->mergeCells(c2(12,13,2,2))
        ->setCellValue(c1(14,2), 'SubTotal')
        ->setCellValue(c1(15,2), 'Alta Nueva')->mergeCells(c2(15,16,2,2))
        ->setCellValue(c1(17,2), 'Portabilidad')->mergeCells(c2(17,18,2,2))
        ->setCellValue(c1(19,2), 'SubTotal')
        ->setCellValue(c1(20,2), 'S')->mergeCells(c2(20,21,2,2))
        ->setCellValue(c1(22,2), 'M')->mergeCells(c2(22,23,2,2))
        ->setCellValue(c1(24,2), 'L')->mergeCells(c2(24,25,2,2))
        ->setCellValue(c1(26,2), 'S')->mergeCells(c2(26,27,2,2))
        ->setCellValue(c1(28,2), 'M')->mergeCells(c2(28,29,2,2))
        ->setCellValue(c1(30,2), 'L')->mergeCells(c2(30,31,2,2))
        ->setCellValue(c1(32,2), 'SubTotal')
        ->setCellValue(c1(33,2), 'Ventas')
        ->setCellValue(c1(34,2), 'Lineas')
        ;
    $objPHPExcel->setActiveSheetIndex(2)
        ->getStyle('A1:AH2')
        ->getFill()
        ->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
        ->getStartColor()
        ->setARGB('FFFFBF00');
    
    $objPHPExcel->setActiveSheetIndex(2)
        ->setCellValue(c1(1,1), '')->mergeCells( c2(1,2,1,2) )
        ->setCellValue(c1(3,1), 'Residencial')->mergeCells( c2(3,7,1,1) )
        ->setCellValue(c1(8,1), 'Lineas')     ->mergeCells( c2(8,14,1,1) )
        ->setCellValue(c1(15,1), 'Autonomos') ->mergeCells( c2(15,19,1,1) )
        ->setCellValue(c1(20,1), '1ra Linea')->mergeCells( c2(20,25,1,1) )
        ->setCellValue(c1(26,1), '2da Linea')->mergeCells( c2(26,31,1,1) )
        ->setCellValue(c1(32,1), 'Lineas')
        ->setCellValue(c1(33,1), 'Total')->mergeCells( c2(33,34,1,1) )

        ->setCellValue(c1(3,2), '2P')->mergeCells(c2(3,4,2,2))
        ->setCellValue(c1(5,2), '3P')->mergeCells(c2(5,6,2,2))
        ->setCellValue(c1(7,2), 'SubTotal')
        ->setCellValue(c1(8,2), 'S')->mergeCells(c2(8,9,2,2))
        ->setCellValue(c1(10,2), 'M')->mergeCells(c2(10,11,2,2))
        ->setCellValue(c1(12,2), 'L')->mergeCells(c2(12,13,2,2))
        ->setCellValue(c1(14,2), 'SubTotal')
        ->setCellValue(c1(15,2), 'Alta Nueva')->mergeCells(c2(15,16,2,2))
        ->setCellValue(c1(17,2), 'Portabilidad')->mergeCells(c2(17,18,2,2))
        ->setCellValue(c1(19,2), 'SubTotal')
        ->setCellValue(c1(20,2), 'S')->mergeCells(c2(20,21,2,2))
        ->setCellValue(c1(22,2), 'M')->mergeCells(c2(22,23,2,2))
        ->setCellValue(c1(24,2), 'L')->mergeCells(c2(24,25,2,2))
        ->setCellValue(c1(26,2), 'S')->mergeCells(c2(26,27,2,2))
        ->setCellValue(c1(28,2), 'M')->mergeCells(c2(28,29,2,2))
        ->setCellValue(c1(30,2), 'L')->mergeCells(c2(30,31,2,2))
        ->setCellValue(c1(32,2), 'SubTotal')
        ->setCellValue(c1(33,2), 'Ventas')
        ->setCellValue(c1(34,2), 'Lineas')
        ;
    // body
    $objPHPExcel->setActiveSheetIndex(0);
    imprimir(0
             , 3
             , 'Total'
             , $ou['fibra']['total']
             , $ou['movil']['total']             
    );

    $objPHPExcel->setActiveSheetIndex(1);
    $i = 3;
    foreach($ou['fibra']['supervisor'] as $name => $r) {
        imprimir(1
                 , $i
                 , utf8_encode(strtoupper($name))
                 , $ou['fibra']['supervisor'][$name]
                 , $ou['movil']['supervisor'][$name]
        );
        $i += 6;
    }

    $objPHPExcel->setActiveSheetIndex(2);
    $i = 3;
    foreach($ou['fibra']['asesor_venta'] as $name => $r) {
        if (!isset($ou['fibra']['asesor_venta'][$name]))
            $ou['fibra']['asesor_venta'][$name] = array();
        if (!isset($ou['movil']['asesor_venta'][$name]))
            $ou['movil']['asesor_venta'][$name] = array();
        imprimir(2
                 , $i
                 , utf8_encode(strtoupper($name))
                 , $ou['fibra']['asesor_venta'][$name]
                 , $ou['movil']['asesor_venta'][$name]
        );
        $i += 6;
    }
    

}
$objPHPExcel->setActiveSheetIndex(0);

header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="comisiones-' . $in['anio-mes'] . '.xls"');
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