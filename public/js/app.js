$(document).ready(function() {
    $('.collapse-search').click(function() {
        var icon = $('#icon-collapse').attr('class');
        if (icon === 'fa fa-plus') {
            $('#btn-limpiar').removeClass('hidden-btn-limpiar');
        } else {
            $('#btn-limpiar').addClass('hidden-btn-limpiar');
        }
    });
});

function errorsValidation(e) {
    var errors = [];
    for (const objeto in e.errors) {
        errors.push(...e.errors[objeto]);
    }
    $.toast({
        heading: 'ERRORES DE VALIDACION',
        text: errors,
        hideAfter: false,
        position: 'top-left',
        stack: false,
        icon: 'info'
    });
}

$(document).on('click', '.pagination a', function(e) {
    e.preventDefault();
    var url = $(this).attr('href');
    getListAjax(url);
});
$(document).on('change', '#per-page', function(e) {
    e.preventDefault();
    var url = $('#route-url').attr('data-url');
    getListAjax(url);
});
$(document).on('click', '#search', function(e) {
    e.preventDefault();
    var url = $('#route-url').attr('data-url');
    getListAjax(url);
});

function deleteAjax(elements) {
    Swal.fire({
        title: `Eliminar ${elements.model}`,
        html: `¿Está seguro que desea eliminar al ${elements.model.toLowerCase()}:</br><b> ${elements.title}</b>?`,
        type: 'info',
        showCancelButton: true,
        confirmButtonColor: 'primary',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Confirmar',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.value) {
            $.ajax({
                type: 'delete',
                url: elements.url,
                dataType: 'json',
                success: function(data) {
                    elements.row.fadeOut();
                    Swal.fire(
                        'ELIMINADO',
                        data.message,
                        'success'
                    );
                },
                error: function(e) {
                    errorToast(elements.model, e.responseJSON.error);
                }
            });
        }
    });
}

function errorToast(heading, text = 'Error consulte con el Administrador') {
    $.toast({
        heading: heading.toUpperCase(),
        text: text,
        hideAfter: 7000,
        position: 'top-left',
        icon: 'error'
    });
}