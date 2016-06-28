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
$fields = array (
    'id' => '',
    'cliente' => '', 'contacto_fijo' => '', 'contacto_movil' => '',
    'fecha_entrega' => '', 'observacion_entrega' => '',
    'distrito' => '', 'direccion' => '',
    'provincia' => '', 'departamento' => '', 'referencia' => '', 'fachada' => '',
    'producto' => '', 'cantidad' => '', 'color' => '',
    'precio' => '', 'costo_envio' => '', 'obsequio' => '',
    'estado_real' => '', 'estado_observacion' => '',
);
$sql = '
SELECT d.id
     , d.cliente_nombre, d.cliente_contacto_fijo, d.cliente_contacto_movil 
     , d.fecha_entrega, d.fecha_entrega_observacion
     , d01.nombre dis, d.direccion
     , d02.nombre, d03.nombre, d.referencia_lugar, d.referencia_fachada
     , d04.nombre, d.producto_cantidad, d05.nombre
     , d.precio, d.costo_envio, d06.nombre
     , d07.nombre, d.estado_observacion 
FROM venta_campania_003 d
JOIN venta v ON v.id = d.id
LEFT JOIN venta_ubigeoPeruDistrito d01 ON d01.id = d.ubigeoPeruDistrito
LEFT JOIN venta_ubigeoPeruProvincia d02 ON d02.id = d.ubigeoPeruProvincia
LEFT JOIN venta_ubigeoPeruDepartamento d03 ON d03.id = d.ubigeoPeruDepartamento
LEFT JOIN venta_producto d04 ON d04.id = d.producto
LEFT JOIN venta_color d05 ON d05.id = d.color
LEFT JOIN venta_obsequio d06 ON d06.id = d.obsequio
LEFT JOIN venta_estado_real d07 ON d07.id = d.estado_real
WHERE v.info_status = 1
';
// print $sql;
if(trim($_SESSION['lineas']) != '') 
    $sql.= ' AND v.lineal_id IN (' . $_SESSION['lineas'] . ')';
if (trim($in['ini'])!='')
    $sql.= ' AND d.fecha_entrega >= "' . $in['ini'] . ' 00:00:00"';
if (trim($in['end'])!='') 
    $sql.= ' AND d.fecha_entrega <= "' . $in['end'] . ' 23:59:59"';


$ou = $venta->setSQL($fields, $sql);
$j = 0;
$objPHPExcel->setActiveSheetIndex(0)
    ->setCellValue( c0(++$j).(1) , 'PRIORIDAD')
    ->setCellValue( c0(++$j).(1) , 'DISTRITO')
    ->setCellValue( c0(++$j).(1) , 'OBSERVACIÓN DE ENTREGA')
    ->setCellValue( c0(++$j).(1) , 'HORA')
    ->setCellValue( c0(++$j).(1) , 'FECHA DE ENTREGA')
    ->setCellValue( c0(++$j).(1) , 'CLIENTE')
    ->setCellValue( c0(++$j).(1) , 'TELEFONO FIJO')
    ->setCellValue( c0(++$j).(1) , 'TELEFONO MOVIL')
    ->setCellValue( c0(++$j).(1) , 'DIRECCION')
    ->setCellValue( c0(++$j).(1) , 'DISTRITO')
    ->setCellValue( c0(++$j).(1) , 'URBANIZACIÓN')
    ->setCellValue( c0(++$j).(1) , 'PROVINCIA')
    ->setCellValue( c0(++$j).(1) , 'DEPARTAMENTO')
    ->setCellValue( c0(++$j).(1) , 'REFERENCIA')
    ->setCellValue( c0(++$j).(1) , 'FACHADA')
    ->setCellValue( c0(++$j).(1) , 'PRODUCTO')
    ->setCellValue( c0(++$j).(1) , 'CANTIDAD')
    ->setCellValue( c0(++$j).(1) , 'COLOR')
    ->setCellValue( c0(++$j).(1) , 'PRECIO')
    ->setCellValue( c0(++$j).(1) , 'COSTO DE ENVIO')
    ->setCellValue( c0(++$j).(1) , 'OBSEQUIO')
    ->setCellValue( c0(++$j).(1) , 'OBSERVACIÓN')
    ->setCellValue( c0(++$j).(1) , 'ESTADO')
    ;
$objPHPExcel->getActiveSheet()
    ->getStyle(c2(1,$j,1,1))
    ->applyFromArray($border_style);
$objPHPExcel->setActiveSheetIndex(0)
    ->getStyle(c2(1,$j,1,1))->getFill()
    ->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
    ->getStartColor()->setARGB('FFFFBF00');

$j = 0;
$objPHPExcel->getActiveSheet()->getColumnDimension(c0(++$j))->setWidth(20); // prioridad
$objPHPExcel->getActiveSheet()->getColumnDimension(c0(++$j))->setWidth(30); // distrito
$objPHPExcel->getActiveSheet()->getColumnDimension(c0(++$j))->setWidth(30); // observacion entre
$objPHPExcel->getActiveSheet()->getColumnDimension(c0(++$j))->setWidth(15); // hora de entrega
$objPHPExcel->getActiveSheet()->getColumnDimension(c0(++$j))->setWidth(17); // fecha entrega
$objPHPExcel->getActiveSheet()->getColumnDimension(c0(++$j))->setWidth(30); // cliente
$objPHPExcel->getActiveSheet()->getColumnDimension(c0(++$j))->setWidth(15); // fijo
$objPHPExcel->getActiveSheet()->getColumnDimension(c0(++$j))->setWidth(15); // movil
$objPHPExcel->getActiveSheet()->getColumnDimension(c0(++$j))->setWidth(40); // direccion
$objPHPExcel->getActiveSheet()->getColumnDimension(c0(++$j))->setWidth(30); // distrito
$objPHPExcel->getActiveSheet()->getColumnDimension(c0(++$j))->setWidth(30); // urbanizacion
$objPHPExcel->getActiveSheet()->getColumnDimension(c0(++$j))->setWidth(30); // provincia
$objPHPExcel->getActiveSheet()->getColumnDimension(c0(++$j))->setWidth(30); // departamento
$objPHPExcel->getActiveSheet()->getColumnDimension(c0(++$j))->setWidth(40); // referencia 
$objPHPExcel->getActiveSheet()->getColumnDimension(c0(++$j))->setWidth(40); // fachada
$objPHPExcel->getActiveSheet()->getColumnDimension(c0(++$j))->setWidth(15); // producto
$objPHPExcel->getActiveSheet()->getColumnDimension(c0(++$j))->setWidth(7);  // cantidad
$objPHPExcel->getActiveSheet()->getColumnDimension(c0(++$j))->setWidth(15); // color
$objPHPExcel->getActiveSheet()->getColumnDimension(c0(++$j))->setWidth(15); // precio
$objPHPExcel->getActiveSheet()->getColumnDimension(c0(++$j))->setWidth(15); // costo_envio
$objPHPExcel->getActiveSheet()->getColumnDimension(c0(++$j))->setWidth(25); // obsequio
$objPHPExcel->getActiveSheet()->getColumnDimension(c0(++$j))->setWidth(30); // observacion
$objPHPExcel->getActiveSheet()->getColumnDimension(c0(++$j))->setWidth(20); // estado_real

if (isset($ou))
{
    $i = 1;
    foreach($ou as $row )
    {
        $i++;
        $j = 0;
        $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue( c0(++$j).($i) , '' )
            ->setCellValue( c0(++$j).($i) , $row['distrito'] )
            ->setCellValue( c0(++$j).($i) , strtoupper(utf8_encode($row['observacion_entrega'])) )
            ->setCellValue( c0(++$j).($i) , '' )
            ->setCellValue( c0(++$j).($i) , substr($row['fecha_entrega'], 0, -9) )
            ->setCellValue( c0(++$j).($i) , strtoupper(utf8_encode($row['cliente'])) )
            ->setCellValue( c0(++$j).($i) , utf8_encode($row['contacto_fijo']) )
            ->setCellValue( c0(++$j).($i) , utf8_encode($row['contacto_movil']) )
            ->setCellValue( c0(++$j).($i) , utf8_encode($row['direccion']) )
            ->setCellValue( c0(++$j).($i) , $row['distrito'] )
            ->setCellValue( c0(++$j).($i) , '' )
            ->setCellValue( c0(++$j).($i) , $row['provincia'] )
            ->setCellValue( c0(++$j).($i) , $row['departamento'] )
            ->setCellValue( c0(++$j).($i) , strtoupper($row['referencia']) )
            ->setCellValue( c0(++$j).($i) , strtoupper($row['fachada']) )
            ->setCellValue( c0(++$j).($i) , strtoupper($row['producto']) )
            ->setCellValue( c0(++$j).($i) , strtoupper($row['cantidad']) )
            ->setCellValue( c0(++$j).($i) , strtoupper($row['color']) )
            ->setCellValue( c0(++$j).($i) , strtoupper($row['precio']) )
            ->setCellValue( c0(++$j).($i) , strtoupper($row['costo_envio']) )
            ->setCellValue( c0(++$j).($i) , strtoupper($row['obsequio']) )
            ->setCellValue( c0(++$j).($i) , strtoupper($row['estado_observacion']) )
            ->setCellValue( c0(++$j).($i) , strtoupper($row['estado_real']) )            
            ;
        $objPHPExcel->getActiveSheet()
            ->getStyle(c2(1,$j,$i,$i))
            ->applyFromArray($border_style);
    }
}
 
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