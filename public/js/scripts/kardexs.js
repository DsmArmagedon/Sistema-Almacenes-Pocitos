$.fn.select2.defaults.set("theme", "bootstrap");
$('.sel').select2();
$(document).on('click', '#generateMonth', function (e) {
    e.preventDefault();
    errors = [];
    var flag = true;
    var product = $('#product').val();
    var year = $('#year').val();
    if (product === '') {
        flag = false;
        errors.push('El campo Producto es obligatorio');
    }
    if(year === '' ||year === null || year === undefined) {
        flag = false;
        errors.push('El campo Año es obligatorio');
    }
    
    if (flag) {
        $('#formMonth').submit();
    } else {
        $.toast({
        heading: 'ERRORES DE VALIDACION',
        text: errors,
        hideAfter: false,
        position: 'top-left',
        stack: false,
        icon: 'info'
    });
    }
});

$(document).on('click', '#generateProducts', function (e) {
    e.preventDefault();
    $('#formProducts').submit();
});