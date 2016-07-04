<?php
if (isset($data['ventas']))
{
    $js_encabezado = "";
    foreach($data['ventas']['listado'] as $key => $row)
    {
        if ($js_encabezado != '') $js_encabezado .= ', ';
        $js_encabezado .= "'" . $key . "'";
        foreach($data['estados'] as $k => $r)
        {
            if ($data['estados'][$k]['js'] != '')
                $data['estados'][$k]['js'] .= ', ';
            
            if (isset($row[$k]))
                $data['estados'][$k]['js'] .= $row[$k];
            else
                $data['estados'][$k]['js'] .= 'null';
        }
    }
}


// Utilidades::printr($data);
?>
<?php if (isset($data['ventas'])): ?>
  <script>
   $('#pai-0').highcharts({
       title: { text: 'Historico', x: -20 /*center*/ },
       subtitle: { text: '', x: -20 },
       xAxis: {
           categories:
           [
               <?php echo $js_encabezado ?>
           ]
       },
       yAxis: {
           title: { text: 'Ventas' }, plotLines: [{ value: 0, width: 2, color: 'black' }]
       },
       tooltip: { valueSuffix: 'Ventas' },
       legend: { layout: 'vertical', align: 'right', verticalAlign: 'middle', borderWidth: 0 },
       series:
       [
           <?php
           $first =true;
           foreach($data['estados'] as $key => $row)
           {
               if (!$first) echo ', ';
               else $first = false;
               
               echo '
               {
                  name: "'.utf8_decode($row['nombre']).'",
                  color: "' . $color['estado'][$key] . '",
                  data: [' . $row['js'] . ']
               }       
               ';
           }
           ?>
       ]
   });
  </script>
<?php endif ?>
