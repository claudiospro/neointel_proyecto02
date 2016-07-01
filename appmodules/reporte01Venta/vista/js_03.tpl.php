<?php
// -----------------------------------
if (isset($data['asesores']))
{
    $js_num = count($data['asesores']);
    $js_orden = array();
    $js_encabezado = '';
    foreach($data['asesores'] as $key => $row) {
        $total = 0;
        foreach($row['estados'] as $r)
        {
            $total += $r;
        }
        $js_orden[intval($total)][] = $key;
    }
    krsort($js_orden);
    $js_orden2 = array();
    foreach ($js_orden as $row) {
        foreach ($row as $r) {
            $js_orden2[$r] = $data['asesores'][$r];
        }
    }
    foreach($js_orden2 as $key => $row)
    {
        $total = 0;
        foreach($row['estados'] as $r)
        {
            $total += $r;
        }
        
        $row['info']['fecha_entrada'] = substr($row['info']['fecha_entrada'], 0, -9);
        if ($row['info']['fecha_entrada'] == '0000-00-00') {
            $row['info']['fecha_entrada'] = 'Vacio';
            $dias = 'Vacio';
        } else {
            $datetime1 = date_create($row['info']['fecha_entrada']);
            $datetime2 = date_create(date('Y-m-d'));
            $datetimeR = date_diff($datetime1, $datetime2);
            $dias = $datetimeR->format('%R%a');
        }
        
        if ($js_encabezado != '') $js_encabezado .= ', ';    
        $js_encabezado .= "'" .
                          "<strong>". $key . "</strong> (" . $total . ")" .
                          "<br><strong>Entrada</strong>: " . $row['info']['fecha_entrada'] .
                          "<br><strong>Días Hábiles </strong>: " . $dias .
                          "'";

        
        foreach($data['estados'] as $k => $r)
        {
            if ($data['estados'][$k]['js'] != '')
                $data['estados'][$k]['js'] .= ', ';
            if (isset($row['estados'][$k])) {
                $data['estados'][$k]['js'] .= $row['estados'][$k];
            }
            else
            {
                $data['estados'][$k]['js'] .= '0';    
            }
        }
    }
}
// Utilidades::printr($js_orden);
// Utilidades::printr($js_orden2);
// Utilidades::printr($data['asesores']);
?>

<?php if (isset($data['asesores'])):  ?>
  <script type="text/javascript">
   $(function () {
       $('#pai-0').css('height','<?php echo ($js_num * 75) + 100 ?>px');
       $('#pai-0').highcharts({
           chart: { type: 'bar' },
           title: { text: '' },
           subtitle: { text: '' },
           xAxis: {
               categories: [<?php echo $js_encabezado ?>],
               title: { text: null }
           },
           yAxis: { min: 0, title: { text: 'Ventas', align: 'high' }, labels: { overflow: 'justify' } },
           plotOptions: { bar: { dataLabels: { enabled: true } } },
           credits: { enabled: false },
           series:
           [
               <?php
               $first = true;
               foreach($data['estados'] as $k => $r)
               {
                   if ($first) $first = false;
                   else echo ',';
                   echo "
                   {
                      name: '" . $r['nombre'] . "',
                      color: '" . $color['estado'][$k] . "',
                      data: [" . $r['js'] . "]
                   }
                   ";
               }               
               ?>
           ]
       });
   });
  </script>
<?php endif ?>
