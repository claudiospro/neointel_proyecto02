$('.datapicker-simple input').fdatepicker({
    format: 'yyyy-mm-dd'
    , language: 'es'
    , weekStart: 1
});
$('.datapicker-simple').on('click', 'a', function (event) {
    $(this).parent().find('input').val('');
});
