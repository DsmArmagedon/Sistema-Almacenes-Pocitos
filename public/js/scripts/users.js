$.fn.select2.defaults.set("theme", "bootstrap");
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
$('.sel').select2({
    dropdownParent: $('#modalUser')
});
/**
 * Cierra el modal limpiando el formulario y de existir algun toast activo lo cierra.
 */
$(document).on('click', '.close-modal', function(e) {
    e.preventDefault();
    limpiarForms();
    $.toast().reset('all');
    $('#save').removeClass('store update');
});
/**
 * Abre el modal para agregar nuevos usuarios, tambien adiciona el titulo y la class store al boton con id=save del formulario
 * evita que se cierre el modal con un clic fuera del modal
 */
$(document).on('click', '#agregar', function(e) {
    e.preventDefault();
    var route = $(this).attr('data-url');
    $('#formUser').attr('data-url', route);
    $('#title').text('Crear Usuario');
    $('#save').addClass('store');
    $('#modalUser').modal({
        backdrop: 'static',
        keyboard: false,
        show: true
    });
});
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
            $('#userUsername').text(data.username);
            $('#userFirstLastName').text(`${data.first_name} ${data.last_name}`);
            $('#userRole').text(data.role.name);
            $('#userCompanyPosition').text(data.company_position.name);
            $('#userAddress').text(data.address);
            $('#userPhone').text(data.phone);
            $('#userEmail').text(data.email);
            if (data.status == 1) {
                $('#userStatus').text('Habilitado').addClass('label label-success');
            } else {
                $('#userStatus').text('Deshabilitado').addClass('label label-danger');
            }
        }
    });
});
$(document).on('click', '.edit', function(e) {
    e.preventDefault();
    $('#title').text('Editar Usuario');
    $('#save').addClass('update');
    var url = $(this).attr('data-url');
    var route = $(this).attr('data-route');
    $('#formUser').attr('data-url', route);
    $.ajax({
        type: 'GET',
        url: url,
        dataType: 'json',
        success: function(data) {
            $('#modalUser').modal({
                backdrop: 'static',
                keyboard: false,
                show: true
            });
            $('#id').val(data.id);
            $('#username').val(data.username);
            $('#first_name').val(data.first_name);
            $('#last_name').val(data.last_name);
            $('#role_id').val(data.role_id).trigger('change');
            $('#company_position_id').val(data.company_position_id).trigger('change');
            $('#address').val(data.address);
            $('#phone').val(data.phone);
            $('#email').val(data.email);

            if (data.status == 1) {
                $('#statusH').prop('checked', true);
            } else {
                $('#statusD').prop('checked', true);
            }
        }
    });
});
$(document).on('click', '.delete', function(e) {
    e.preventDefault();
    var elements = {
        model: 'Producto',
        title: `${$(this).attr('data-firstName')} ${$(this).attr('data-lastName')}`,
        url: $(this).attr('data-url'),
        row: $(this).parents('tr')
    };
    deleteAjax(elements);
});
$(document).on('click', '.store', function(e) {
    e.preventDefault();

    var elements = {
        method: 'post',
        heading: 'GUARDADO',
        removeClassSave: 'store',
    };
    setStoreUpdateAjax(elements);
});
$(document).on('click', '.update', function(e) {
    e.preventDefault();

    var elements = {
        method: 'put',
        heading: 'ACTUALIZADO',
        removeClassSave: 'update',
    };
    setStoreUpdateAjax(elements);
});
$(function() {
    $('[data-toggle="tooltip"]').tooltip();
});

$(document).on('click', '#btn-limpiar', function(e) {
    e.preventDefault();
    $('#user_first_name').val('');
    $('#user_last_name').val('');
    $('#user_email').val('');
    $('#user_role_id').val('');
    $('#user_status').val('');
});

$(document).on('click','#changePassword',function(e) {
   e.preventDefault();
   var data = $('#formChangePassword').serialize();
   var url = $('#formChangePassword').attr('data-url');
   $.ajax({
        type: 'POST',
        url: url,
        data: data,
        dataType: 'json',
        success: function(data) {
            Swal.fire(
                'CAMBIO DE CONTRASEÑA',
                data,
                'success'
            );
            $('#oldPassword').val('');
            $('#password').val('');
            $('#password_confirmation').val('');
            
        },
        error: function(e) {
            switch(e.status) {
                case 422:
                    errorsValidation(e.responseJSON);
                break;
                case 401:
                    Swal.fire(
                        e.responseJSON.error,
                        'Los datos introducidos no son válidos',
                        'error'
                    );
                break;
                case 400:
                    errorToast('CAMBIO DE CONTRASEÑA', e.responseJSON.error);
                break;
                default:
                    errorToast('CAMBIO DE CONTRASEÑA');
            }
        }
    });
});
function getListAjax(url) {
    var per_page = $('#per-page').val();
    var data = {
        user_email: $('#user_email').val(),
        user_first_name: $('#user_first_name').val(),
        user_last_name: $('#user_last_name').val(),
        role_name: $('#role_name').val(),
        user_status: $('#user_status').val(),
        per_page: per_page
    };
    $.ajax({
        type: 'GET',
        url: url,
        data: data,
        dataType: 'json',
        success: function(data) {
            $('#table-users').html(data);
            $('#per-page').val(per_page);
        }
    });
}

function setStoreUpdateAjax(elements) {
    var data = $('#formUser').serialize();
    var url = $('#formUser').attr('data-url');
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
            $('#modalUser').modal('hide');
        },
        error: function(e) {
            if (e.status === 422) {
                errorsValidation(e.responseJSON);
            } else {
                errorToast('USUARIO', e.responseJSON.error);
            }
        }
    });
}

function limpiarForms() {
    $('#formUser input[type="text"]').each(function() {
        $(this).val('');
    });
    $('#formUser select').each(function() {
        $(this).val(null).trigger('change');
    });
    $('#statusH').prop('checked', true);
}