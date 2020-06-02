$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$(document).on('click', '#store', function(e) {
    e.preventDefault();
    var elements = {
        method: 'POST',
        heading: 'GUARDADO'
    };
    setStoreUpdateAjax(elements);
});

$(document).on('click', '#update', function(e) {
    e.preventDefault();
    var elements = {
        method: 'PUT',
        heading: 'ACTUALIZADO'
    };
    setStoreUpdateAjax(elements);
});

$(document).on('click', '#btn-limpiar', function(e) {
    e.preventDefault();
    $('#role_name').val('');
    $('#role_status').val('');
});

function getListAjax(url) {
    var per_page = $('#per-page').val();
    var data = {
        role_name: $('#role_name').val(),
        role_status: $('#role_status').val(),
        per_page: per_page
    };
    $.ajax({
        type: 'GET',
        url: url,
        data: data,
        dataType: 'json',
        success: function(data) {
            $('#table-roles').html(data);
            $('#per-page').val(per_page);
        }
    });
}
$(document).on('click', '.detail', function(e) {
    var url = $(this).attr('data-url');
    $.ajax({
        type: 'GET',
        url: url,
        dataType: 'json',
        success: function(data) {
            $('#modalUserShow').modal({
                backdrop: 'static',
                keyboard: false,
                show: true
            });
            $('#roleName').text(data.name);
            $('#roleDescription').text(data.description);
            if (data.status == 1) {
                $('#roleStatus').text('Habilitado').addClass('label label-success');
            } else {
                $('#roleStatus').text('Deshabilitado').addClass('label label-danger');
            }
            var permissions = '';
            for (const objeto of data.permissions) {
                permissions += `<li class="label label-default">${objeto.name}</li>  `;
            }
            $('#rolePermissions').html(`<ul class="list-inline">${permissions}</ul>`);
        }
    });
});
$(document).on('click', '.delete', function(e) {
    e.preventDefault();
    var elements = {
        model: 'Producto',
        title: $(this).attr('data-name'),
        url: $(this).attr('data-url'),
        row: $(this).parents('tr')
    };
    deleteAjax(elements);
});

function setStoreUpdateAjax(elements) {
    var data = $('#formRole').serialize();
    var url = $('#formRole').attr('data-url');
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
            ).then((result) => {
                if (result.value || result.dismiss) {
                    if (elements.method === 'POST') {
                        limpiarForms();
                    } else {
                        window.location.href = $('#back').attr('href');
                    }
                }
            });
        },
        error: function(e) {
            if (e.status === 422) {
                errorsValidation(e.responseJSON);
            } else {
                errorToast('ROL', e.responseJSON.error);
            }
        }
    });
}

function limpiarForms() {
    $('#name').val('');
    $('#description').val('');
    $('#formRole input[type="checkbox"]:checked').each(function() {
        $(this).prop('checked', false);
    });
    $('#statusH').prop('checked', true);
}