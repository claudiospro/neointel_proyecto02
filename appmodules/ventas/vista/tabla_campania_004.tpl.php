<?php
$combo = new OptionComboSimple();

$pr['campania'] = Utilidades::clear_input($in['campania']);
$campos = $modelo->getCampos($in, true);
//Utilidades::dump($campos);

$test = false;
$perfil_id = $_SESSION['perfiles_id'];


$ver = array();
$declarativo = '
<a class="report" title="Declarativo" 
   data-open="venta_listado_modal_declarativo_div">
   <i class="fi-page-add size-36" style="color: rgb(204, 146, 12);"></i>
</a>';
if ($perfil_id == '1') {
  $ver = array();
}
elseif ($perfil_id == '4') {
  $ver = array(1);
  $declarativo = "";
}
elseif ($perfil_id == '5') {
  $ver = array(0,1);
  $declarativo = "";
}


?>


<table id="<?php echo $prefix . 'tabla' ?>" style="width: 100%;">
  <thead>
  <?php
  if($test) {
    echo '<tr>';
    echo "<td>" . ++$i . "</td>";
    echo "<td>" . ++$i . "</td>";
    foreach ($campos as $i => $campo) {
          $i += 2;
          echo "<td>{$i}</td>";
      }


    echo "<td>" . ++$i . "</td>";
      echo '</tr>';
  }

  echo '<tr>';

  $i = -1;
  echo "<th style='width: 100px;'><input class='no-margin search-input-text' data-column='" . ++$i . "'  type='text'></th>";
  echo "<th style='width: 100px;'><input class='no-margin search-input-text' data-column='" . ++$i . "'  type='text'></th>";
  foreach ($campos as $i => $campo) {
      $i += 2;
      $width = '';
      if ($campo['listado_ancho'] > 0) {
        $width = "width: {$campo['listado_ancho']}px;";
      }

      $l1 = explode(', ', $campo['perfiles']);
      $l2 = explode(', ', $campo['listado_permisos']);

//      Utilidades::dump($i );

      if ($l2[array_search($perfil_id, $l1)] == '0') {
        $ver[] = $i;
      }


      echo "<th style='$width'>";
      if ($campo['tipo']=='VARCHAR' && $campo['diccionario'] == '0') {
        echo "<input class='no-margin search-input-text' data-column='{$i}'  type='text'>";
      }
      elseif ($campo['tipo']=='VARCHAR' && $campo['diccionario'] == '2') {
        $l = $modelo->getListado($campo['nombre']);
        echo "<select 
                  class='search-input-select'
                  data-column='{$i}' 
                  style='margin: 0;height: auto;width: calc(100% - 18px);'>";
        $combo->set_format(array('id', 'nombre'));
        $combo->imprimir($l);
        echo "</select>";
      }
      else {
        echo "<input class='no-margin search-input-text' data-column='{$i}'  type='text'>";
      }
      echo "</th>";
  }
  echo '<th style="width: 100px; text-align: center;">
          <span style="display: block;">
            <a title="ReCargar" class="reload"><i class="fi-refresh size-36"></i></a>
            ' . $declarativo . '
          </span>
         </th>';

  echo '</tr>';

  echo '<tr>';
  echo "<td>Supervisor</td>";
  echo "<td>Asesor</td>";
  foreach ($campos as $i => $campo) {
    echo "<td>{$campo['listado_label']}</td>";
  }
  echo "<td>Acciones</td>";
  echo '</tr>';
  ?>
  </thead>
</table>


<?php
$ver_js = implode(',',$ver);
?>

<?php ob_start() ?>
<script>
    $(function() {
        var prefixId = '#venta_listado_';
        var ver = [<?php echo  $ver_js; ?>];

        $(prefixId+'tabla .search-input-text').on('keyup click', function (event) {
            var i = $(this).attr('data-column');
            var v = $(this).val();
            if (event.which == 13) {
                dataTable_listado.columns(i).search(v).draw();
                if (v=='') {
                    $(this).removeClass('active');
                } else {
                    $(this).addClass('active');
                }
            }
        });

        $(prefixId+'tabla .search-input-select').on( 'change', function () {
            var i =$(this).attr('data-column');
            var v =$(this).val();
            dataTable_listado.columns(i).search(v).draw();
            if (v=='') {
                $(this).removeClass('active');
            } else {
                $(this).addClass('active');
            }
        });

        $(prefixId+'add').on('click', function (event) {
            venta_listado_modal_add();
        });

        $(prefixId+'tabla').on('click', '.edit', function (event) {
            venta_listado_modal_edit($(this));
        });

        $(prefixId+'tabla').on('click', '.view', function (event) {

            venta_listado_modal_view($(this));
        });

        $(prefixId+'tabla').on('click', '.delete', function (event) {
            venta_listado_modal_delete($(this));
        });

        $(prefixId+'tabla .reload').on('click', function (event) {
            dataTable_listado.draw();
        });

        dataTable_listado = $(prefixId+'tabla').DataTable({
            'processing' : true,
            'serverSide' : true,
            'lengthChange': false,
            'info': true,
            'pageLength' : 20,
            // 'order'      : [ order, 'desc' ],
            'aoColumnDefs': [
            //     { 'aTargets': unsortable, 'bSortable': false },
            { 'targets': ver, 'visible': false }
            ],
            "language": {
                "lengthMenu": "Display _MENU_ records per page",
                "zeroRecords": "No se encontraron resultados",
                "info": "Mostrando Pagina _PAGE_ de _PAGES_",
                "infoEmpty": "No se econtraron resultados",
                "infoFiltered": "(Filtrados de _MAX_ registros en total)",
                "paginate": {
                    "previous": "Anterior",
                    "next": "Siguiente"
                }
            },
            'ajax': {
                url :'./procesos/ajax/table/ventas_listado_datatable.php?campania=<?php echo $pr['campania'] ?>',
                type: 'post',
            },
        });

        $(prefixId+'tabla_filter').hide();

        $('body').on('click', 'form.myform a.save-exit', function (e) {
            var ou = venta_listado_modal_save_validate();
            if (ou == '0') {
                e.stopPropagation();
            } else {
                venta_listado_modal_save_exit();
            }
        });

        function venta_listado_modal_add()
        {
            var enviar = {
                'campania': $(prefixId+'campanias').val(),
                'venta_id': '0',
                'view': '0',
            }
            // c(enviar);
            element_simple(
                './procesos/ajax/click/ventas_listado_view_modal.php',
                prefixId+'modal_div .ajax',
                enviar
            );
        }

        function venta_listado_modal_view(item)
        {
            var enviar = {
                'campania': item.attr('campania'),
                'venta_id': item.attr('venta_id'),
                'view': 1,
            }
            // c(enviar);
            element_simple(
                './procesos/ajax/click/ventas_listado_view_modal.php',
                prefixId+'modal_div .ajax',
                enviar
            );
        }

        function venta_listado_modal_edit(item)
        {
            var enviar = {
                'campania': item.attr('campania'),
                'venta_id': item.attr('venta_id'),
                'view': '0',
            }
            // c(enviar);
            element_simple(
                './procesos/ajax/click/ventas_listado_view_modal.php',
                prefixId+'modal_div .ajax',
                enviar
            );
        }

        function venta_listado_modal_delete(item)
        {
            var perfil = $(prefixId+'perfiles').val();
            var title = item.attr('title');
            var enviar = {
                'venta_id': item.attr('venta_id')
            }
            var eliminar = confirm('¿Desea realmente eliminar ' + title + '?');
            if (eliminar) {
                none_simple(
                    './procesos/ajax/delete/ventas_listado_venta_delete.php',
                    enviar
                );
                // ajax cambiar (segun estado si es 1 a 0 si es 0 a 1)
                if (perfil == 'Asesor Comercial' || perfil == 'Supervisor' || perfil == 'Tramitacion' ) {
                    item.parent().parent().parent().css( 'background-color', '#FEC7C7' );
                    var myVar = setInterval( function(){
                        item.parent().parent().parent().remove();
                        clearInterval(myVar);
                    }, 2100);
                } else {
                    dataTable_listado
                        .search(enviar.venta_id)
                        .draw();
                    dataTable_listado
                        .search('');
                }
            }

        }

        function venta_listado_modal_save_validate()
        {
            var ou = 1, required = 1, email = 1, telefono = 1, banco24 = 1, banco22 = 1, msg = '';

            $.each($("form.myform input"), function (index, value) {
                if(!$(value).val() && $(value).hasClass('required')) {
                    $(value).addClass('error');
                    required = 0;
                } else {
                    $(value).removeClass('error');
                }
                if( $(value).val() &&  $(value).attr('type') == 'email'  ) {
                    if( !validateEmail($(value).val()) ) {
                        $(value).addClass('error');
                        email  = 0;
                    }
                    else {
                        $(value).removeClass('error');
                    }

                }
                if( $(value).val() &&  $(value).hasClass('venta_item_telefono') ) {
                    if(  $(value).val().length != 9 ) {
                        $(value).addClass('error');
                        telefono  = 0;
                    }
                    else {
                        $(value).removeClass('error');
                    }

                }
                if( $(value).val() &&  $(value).hasClass('banco24') ) {
                    if(  $(value).val().length != 24 ) {
                        $(value).addClass('error');
                        banco24  = 0;
                    }
                    else {
                        $(value).removeClass('error');
                    }
                }
                if( $(value).val() &&  $(value).hasClass('banco22') ) {
                    if(  $(value).val().length != 22 ) {
                        $(value).addClass('error');
                        banco22  = 0;
                    }
                    else {
                        $(value).removeClass('error');
                    }
                }
            });
            $.each($("form.myform select"), function (index, value) {
                if($(value).val() == '0' && $(value).hasClass('required')) {
                    $(value).addClass('error');
                    required = 0;
                }
                else {
                    $(value).removeClass('error');
                }
            });
            $.each($("form.myform textarea"), function (index, value) {
                if(!$(value).val() && $(value).hasClass('required')) {
                    $(value).addClass('error');
                    required = 0;
                }
                else {
                    $(value).removeClass('error');
                }
            });

            if (required == 0) {
                msg += 'Falta un/unos campo(s) Obligatorio(s) \n';
                ou = 0;
            }
            if (email == 0) {
                msg += 'Error en un/unos campo(s) Mail \n';
                ou = 0;
            }
            if (telefono == 0) {
                msg += 'Error en un/unos campo(s) de Teléfono(s) \n';
                ou = 0;
            }
            if (banco24 == 0) {
                msg += 'Error en Cuenta Bancaria debe tener 24 caracteres \n';
                ou = 0;
            }
            if (banco22 == 0) {
                msg += 'Error en CUPS debe tener 22 caracteres \n';
                ou = 0;
            }
            if (ou == 0) {
                a(msg);
            }
            return ou;

        }

        function venta_listado_modal_save_continue()
        {
            var enviar = $("form.myform").serialize();
            // c(enviar);
            $.ajax({
                type: "POST",
                data: enviar,
                url: './procesos/ajax/save/ventas_listado_venta_click_save.php',
                success: function(data) {
                    $('#field_venta_id').val(data);
                }
            });
        }

        function venta_listado_modal_save_exit0()
        {

        }

        function venta_listado_modal_save_exit()
        {
            var enviar = $("form.myform").serialize();
            $.ajax({
                type: "POST",
                data: enviar,
                url: './procesos/ajax/save/ventas_listado_venta_click_save.php',
                success: function(data) {
                    // $('.item-datatable-' + data).parent().parent().addClass('active');
                    dataTable_listado
                    // .search(data)
                        .draw();
                    // dataTable_listado
                    //     .search('');
                    // var myVar = setInterval(function() {
                    //     $('.item-datatable-' + data).parent().parent().addClass('active');
                    //     clearInterval(myVar);
                    // }, 1000);
                }
            });
        }

        function validateEmail(email)
        {
            if (email != '') {
                var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
                return re.test(email);
            } else {
                return false;
            }

        }

        function c(i) {console.log(i)}
        function a(i) {alert(i)}
    });



</script>
<?php $js .= ob_get_clean() ?>