<?php
// include "../../../../../lib/mysql/dbconnector.php";
// include "../../../../../lib/mysql/conexion01.php";
// include "../../../../../lib/mysql/utilidades.php";
// include "../../../modelo/ModeloVenta.php";
 
// require_once  '../../../../../lib/vendor/phpExcel-1.8.0/Classes/PHPExcel.php';
 
// function getNameFromNumber($num) {
//     $numeric = ($num - 1) % 26;
//     $letter = chr(65 + $numeric);
//     $num2 = intval(($num - 1) / 26);
//     if ($num2 > 0) {
//         return getNameFromNumber($num2) . $letter;
//     } else {
//         return $letter;
//     }
// }
 
// $objPHPExcel = new PHPExcel();
// $objPHPExcel->getProperties()->setCreator("Claudio Rodriguez Ore");
 
// session_start();
// $venta = new ModeloVenta();
// // -------------------------------------------------------- INPUT
// $in['ini'] = Utilidades::clear_input($_GET['ini']);
// $in['end'] = Utilidades::clear_input($_GET['end']);
// $in['campania'] = Utilidades::clear_input($_GET['campania']);
 
// // -------------------------------------------------------- Data
// $ou = $venta->getDeclarativo_02($in);
 
// if ($ou['head'] != null) {
//     $j = 1;
//     foreach($ou['head'] as $row ) {
//         // $objPHPExcel->setActiveSheetIndex(0)->mergeCells('A1:C1');
//         $objPHPExcel->setActiveSheetIndex(0)->setCellValue(getNameFromNumber($j).'1', $row['name']);
//         if ( 1 == intval($row['items'])) {
//             $objPHPExcel->setActiveSheetIndex(0)->mergeCells(getNameFromNumber($j).'1:'.getNameFromNumber($j) .'2');
//         } else {
//             $objPHPExcel->setActiveSheetIndex(0)->mergeCells(getNameFromNumber($j).'1:'.getNameFromNumber($j+$row['items']-1) .'1');
//             $k = $j;
//             foreach($row['list'] as $col ) {
//                 $objPHPExcel->setActiveSheetIndex(0)->setCellValue(getNameFromNumber($k).'2', $col);
//                 $k++;
//             }
//         }
//         $j+= $row['items'];
//     }
// }
 
// $i = 3;
// if ($ou['body'] != null) {
//     foreach($ou['body'] as $row ) {
//         $j=1;
//         foreach($row  as $name => $value) {
//             if (strpos($name, '_correo') !== false && $value == '') {
//                 $value = 'nodispone@hotmail.com';
//             }
//             $objPHPExcel
//                 ->setActiveSheetIndex(0)
//                 ->setCellValue(getNameFromNumber($j).''.$i,
//                                $venta->getDeclarativo_value($value, $ou['info'][$name])
//                 );
//             $j++;
//         }
//         $i++;
//     }
// }
 
// // -------------------------------------------------------- TEST
// // Utilidades::printr($in);
// // Utilidades::printr($_SESSION);
// // Utilidades::printr($campos);
// // Utilidades::printr($ou);
 
// // -------------------------------------------------------- OUT
// $objPHPExcel->getActiveSheet()->setTitle('Data');
// $objPHPExcel->setActiveSheetIndex(0);
 
// header('Content-Type: application/vnd.ms-excel');
// header('Content-Disposition: attachment;filename="data-' . date('Y-m-d His') . '.xls"');
// header('Cache-Control: max-age=0');
// // If you're serving to IE 9, then the following may be needed
// header('Cache-Control: max-age=1');
 
// // If you're serving to IE over SSL, then the following may be needed
// header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
// header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
// header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
// header ('Pragma: public'); // HTTP/1.0
 
// $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
// $objWriter->save('php://output');
// exit;