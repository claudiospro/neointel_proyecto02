$('.datapicker-simple input').fdatepicker({
    format: 'yyyy-mm-dd'
    , language: 'es'
    , weekStart: 1
});
$('.datapicker-simple').on('click', 'a', function (event) {
    $(this).parent().find('input').val('');
});

$('.datapicker-simple-hm input').fdatepicker({
    format: 'yyyy-mm-dd hh:ii'
    , language: 'es'
    , weekStart: 1
    , startView: 1
    , minView: 0
});
$('.datapicker-simple-hm').on('click', 'a', function (event) {
    $(this).parent().find('input').val('');
});


