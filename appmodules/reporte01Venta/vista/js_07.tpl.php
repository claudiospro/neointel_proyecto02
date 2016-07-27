<?php if (isset($data)): ?>
  <script type="text/javascript">
   $(function () {
       // Create the chart
       $('#pai-0').highcharts({
           chart: { type: 'pie' },
           title: { text: '' },
           subtitle: { text: '' },
           plotOptions: {
               series: {
                   dataLabels: {
                       enabled: true,
                       format: '{point.name} => {point.y} %'
                   }
               }
           },
           tooltip: {
               headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
               pointFormat: '<span>{point.name}</span> => <b>{point.y} % </b>'
           },
           series: [
               {
                   name: 'Brands',
                   colorByPoint: true,
                   data:
                   [
                       <?php
                       $t = 0;
                       foreach($data[0]['producto'] as $row)
                       {
                           $t += $row['y'];
                       }
                       $first = true;
                       foreach($data[0]['producto'] as $k => $r)
                       {
                           if (!$first) echo ', ';
                           else $first = false;
                           echo '
                           {
                             name: "' . utf8_encode($r['name']) . ' (' . $r['y'] . '/' . $t . ')' . '",
                             y: ' . round($r['y']/$t*100,2) . ',
                             drilldown: "' . utf8_encode($r['drilldown']) . '"
                           }
                           ';
                       }
                       ?>
                   ]
               }],
           drilldown: {
               series:
               [
                   <?php
                   $first = true;
                   foreach($data[0]['estado'] as $k => $r)
                   {
                       $js = '';
                       $t = 0;
                       foreach($r as $row) {
                           $t += $row['y'];
                       }
                       foreach($r as $key => $row) {
                           if ($js != '') $js .= ', ';
                           $js .= '
                           {
                              name: "' . utf8_encode($row['name']) . ' (' . $row['y'] . '/' . $t . ')' . '",
                              y: ' . round($row['y']/$t*100,2) . ',
                              color: "'. $color['estado'][$key] .'"
                           }
                           ';
                       }                       
                       if (!$first) echo ', ';
                       else $first = false;
                       echo '
                           {
                             name: "' . utf8_encode($k) . '",
                             id: "' . utf8_encode($k) . '",
                             data: [ ' . $js . ' ]
                           }
                           ';
                   }
                   ?>                  
               ]
           }
       });
   });
  </script> 
<?php endif ?>
