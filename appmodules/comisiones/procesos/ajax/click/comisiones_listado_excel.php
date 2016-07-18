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
function cProducto($num1, $num2, $i) {
    return '=' . c0($num1) . $i . '*' . c0($num2) . $i;
}
function cSuma1($num, $i1, $i2) {
    return '=SUM(' . c0($num) . $i1 . ':' . c0($num) . $i2 . ')';
}
function cSuma2($num, $i1, $i2) {
    return 'SUM(' . c0($num) . $i1 . ':' . c0($num) . $i2 . ')';
}
function imprimir($index, $i, $titulo, $fibra, $movil) {
    global $objPHPExcel;
    global $border_style;

    if (!isset($movil['residencial']['linea 1']['S']))
        $movil['residencial']['linea 1']['S'] = array();
    if (!isset($movil['residencial']['linea 1']['M']))
        $movil['residencial']['linea 1']['M'] = array();
    if (!isset($movil['residencial']['linea 1']['L']))
        $movil['residencial']['linea 1']['L'] = array();
    //
    if (!isset($movil['residencial']['linea 2']['S']))
        $movil['residencial']['linea 2']['S'] = array();
    if (!isset($movil['residencial']['linea 2']['M']))
        $movil['residencial']['linea 2']['M'] = array();
    if (!isset($movil['residencial']['linea 2']['L']))
        $movil['residencial']['linea 2']['L'] = array();
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
    // border
    $objPHPExcel->getActiveSheet()->getStyle( c2(1 ,12,$i   ,$i   ) )->applyFromArray($border_style);
    $objPHPExcel->getActiveSheet()->getStyle( c2(1 ,12,$i+1 ,$i+1 ) )->applyFromArray($border_style);
    $objPHPExcel->getActiveSheet()->getStyle( c2(1 ,7 ,$i+2 ,$i+7 ) )->applyFromArray($border_style);
    $objPHPExcel->getActiveSheet()->getStyle( c2(9 ,12,$i+2 ,$i+7 ) )->applyFromArray($border_style);
    $objPHPExcel->getActiveSheet()->getStyle( c2(9 ,12,$i+9 ,$i+14) )->applyFromArray($border_style);        
    $objPHPExcel->getActiveSheet()->getStyle( c2(1 ,2 ,$i+13,$i+14) )->applyFromArray($border_style);
    $objPHPExcel->getActiveSheet()->getStyle( c2(5 ,7 ,$i+13,$i+13) )->applyFromArray($border_style);
    $objPHPExcel->getActiveSheet()->getStyle( c2(1 ,12,$i+16,$i+16) )->applyFromArray($border_style);
    $objPHPExcel->getActiveSheet()->getStyle( c2(1 ,7 ,$i+17,$i+22) )->applyFromArray($border_style);
    $objPHPExcel->getActiveSheet()->getStyle( c2(9 ,12,$i+17,$i+22) )->applyFromArray($border_style);
    $objPHPExcel->getActiveSheet()->getStyle( c2(1 ,2 ,$i+28,$i+29) )->applyFromArray($border_style);
    $objPHPExcel->getActiveSheet()->getStyle( c2(5 ,7 ,$i+28,$i+28) )->applyFromArray($border_style);
    $objPHPExcel->getActiveSheet()->getStyle( c2(9 ,12,$i+24,$i+29) )->applyFromArray($border_style);
    $objPHPExcel->getActiveSheet()->getStyle( c2(1 ,12,$i+31,$i+31) )->applyFromArray($border_style);
    $objPHPExcel->getActiveSheet()->getStyle( c2(1 ,2 ,$i+32,$i+33) )->applyFromArray($border_style);
    $objPHPExcel->getActiveSheet()->getStyle( c2(5 ,7 ,$i+32,$i+32) )->applyFromArray($border_style);

    // colores
    $objPHPExcel->setActiveSheetIndex($index)
        ->getStyle( c2(1 ,12 ,$i,$i) )->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
        ->getStartColor()->setARGB('FF488FFF');// azul
    $objPHPExcel->setActiveSheetIndex($index)
        ->getStyle( c2(1 ,12 ,$i+1,$i+1) )->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
        ->getStartColor()->setARGB('FFFFFE00');// amarillo
    $objPHPExcel->setActiveSheetIndex($index)
        ->getStyle( c2(1 ,7 ,$i+2,$i+2) )->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
        ->getStartColor()->setARGB('FFFFBF00');// anaranjado
    $objPHPExcel->setActiveSheetIndex($index)
        ->getStyle( c2(9 ,12 ,$i+2,$i+2) )->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
        ->getStartColor()->setARGB('FFFFBF00');// anaranjado
    $objPHPExcel->setActiveSheetIndex($index)
        ->getStyle( c2(9 ,12 ,$i+9,$i+9) )->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
        ->getStartColor()->setARGB('FFFFBF00');// anaranjado        
    $objPHPExcel->setActiveSheetIndex($index)
        ->getStyle( c2(1 ,2 ,$i+13,$i+13) )->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
        ->getStartColor()->setARGB('FFFFBF00');// anaranjado
    $objPHPExcel->setActiveSheetIndex($index)
        ->getStyle( c2(5 ,7 ,$i+13,$i+13) )->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
        ->getStartColor()->setARGB('FFFFFE00');// amarillo
    $objPHPExcel->setActiveSheetIndex($index)
        ->getStyle( c2(1 ,12 ,$i+16,$i+16) )->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
        ->getStartColor()->setARGB('FFFFFE00');// amarillo
    $objPHPExcel->setActiveSheetIndex($index)
        ->getStyle( c2(1 ,7 ,$i+17,$i+17) )->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
        ->getStartColor()->setARGB('FFFFBF00');// anaranjado
    $objPHPExcel->setActiveSheetIndex($index)
        ->getStyle( c2(9 ,12 ,$i+17,$i+17) )->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
        ->getStartColor()->setARGB('FFFFBF00');// anaranjado
    $objPHPExcel->setActiveSheetIndex($index)
        ->getStyle( c2(9 ,12 ,$i+24,$i+24) )->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
        ->getStartColor()->setARGB('FFFFBF00');// anaranjado
    $objPHPExcel->setActiveSheetIndex($index)
        ->getStyle( c2(1 ,2 ,$i+28,$i+28) )->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
        ->getStartColor()->setARGB('FFFFBF00');// anaranjado
    $objPHPExcel->setActiveSheetIndex($index)
        ->getStyle( c2(5 ,7 ,$i+28,$i+28) )->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
        ->getStartColor()->setARGB('FFFFFE00');// amarillo
    $objPHPExcel->setActiveSheetIndex($index)
        ->getStyle( c2(1 ,12,$i+31,$i+31) )->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
        ->getStartColor()->setARGB('FFFFFE00');// amarillo
    $objPHPExcel->setActiveSheetIndex($index)
        ->getStyle( c2(1 ,2 ,$i+32,$i+32) )->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
        ->getStartColor()->setARGB('FFFFBF00');// anaranjado
    $objPHPExcel->setActiveSheetIndex($index)
        ->getStyle( c2(5 ,7 ,$i+32,$i+32) )->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
        ->getStartColor()->setARGB('FFFFFE00');// amarillo
    // -------------- formato
    $formato1 = '[$S/.-415]_-\ _-* #,##0.00';
    $formato2 = '[$S/-280A]#,##0.00;[$S/-280A]-#,##0.00';
    $objPHPExcel->getActiveSheet()
        ->getStyle(c2(3 ,4 ,$i,$i+33))
        ->getNumberFormat()
        ->setFormatCode($formato2);
    $objPHPExcel->getActiveSheet()
        ->getStyle(c2(6 ,7 ,$i,$i+33))
        ->getNumberFormat()
        ->setFormatCode($formato2);
    $objPHPExcel->getActiveSheet()
        ->getStyle(c2(11 ,12 ,$i,$i+33))
        ->getNumberFormat()
        ->setFormatCode($formato2);
    // formula solo para 2
    $formula_13 =  '';
    $formula_14 =  '';
    $formula_15 =  '';
    $formula_16 =  '';
    $formula_23 =  '';
    if ($index == '2') {
        $formula_13 =  "=VLOOKUP(A" . ($i+29) . ",A3:F22,3,1)";
        $formula_14 =  "=VLOOKUP(A" . ($i+29) . ",A3:F22,4,1)";
        $formula_15 =  "=VLOOKUP(A" . ($i+29) . ",A3:F22,5,1)";
        $formula_16 =  "=VLOOKUP(A" . ($i+29) . ",A3:F22,6,1)";            
        $formula_23 =  "=VLOOKUP(B" . ($i+29) . ",H3:J22,3,1)";        
    }
    // data
    $objPHPExcel->setActiveSheetIndex($index)
        ->setCellValue(c1(1,$i), $titulo)->mergeCells(c2(1,12,$i,$i))
        // 
        ->setCellValue(c1(1,$i+1), 'RESIDENCIALES')->mergeCells(c2(1,12,$i+1,$i+1))
        //
        ->setCellValue(c1(1 , $i+2), '')
        ->setCellValue(c1(2 , $i+2), '2P')
        ->setCellValue(c1(3 , $i+2), 'Com x Vta')
        ->setCellValue(c1(4 , $i+2), 'Total')
        ->setCellValue(c1(5 , $i+2), '3P')
        ->setCellValue(c1(6 , $i+2), 'Com x Vta')
        ->setCellValue(c1(7 , $i+2), 'Total')
        ->setCellValue(c1(9 , $i+2), '')
        ->setCellValue(c1(10, $i+2), 'Cant')
        ->setCellValue(c1(11, $i+2), 'Precio x Venta')
        ->setCellValue(c1(12, $i+2), 'Total')
        //
        ->setCellValue(c1(1 , $i+3), 'Fibra 300MB')
        ->setCellValue(c1(2 , $i+3), count($fibra['residencial']['2P']['300MB']))
        ->setCellValue(c1(3 , $i+3), $formula_13)
        ->setCellValue(c1(4 , $i+3), cProducto(2,3, $i+3))
        ->setCellValue(c1(5 , $i+3), count($fibra['residencial']['3P']['300MB']))
        ->setCellValue(c1(6 , $i+3), $formula_13)
        ->setCellValue(c1(7 , $i+3), cProducto(5,6, $i+3))
        ->setCellValue(c1(9 , $i+3), 'Linea S')
        ->setCellValue(c1(10, $i+3), count($movil['residencial']['linea 1']['S']))
        ->setCellValue(c1(11, $i+3), $formula_23)
        ->setCellValue(c1(12, $i+3), cProducto(10,11,$i+3))
        //
        ->setCellValue(c1(1 , $i+4), 'Fibra 120MB')
        ->setCellValue(c1(2 , $i+4), count($fibra['residencial']['2P']['120MB']))
        ->setCellValue(c1(3 , $i+4), $formula_14)
        ->setCellValue(c1(4 , $i+4), cProducto(2,3, $i+4))
        ->setCellValue(c1(5 , $i+4), count($fibra['residencial']['3P']['120MB']))
        ->setCellValue(c1(6 , $i+4), $formula_14)
        ->setCellValue(c1(7 , $i+4), cProducto(5,6, $i+4))
        ->setCellValue(c1(9 , $i+4), 'Linea M')
        ->setCellValue(c1(10, $i+4), count($movil['residencial']['linea 1']['M']))
        ->setCellValue(c1(11, $i+4), $formula_23)
        ->setCellValue(c1(12, $i+4), cProducto(10,11,$i+4))
        //
        ->setCellValue(c1(1 , $i+5), 'Fibra 50MB')
        ->setCellValue(c1(2 , $i+5), count($fibra['residencial']['2P']['50MB']))
        ->setCellValue(c1(3 , $i+5), $formula_15)
        ->setCellValue(c1(4 , $i+5), cProducto(2,3, $i+5))
        ->setCellValue(c1(5 , $i+5), count($fibra['residencial']['3P']['50MB']))
        ->setCellValue(c1(6 , $i+5), $formula_15)
        ->setCellValue(c1(7 , $i+5), cProducto(5,6, $i+5))
        ->setCellValue(c1(9 , $i+5), 'Linea L')
        ->setCellValue(c1(10, $i+5), count($movil['residencial']['linea 1']['L']))
        ->setCellValue(c1(11, $i+5), $formula_23)
        ->setCellValue(c1(12, $i+5), cProducto(10,11,$i+5))
        //
        ->setCellValue(c1(1 , $i+6), 'ADSL')
        ->setCellValue(c1(2 , $i+6), count($fibra['residencial']['2P']['adsl']))
        ->setCellValue(c1(3 , $i+6), $formula_16)
        ->setCellValue(c1(4 , $i+6), cProducto(2,3, $i+6))
        ->setCellValue(c1(5 , $i+6), count($fibra['residencial']['3P']['adsl']))
        ->setCellValue(c1(6 , $i+6), $formula_16)
        ->setCellValue(c1(7 , $i+6), cProducto(5,6, $i+6))
        ->setCellValue(c1(9 , $i+6), '')
        ->setCellValue(c1(10, $i+6), '')
        ->setCellValue(c1(11, $i+6), '')
        ->setCellValue(c1(12, $i+6), '')
        //
        ->setCellValue(c1(1 , $i+7), 'TOTAL')
        ->setCellValue(c1(2 , $i+7), '')
        ->setCellValue(c1(3 , $i+7), '')
        ->setCellValue(c1(4 , $i+7), cSuma1(4, $i+3, $i+6))
        ->setCellValue(c1(5 , $i+7), '')
        ->setCellValue(c1(6 , $i+7), '')
        ->setCellValue(c1(7 , $i+7), cSuma1(7, $i+3, $i+6))
        ->setCellValue(c1(9 , $i+7), '')
        ->setCellValue(c1(10, $i+7), '')
        ->setCellValue(c1(11, $i+7), '')
        ->setCellValue(c1(12, $i+7), cSuma1(12, $i+3, $i+6))
        //
        ->setCellValue(c1(9 , $i+9), '2da 3ra')
        ->setCellValue(c1(10, $i+9), 'Cant')
        ->setCellValue(c1(11, $i+9), 'Precio x Venta')
        ->setCellValue(c1(12, $i+9), 'Total')        
        //
        ->setCellValue(c1(9 , $i+10), 'Linea S')
        ->setCellValue(c1(10, $i+10), count($movil['residencial']['linea 2']['S']))
        ->setCellValue(c1(11, $i+10), $formula_23)
        ->setCellValue(c1(12, $i+10), cProducto(10,11, $i+10))        
        //
        ->setCellValue(c1(9 , $i+11), 'Linea M')
        ->setCellValue(c1(10, $i+11), count($movil['residencial']['linea 2']['M']))
        ->setCellValue(c1(11, $i+11), $formula_23)
        ->setCellValue(c1(12, $i+11), cProducto(10,11, $i+11))        
        //
        ->setCellValue(c1(9 , $i+12), 'Linea L')
        ->setCellValue(c1(10, $i+12), count($movil['residencial']['linea 2']['L']))
        ->setCellValue(c1(11, $i+12), $formula_23)
        ->setCellValue(c1(12, $i+12), cProducto(10,11, $i+12))
        //
        ->setCellValue(c1(1 , $i+13), 'FIBRAS')
        ->setCellValue(c1(2 , $i+13), 'LINEAS')
        ->setCellValue(c1(5 , $i+13), 'TOTAL X COBRAR')->mergeCells(c2(5,6,$i+13,$i+13))
        ->setCellValue(c1(7 , $i+13), '=' . c1(4,$i+7) . '+' . c1(7,$i+7) . '+' . c1(12,$i+7) . '+' . c1(12,$i+14))
        //
        ->setCellValue(c1(1 , $i+14), '='.cSuma2(2, $i+3, $i+6) . '+'. cSuma2(5, $i+3, $i+6))
        ->setCellValue(c1(2 , $i+14), '='.cSuma2(10, $i+3, $i+5) . '+'. cSuma2(10, $i+10, $i+12))
        ->setCellValue(c1(3 , $i+14), '')
        ->setCellValue(c1(12, $i+14), cSuma1(12, $i+10, $i+13))
        //
        ->setCellValue(c1(1,$i+16), 'AUTONOMOS')->mergeCells(c2(1,12,$i+16,$i+16))
        //
        ->setCellValue(c1(1 , $i+17), '')
        ->setCellValue(c1(2 , $i+17), 'Alta Nueva')
        ->setCellValue(c1(3 , $i+17), 'Com x Vta')
        ->setCellValue(c1(4 , $i+17), 'Total')
        ->setCellValue(c1(5 , $i+17), 'Portabilidad')
        ->setCellValue(c1(6 , $i+17), 'Com x Vta')
        ->setCellValue(c1(7 , $i+17), 'Total')
        ->setCellValue(c1(9 , $i+17), '1ra')
        ->setCellValue(c1(10, $i+17), 'Cant')
        ->setCellValue(c1(11, $i+17), 'Precio x Venta')
        ->setCellValue(c1(12, $i+17), 'Total')
        //
        ->setCellValue(c1(1 , $i+18), 'Fibra 300MB')
        ->setCellValue(c1(2 , $i+18), count($fibra['autonomo']['fibra']['300MB']['Alta Nueva']))
        ->setCellValue(c1(3 , $i+18), $formula_13) 
        ->setCellValue(c1(4 , $i+18), cProducto(2,3, $i+18))
        ->setCellValue(c1(5 , $i+18), count($fibra['autonomo']['fibra']['300MB']['Portabilidad']))
        ->setCellValue(c1(6 , $i+18), $formula_13)
        ->setCellValue(c1(7 , $i+18), cProducto(5,6, $i+18))
        ->setCellValue(c1(9 , $i+18), 'Linea S')
        ->setCellValue(c1(10, $i+18), count($movil['autonomo']['linea 1']['S']))
        ->setCellValue(c1(11, $i+18), $formula_23)
        ->setCellValue(c1(12, $i+18), cProducto(10,11, $i+18))
        //
        ->setCellValue(c1(1 , $i+19), 'Fibra 120MB')
        ->setCellValue(c1(2 , $i+19), count($fibra['autonomo']['fibra']['120MB']['Alta Nueva']))
        ->setCellValue(c1(3 , $i+19), $formula_14)
        ->setCellValue(c1(4 , $i+19), cProducto(2,3, $i+19))
        ->setCellValue(c1(5 , $i+19), count($fibra['autonomo']['fibra']['120MB']['Portabilidad']))
        ->setCellValue(c1(6 , $i+19), $formula_14)
        ->setCellValue(c1(7 , $i+19), cProducto(5,6, $i+19))
        ->setCellValue(c1(9 , $i+19), 'Linea M')
        ->setCellValue(c1(10, $i+19), count($movil['autonomo']['linea 1']['M']))
        ->setCellValue(c1(11, $i+19), $formula_23)
        ->setCellValue(c1(12, $i+19), cProducto(10,11, $i+19))
        //
        ->setCellValue(c1(1 , $i+20), 'Fibra 50MB')
        ->setCellValue(c1(2 , $i+20), count($fibra['autonomo']['fibra']['50MB']['Alta Nueva']))
        ->setCellValue(c1(3 , $i+20), $formula_15)
        ->setCellValue(c1(4 , $i+20), cProducto(2,3, $i+20))
        ->setCellValue(c1(5 , $i+20), count($fibra['autonomo']['fibra']['50MB']['Portabilidad']))
        ->setCellValue(c1(6 , $i+20), $formula_15)
        ->setCellValue(c1(7 , $i+20), cProducto(5,6, $i+20))
        ->setCellValue(c1(9 , $i+20), 'Linea L')
        ->setCellValue(c1(10, $i+20), count($movil['autonomo']['linea 1']['L']))
        ->setCellValue(c1(11, $i+20), $formula_23)
        ->setCellValue(c1(12, $i+20), cProducto(10,11, $i+20))
        //
        ->setCellValue(c1(1 , $i+21), 'ADSL')
        ->setCellValue(c1(2 , $i+21), count($fibra['autonomo']['adsl']['Alta Nueva']))
        ->setCellValue(c1(3 , $i+21), $formula_16)
        ->setCellValue(c1(4 , $i+21), cProducto(2,3, $i+21))
        ->setCellValue(c1(5 , $i+21), count($fibra['autonomo']['adsl']['Portabilidad']))
        ->setCellValue(c1(6 , $i+21), $formula_16)
        ->setCellValue(c1(7 , $i+21), cProducto(5,6, $i+21))
        ->setCellValue(c1(9 , $i+21), '')
        ->setCellValue(c1(10, $i+21), '')
        ->setCellValue(c1(11, $i+21), '')
        ->setCellValue(c1(12, $i+21), '')
        //
        ->setCellValue(c1(1 , $i+22), 'TOTAL')
        ->setCellValue(c1(2 , $i+22), '')
        ->setCellValue(c1(3 , $i+22), '')
        ->setCellValue(c1(4 , $i+22), cSuma1(4, $i+18, $i+21))
        ->setCellValue(c1(5 , $i+22), '')
        ->setCellValue(c1(6 , $i+22), '')
        ->setCellValue(c1(7 , $i+22), cSuma1(7, $i+18, $i+21))
        ->setCellValue(c1(9 , $i+22), '')
        ->setCellValue(c1(10, $i+22), '')
        ->setCellValue(c1(11, $i+22), '')
        ->setCellValue(c1(12, $i+22), cSuma1(12, $i+18, $i+21))
        //
        ->setCellValue(c1(9 , $i+24), '2da 3ra')
        ->setCellValue(c1(10, $i+24), 'Cant')
        ->setCellValue(c1(11, $i+24), 'Precio x Venta')
        ->setCellValue(c1(12, $i+24), 'Total')
        //
        ->setCellValue(c1(9 , $i+25), 'Linea S')
        ->setCellValue(c1(10, $i+25), count($movil['autonomo']['linea 2']['S']))
        ->setCellValue(c1(11, $i+25), $formula_23)
        ->setCellValue(c1(12, $i+25), cProducto(10,11, $i+25))
        //
        ->setCellValue(c1(9 , $i+26), 'Linea M')
        ->setCellValue(c1(10, $i+26), count($movil['autonomo']['linea 2']['M']))
        ->setCellValue(c1(11, $i+26), $formula_23)
        ->setCellValue(c1(12, $i+26), cProducto(10,11, $i+26))
        //
        ->setCellValue(c1(9 , $i+27), 'Linea L')
        ->setCellValue(c1(10, $i+27), count($movil['autonomo']['linea 2']['L']))
        ->setCellValue(c1(11, $i+27), $formula_23)
        ->setCellValue(c1(12, $i+27), cProducto(10,11, $i+27))
        //
        ->setCellValue(c1(1 , $i+28), 'FIBRAS')
        ->setCellValue(c1(2 , $i+28), 'LINEAS')
        ->setCellValue(c1(5 , $i+28), 'TOTAL X COBRAR')->mergeCells(c2(5,6,$i+28,$i+28))
        ->setCellValue(c1(7 , $i+28), '=' . c1(4,$i+22) . '+' . c1(7,$i+22) . '+' . c1(12,$i+22) . '+' . c1(12,$i+29) )
        //
        ->setCellValue(c1(1 , $i+29), '='. cSuma2(2, $i+18, $i+21) .'+'.cSuma2(5, $i+18, $i+21))
        ->setCellValue(c1(2 , $i+29), '='. cSuma2(10, $i+18, $i+20) .'+'.cSuma2(10, $i+25, $i+27))
        ->setCellValue(c1(3 , $i+29), '')
        ->setCellValue(c1(12, $i+29), cSuma1(12, $i+25, $i+28))
        // 
        ->setCellValue(c1(1 , $i+31), 'AUTONOMOS + RESIDENCIALES')->mergeCells(c2(1,12,$i+31,$i+31))
        // 
        ->setCellValue(c1(1 , $i+32), 'FIBRAS')
        ->setCellValue(c1(2 , $i+32), 'LINEAS')
        ->setCellValue(c1(5 , $i+32), 'TOTAL X COBRAR')->mergeCells(c2(5,6,$i+32,$i+32))
        ->setCellValue(c1(7 , $i+32), '=' . c1(7,$i+ 13) . '+' . c1(7,$i+28))
        //
        ->setCellValue(c1(1 , $i+33), '=' . c1(1,$i+14) . '+' . c1(1,$i+29))
        ->setCellValue(c1(2 , $i+33), '=' . c1(2,$i+14) . '+' . c1(2,$i+29))
        ;
}
function imprimir_rangos_asesores_ventas() {
    global $objPHPExcel;
    global $border_style;
    $objPHPExcel->setActiveSheetIndex(2);
    // border
    $objPHPExcel->getActiveSheet()->getStyle( c2(1,6   ,  1,22) )->applyFromArray($border_style);
    $objPHPExcel->getActiveSheet()->getStyle( c2(8,10  ,  1,22) )->applyFromArray($border_style);
    // colores
    $objPHPExcel->setActiveSheetIndex(2)
        ->getStyle( c2(1,6  ,  1,2) )->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
        ->getStartColor()->setARGB('FFFFFE00');// amarillo
    $objPHPExcel->setActiveSheetIndex(2)
        ->getStyle(c2(8,10  ,  1,2))->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
        ->getStartColor()->setARGB('FFFFFE00');// amarillo
    
    // formatos
    $formato2 = '[$S/-280A]#,##0.00;[$S/-280A]-#,##0.00';
    $objPHPExcel->getActiveSheet()
        ->getStyle(c2(3,3  ,  1,22))
        ->getNumberFormat()
        ->setFormatCode($formato2);
    $objPHPExcel->getActiveSheet()
        ->getStyle(c2(4,4  ,  1,22))
        ->getNumberFormat()
        ->setFormatCode($formato2);
    $objPHPExcel->getActiveSheet()
        ->getStyle(c2(5,5  ,  1,22))
        ->getNumberFormat()
        ->setFormatCode($formato2);
    $objPHPExcel->getActiveSheet()
        ->getStyle(c2(6,6  ,  1,22))
        ->getNumberFormat()
        ->setFormatCode($formato2);
    $objPHPExcel->getActiveSheet()
        ->getStyle(c2(10,10  ,  1,22))
        ->getNumberFormat()
        ->setFormatCode($formato2);    
    // datos
    $objPHPExcel->setActiveSheetIndex(2)
        ->setCellValue(c1(1  ,  1), '')->mergeCells(c2(1,6  ,  1,1))
        ->setCellValue(c1(8  ,  1), 'LINEAS')->mergeCells(c2(8,10  ,  1,1))        
        //
        ->setCellValue(c1(1  ,  2), 'MAYOR IGUAL')
        ->setCellValue(c1(2  ,  2), 'MENOR')
        ->setCellValue(c1(3  ,  2), '300MB')
        ->setCellValue(c1(4  ,  2), '120MB')
        ->setCellValue(c1(5  ,  2), '50MB')
        ->setCellValue(c1(6  ,  2), 'ADSL')        
        ->setCellValue(c1(8  ,  2), 'MAYOR IGUAL')
        ->setCellValue(c1(9  ,  2), 'MENOR')
        ->setCellValue(c1(10 ,  2), 'MONTO')
        //
        ->setCellValue(c1(1  ,  22), '0')
        ->setCellValue(c1(2  ,  22), '∞')
        ->setCellValue(c1(3  ,  22), '0')
        ->setCellValue(c1(4  ,  22), '0')
        ->setCellValue(c1(5  ,  22), '0')
        ->setCellValue(c1(6  ,  22), '0')        
        ->setCellValue(c1(8  ,  22), '0') // d
        ->setCellValue(c1(9  ,  22), '∞')
        ->setCellValue(c1(10 ,  22), '0')
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
            'style' => PHPExcel_Style_Border::BORDER_MEDIUM,
            'color' => array('argb' => '000000'),
        ),
    ),    
);

if (
    $in['campania_info']['indice'] == 'campania_001' &&
    'Vodafone One' == trim($in['campania_info']['nombre'])
) {
    // body


    // data
    
    $objPHPExcel->setActiveSheetIndex(0);
    imprimir(0
             , 1
             , 'TOTAL'
             , $ou['fibra']['total']
             , $ou['movil']['total']             
    );

    $objPHPExcel->setActiveSheetIndex(1);
    $i = 1;
    foreach($ou['fibra']['supervisor'] as $name => $r) {
        imprimir(1
                 , $i
                 , utf8_encode(strtoupper($name))
                 , $ou['fibra']['supervisor'][$name]
                 , $ou['movil']['supervisor'][$name]
        );
        $i += 36;
    }
    
    imprimir_rangos_asesores_ventas();
    
    $objPHPExcel->setActiveSheetIndex(2);
    $i = 24;
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
        $i += 36;
    }
    

}
$objPHPExcel->setActiveSheetIndex(0);

// header('Content-Type: application/vnd.ms-excel.12');
header('Content-Type: application/vnd.ms-excel');
// header('Content-Disposition: attachment;filename="comisiones-' . $in['anio-mes'] . '.xlsx"');
header('Content-Disposition: attachment;filename="comisiones-' . $in['anio-mes'] . '.xls"');
header('Cache-Control: max-age=0');
// If you're serving to IE 9, then the following may be needed
header('Cache-Control: max-age=1');
 
// If you're serving to IE over SSL, then the following may be needed
header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
header ('Pragma: public'); // HTTP/1.0
 
// $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
// $objWriter->setPreCalculateFormulas(FALSE);
$objWriter->save('php://output');
exit;