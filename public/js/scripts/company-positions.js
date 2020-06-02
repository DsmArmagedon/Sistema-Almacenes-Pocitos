$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$(document).on('click', '.close-modal', function (e) {
    e.preventDefault();
    limpiarForms();
    $.toast().reset('all');
    $('#save').removeClass('store update');
});

$(document).on('click', '#btn-limpiar', function (e) {
    e.preventDefault();
    $('#company_position_name').val('');
    $('#company_position_description').val('');
    $('#company_position_status').val('');
});

$(document).on('click', '#agregar', function (e) {
    e.preventDefault();
    var route = $(this).attr('data-url');
    $('#formCompanyPosition').attr('data-url', route);
    $('#title').text('Crear Cargo');
    $('#save').addClass('store');
    $('#modalCompanyPosition').modal({
        backdrop: 'static',
        keyboard: false,
        show: true
    });
});
$(document).on('click', '.store', function (e) {
    e.preventDefault();
    var elements = {
        method: 'POST',
        heading: 'GUARDADO'
    };
    setStoreUpdateAjax(elements);
});
$(document).on('click', '.update', function (e) {
    e.preventDefault();
    var elements = {
        method: 'put',
        heading: 'ACTUALIZADO',
        removeClassSave: 'update',
    };
    setStoreUpdateAjax(elements);
});
$(document).on('click', '.edit', function (e) {
    e.preventDefault();
    $('#title').text('Editar Cargo');
    $('#save').addClass('update');
    var route = $(this).attr('data-route');
    var url = $(this).attr('data-url');
    $('#formCompanyPosition').attr('data-url', route);
    $.ajax({
        type: 'GET',
        url: url,
        dataType: 'json',
        success: function (data) {
            $('#modalCompanyPosition').modal({
                backdrop: 'static',
                keyboard: false,
                show: true
            });
            $('#id').val(data.id);
            $('#name').val(data.name);
            $('#description').val(data.description);
            if (data.status == 1) {
                $('#statusH').prop('checked', true);
            } else {
                $('#statusD').prop('checked', true);
            }
        }
    });
});

function getListAjax(url) {
    var per_page = $('#per-page').val();
    var data = {
        company_position_name: $('#company_position_name').val(),
        company_position_description: $('#company_position_description').val(),
        company_position_status: $('#company_position_status').val(),
        per_page: per_page
    };
    $.ajax({
        type: 'GET',
        url: url,
        data: data,
        dataType: 'json',
        success: function (data) {
            $('#table-company-positions').html(data);
            $('#per-page').val(per_page);
        }
    });
}

function setStoreUpdateAjax(elements) {
    var data = $('#formCompanyPosition').serialize();
    var url = $('#formCompanyPosition').attr('data-url');
    $.ajax({
        type: elements.method,
        url: url,
        data: data,
        dataType: 'json',
        success: function (data) {
            $.toast().reset('all');
            Swal.fire(
                    elements.heading,
                    data.message,
                    'success'
                    );
            limpiarForms();
            $('#modalCompanyPosition').modal('hide');
            var url = $('#route-url').attr('data-url');
            getListUsersAjax(url);
            $('#save').removeClass(elements.removeClassSave);
        },
        error: function (e) {
            if (e.status === 422) {
                errorsValidation(e.responseJSON);
            } else {
                errorToast('CARGO', e.responseJSON.error);
            }
        }
    });
}
$(document).on('click', '.delete', function (e) {
    e.preventDefault();
    var elements = {
        model: 'Producto',
        title: $(this).attr('data-name'),
        url: $(this).attr('data-url'),
        row: $(this).parents('tr')
    };
    deleteAjax(elements);
});

function limpiarForms() {
    $('#name').val('');
    $('#description').val('');
    $('#formRole input[type="checkbox"]:checked').each(function () {
        $(this).prop('checked', false);
    });
    $('#statusH').prop('checked', true);
}