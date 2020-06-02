$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$(document).on('click', '.close-modal', function(e) {
    e.preventDefault();
    limpiarForms();
    $.toast().reset('all');
    $('#save').removeClass('store update');
});

$(document).on('click', '#agregar', function(e) {
    e.preventDefault();
    var route = $(this).attr('data-url');
    $('#formProduct').attr('data-url', route);
    $('#title').text('Crear Producto');
    $('#save').addClass('store');
    $('#modalProduct').modal({
        backdrop: 'static',
        keyboard: false,
        show: true
    });
});
$(document).on('click', '.store', function(e) {
    e.preventDefault();

    var elements = {
        method: 'post',
        heading: 'GUARDADO',
        removeClassSave: 'store'
    };
    setStoreUpdateAjax(elements);
});
$(document).on('click', '.update', function(e) {
    e.preventDefault();

    var elements = {
        method: 'put',
        heading: 'ACTUALIZADO',
        removeClassSave: 'update'
    };
    setStoreUpdateAjax(elements);
});

$(document).on('click', '#btn-limpiar', function(e) {
    e.preventDefault();
    $('#product_code').val('');
    $('#product_description').val('');
    $('#product_stock').val('');
    $('#product_price').val('');
    $('#product_unit').val('');
    $('#product_status').val('');
});
$(document).on('click', '.edit', function(e) {
    e.preventDefault();
    $('#title').text('Editar Producto');
    $('#save').addClass('update');
    var url = $(this).attr('data-url');
    var route = $(this).attr('data-route');
    $('#formProduct').attr('data-url', route);
    $.ajax({
        type: 'GET',
        url: url,
        dataType: 'json',
        success: function(data) {
            $('#modalProduct').modal({
                backdrop: 'static',
                keyboard: false,
                show: true
            });
            $('#code').val(data.code);
            $('#description').val(data.description);
            $('#price').val(data.price);
            $('#unit').val(data.unit);
            if (data.status == 1) {
                $('#statusH').prop('checked', true);
            } else {
                $('#statusD').prop('checked', true);
            }
        },
        error: function(e) {}
    });
});
$(document).on('click', '.delete', function(e) {
    e.preventDefault();
    var elements = {
        model: 'Producto',
        title: $(this).attr('data-description'),
        url: $(this).attr('data-url'),
        row: $(this).parents('tr')
    };
    deleteAjax(elements);
});

function getListAjax(url) {
    var per_page = $('#per-page').val();
    var data = {
        product_code: $('#product_code').val(),
        product_description: $('#product_description').val(),
        product_parameter_price: $('#product_parameter_price').val(),
        product_amount_price: $('#product_amount_price').val(),
        product_parameter_stock: $('#product_parameter_stock').val(),
        product_amount_stock: $('#product_amount_stock').val(),
        product_price: $('#product_price').val(),
        product_unit: $('#product_unit').val(),
        product_status: $('#product_status').val(),
        per_page: per_page
    };
    $.ajax({
        type: 'GET',
        url: url,
        data: data,
        dataType: 'json',
        success: function(data) {
            $('#table-products').html(data);
            $('#per-page').val(per_page);
        },
        error: function(e) {}
    });
}

function setStoreUpdateAjax(elements) {
    var data = $('#formProduct').serialize();
    var url = $('#formProduct').attr('data-url');
    $.ajax({
        type: elements.method,
        url: url,
        data: data,
        dataType: 'json',
        success: function(data) {
            $.toast().reset('all');
            Swal.fire(
                elements.heading,
                data.message,
                'success'
            );
            limpiarForms();
            var url = $('#route-url').attr('data-url');
            getListAjax(url);
            $('#save').removeClass(elements.removeClassSave);
            $('#modalProduct').modal('hide');
        },
        error: function(e) {
            if (e.status === 422) {

                errorsValidation(e.responseJSON);
            } else {
                errorToast(e.responseJSON.error);
            }
        }
    });
}

function limpiarForms() {
    $('#formProduct input[type="text"]').each(function() {
        $(this).val('');
    });
    $('#statusH').prop('checked', true);
}