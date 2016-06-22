<script type="text/javascript">
 $(function () {
     <?php    
     if (isset($data)) {
         foreach($data as $key => $row)
         {
             $js = '$("#pai-' . $key . '").highcharts({';
             $js.= 'chart: { type: "pie" },';
             $js.= 'title: { text: "" },';
             $js.= '
         plotOptions: {
             series: {
                 dataLabels: {
                     enabled: true,
                     format: "<span>{point.name}</span> => {point.y} %"
                 }
             }
         },
         tooltip: {
             headerFormat: "<span style=\'font-size:11px\'>{series.name}</span><br>",
             pointFormat:  "<span>{point.name}</span> => <b>{point.y} % </b>"
         },
         series: [{
             name: "Estado",
             colorByPoint: true,
             data: [';
             if (isset($row['estado'])) {
                 $t = 0;
                 foreach($row['estado'] as $r)
                 {
                     $t += $r['y'];
                 }
                 foreach($row['estado'] as $k => $r)
                 {
                     $js.= '{';
                     $js.= ' name: "' . utf8_encode($r['name']) . ' (' . $r['y'] . '/' . $t . ')' . '", ';
                     $js.= ' y: ' . round($r['y']/$t*100,2) . ', ';
                     $js.= " color: '" . $color['estado'][$k] . "', ";
                     if ($r['drilldown'] != '')
                         $js.= 'drilldown: "' . utf8_encode($r['drilldown']) . '"';
                     $js.= '}, ';
                     // break;
                 }
             }
             if (isset($row['cliente_tipo'])) {
                 $t = 0;
                 foreach($row['cliente_tipo'] as $r)
                 {
                     $t += $r['y'];
                 }
                 foreach($row['cliente_tipo'] as $r)
                 {
                     $js.= '{';
                     $js.= ' name: "' . utf8_encode($r['name']) . ' (' . $r['y'] . '/' . $t . ')' . '", ';
                     $js.= ' y: ' . round($r['y']/$t*100,2) . ', ';
                     if ($r['drilldown'] != '')
                         $js.= 'drilldown: "' . utf8_encode($r['drilldown']) . '"';
                     $js.= '}, ';
                     // break;
                 }
             }
             $js.= '
             ]
         }],
         drilldown: {
             series: [';
             if (isset($row['estado_real'])) {
                 foreach($row['estado_real'] as $kk => $rr)
                 {                 
                     $js.= '
                 {
                 name: "' . utf8_encode($kk) . '",
                 id: "' . utf8_encode($kk) . '",
                 data: [';
                     $t = 0;
                     foreach($rr as $r) {
                         $t += $r['y'];
                     }     
                     foreach($rr as $k => $r)
                     {
                         $js.= '{';
                         $js.= ' name: "' . utf8_encode($r['name']) . ' (' . $r['y'] . '/' . $t . ')' . '", ';
                         $js.= ' y: ' . round($r['y']/$t*100,2) . ', ';
                         $js.= " color: '" . $color['estado_real'][$k] . "', ";
                         $js.= '}, ';
                         // break;
                     }
                     
                     $js.= ']},';
                 }
             }             
             $js.=']}';         
             $js.= '});';
             echo $js;         
         }
     }

     ?>
 });

</script>
