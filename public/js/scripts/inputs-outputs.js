$('.collapse').collapse({
    toggle: false
});
$.fn.select2.defaults.set("theme", "bootstrap");
var date = new Date();
var year = date.getFullYear();
var month = date.getMonth();
var day = date.getDate();
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
$('.sel').select2({
    dropdownParent: $('#modalInputOutput')
});

$('#sandbox-container .input-daterange').datepicker({
    format: "dd-mm-yyyy",
    language: "es",
    autoclose: true
});

$('input[type=radio][name=input_output_date]').on('change', function (e) {
    e.preventDefault();
    if ($(this).attr('id') === 'dateRange') {
        $('#sandbox-container').removeClass('hidden-date');
    } else {
        $('#sandbox-container').addClass('hidden-date');
    }
});

$('#sandbox-container-date .input-group.date').datepicker({
    format: "dd-mm-yyyy",
    language: "es",
    autoclose: true,
    minViewMode: 'month',
    startDate: new Date(year, month, '01'),
    endDate: "+0d"
});
$(document).on('change', '#productCode', function () {
    var etiqueta = $('#productCode option:selected');
    var stock = etiqueta.attr('data-stock');
    $('#stock').val(stock);
    $('#unit').val(etiqueta.attr('data-unit'));
});
$(document).on('click', '#agregar', function (e) {
    e.preventDefault();
    var route = $(this).attr('data-url');
    var url = $(this).attr('data-create');
    $('#formInputOutput').attr('data-url', route);
    $('#title').text('Crear Entrada o Salida');
    $('#save').addClass('store');

    $.ajax({
        type: 'GET',
        url: url,
        dataType: 'json',
        success: function (data) {
            $('#modalInputOutput').modal({
                backdrop: 'static',
                keyboard: false,
                show: true
            });
            $('#code').val(data);
        }
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
        method: 'PUT',
        heading: 'ACTUALIZADO'
    };
    console.log('entra update');
    setStoreUpdateAjax(elements);
});
$(document).on('click', '.close-modal', function (e) {
    e.preventDefault();
    limpiarForms();
    $.toast().reset('all');
    $('#save').removeClass('store update');
});
$(document).on('click', '.edit', function (e) {
    e.preventDefault();
    $('#title').text('Editar Entrada o Salida');
    $('#save').addClass('update');
    var url = $(this).attr('data-url');
    $('#formInputOutput').attr('data-url', url);
    $.ajax({
        type: 'GET',
        url: url,
        dataType: 'json',
        success: function (data) {
            $('#modalInputOutput').modal({
                backdrop: 'static',
                keyboard: false,
                show: true
            });
            $('#code').val(data.code);
            $('#operation').val(data.operation);
            $('#type').val(data.type).trigger('change');
            $('.sel').select2({
                disabled: true
            }).trigger('change');
            $('#sandbox-container-date .input-group.date').datepicker({
                format: "dd-mm-yyyy",
                language: "es",
                autoclose: true,
                minViewMode: 'month',
                startDate: new Date(year, month, '01'),
                endDate: "+0d"
            });
            $('#date').val(data.date);
            $('#productCode').val(data.product_code).trigger('change');
            $('#quantity').val(data.quantity);
        },
        error: function (e) {
            console.log(e);
        }
    });
});
$(document).on('click', '.delete', function (e) {
    var type = ($(this).attr('data-type') === 'input') ? 'Entrada' : 'Salida';
    var code = $(this).attr('data-code');
    var url = $(this).attr('data-url');
    var row = $(this).parents('tr');
    e.preventDefault();
    Swal.fire({
        title: `Eliminar Entrada o Salida`,
        html: `¿Está seguro que desea eliminar la ${type}:</br><b> ${code}</b>?`,
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
                url: url,
                dataType: 'json',
                success: function (data) {
                    row.fadeOut();
                    Swal.fire(
                            'ELIMINADO',
                            data.message,
                            'success'
                            );
                    $(`#P${data.product.code}`).attr('data-stock', data.product.stock);
                },
                error: function (e) {
                    if (e.status === 422) {
                        $.toast({
                            heading: 'ERRORES DE VALIDACION',
                            text: e.responseJSON.errors,
                            hideAfter: false,
                            position: 'top-left',
                            stack: false,
                            icon: 'info'
                        });
                    } else {
                        if (e.status === 400) {
                            errorToast('ENTRADA O SALIDA', e.responseJSON.error);
                        } else {
                            errorToast('ENTRADA O SALIDA');
                        }
                    }
                }
            });
        }
    });
});
function getListAjax(url) {
    var per_page = $('#per-page').val();
    var data = $('#formSearch').serialize() + '&per_page=' + JSON.stringify(parseInt(per_page));
    $.ajax({
        type: 'GET',
        url: url,
        data: data,
        dataType: 'json',
        success: function (data) {
            $('#table-inputs-outputs').html(data);
            $('#per-page').val(per_page);
        },
        error: function (e) {
        }
    });
}

function setStoreUpdateAjax(elements) {
    var data = {
        date: $('#date').val(),
        type: $('#type').val(),
        operation: $('#operation').val(),
        product_code: $('#productCode').val(),
        quantity: $('#quantity').val()
    };
    var url = $('#formInputOutput').attr('data-url');
    $.ajax({
        type: elements.method,
        url: url,
        data: data,
        dataType: 'json',
        success: function (data) {
            console.log(data);
            $.toast().reset('all');
            Swal.fire(
                    elements.heading,
                    data.message,
                    'success'
                    );
            limpiarForms();
            var url = $('#route-url').attr('data-url');
            $(`#P${data.product.code}`).attr('data-stock', data.product.stock);
            getListAjax(url);
            $('#save').removeClass(elements.removeClassSave);
            $('#modalInputOutput').modal('hide');
        },
        error: function (e) {
            console.log(e);
            if (e.status === 422) {
                errorsValidation(e.responseJSON);
            } else {
                if (e.status === 400) {
                    errorToast('ENTRADA O SALIDA', e.responseJSON.error);
                } else {
                    errorToast('ENTRADA O SALIDA');
                }
            }
        }
    });
}
function limpiarForms() {
    $('#formInputOutput input[type="text"]').each(function () {
        $(this).val('');
    });
    $('#sandbox-container-date .input-group.date').datepicker({
        format: "dd-mm-yyyy",
        language: "es",
        autoclose: true,
        minViewMode: 'month',
        startDate: new Date(year, month, '01'),
        endDate: "0d"
    }).datepicker('setDate', new Date(year, month, day));
    $('#quantity').val('');
    $('#type').val(null).trigger('change');
    $('.sel').select2({
        disabled: false
    });
    $('#productCode').val(null).trigger('change');
}