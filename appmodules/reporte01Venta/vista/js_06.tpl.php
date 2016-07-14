<?php
if (isset($data['ventas']))
{
    $js_encabezado = "";
    $js_contenido = "";
    $js_total = 0;
    $first = true;
    foreach($data['ventas']['listado'] as $key => $row)
    {
        if (!$first)
        {
            $js_encabezado .= ', ';
            $js_contenido  .= ', ';
        } else
        {
            $first = false;
        }
        $js_encabezado .= "'" . $key . "'";
        $js_contenido  .= $row ;
        $js_total += $row;
    }
}
?>

<?php if (isset($data['ventas'])): ?>
  <script>
   $('#pai-0').highcharts({
       chart: {
           type: 'column'
       },
       title: { text: '' },
       subtitle: { text: '' },
       xAxis: {
           categories: [<?php echo $js_encabezado ?>],
           crosshair: true
       },
       yAxis: { min: 0, title: { text: 'Ventas' } },
       series:
       [
           {
               name: 'Ventas (<?php echo $js_total ?>)',
               color: '<?php echo $color['estado'][2]  ?>',
               data: [<?php echo $js_contenido ?>]
           }
       ]
   });
  </script>
<?php endif ?>
