let flagQuantity = false;
let flagPrice = false;
let flagProduct = false;
let listProducts = [];
let listProductsEdit = [];
$.fn.select2.defaults.set("theme", "bootstrap");

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
$('.sel').select2();
$('#sandbox-container .input-daterange').datepicker({
    format: "dd-mm-yyyy",
    language: "es",
    autoclose: true
});
$('input[type=radio][name=sale_date]').on('change', function (e) {
    e.preventDefault();
    if ($(this).attr('id') === 'dateRange') {
        $('#sandbox-container').removeClass('hidden-date');
    } else {
        $('#sandbox-container').addClass('hidden-date');
    }
});
var date = new Date();
var year = date.getFullYear();
var month = date.getMonth();
var day = date.getDate();
$('#sandbox-container-date .input-group.date').datepicker({
    format: "dd-mm-yyyy",
    language: "es",
    autoclose: true,
    minViewMode: 'month',
    startDate: new Date(year, month, '01'),
    endDate: "+0d"
});
$(document).on('click', '.detail-delete', function (e) {
    e.preventDefault();
    var fila = $(this).parent().parent();
    var code = fila.attr('data-code');
    filterProduct(code);
    var total = calculateTotal();
    $('#total').val(total);
    fila.remove();

});

$(document).on('click', '.detail-edit', function (e) {
    e.preventDefault();
    var fila = $(this).parent().parent();
    var code = fila.attr('data-code');
    fila.find('div').addClass('hidden');
    var quantity = fila.find('div.detail-quantity').text();
    var price = fila.find('div.detail-price').text().replace('.', '').replace(',','.');
    fila.find('input.edit-product.detail-quantity').removeClass('hidden').val(quantity);
    fila.find('input.edit-product.detail-price').removeClass('hidden').val(price);
    fila.find('button.detail-edit').addClass('hidden');
    fila.find('button.detail-save').removeClass('hidden');
    $('.sel').val(code);
    $('.sel').trigger('change');
});
$(document).on('click', '.detail-save', function (e) {
    e.preventDefault();
    var oldValue = 0;
    var fila = $(this).parent().parent();
    var quantity = parseInt(fila.find('input.edit-product.detail-quantity').val());
    var price = parseFloat(fila.find('input.edit-product.detail-price').val());
    var code = fila.attr('data-code');
    if (price <= 0 || price.length <= 0 || isNaN(price)) {
        $.toast({
            heading: 'PRECIO',
            text: 'El campo Precio debe ser mayor a 0 y debe ser un número válido.',
            hideAfter: 4000,
            position: 'top-left',
            icon: 'error'
        });
        return;
    }
    if (quantity <= 0 || quantity.length <= 0 || isNaN(quantity)) {
        $.toast({
            heading: 'CANTIDAD',
            text: 'El campo Cantidad debe ser mayor a 0 y debe ser un número válido.',
            hideAfter: 4000,
            position: 'top-left',
            icon: 'error'
        });
        return;
    }
    fila.find('div').removeClass('hidden').val();
    fila.find('input.edit-product').addClass('hidden');
    fila.find('button.detail-edit').removeClass('hidden');
    if (listProductsEdit.length > 0) {
        objectOldValue = listProductsEdit.find(objeto => objeto.product_code === code);
        oldValue = objectOldValue.quantity;
    }

    var stock = parseInt($('#stock').val()) + oldValue;
    fila.find('button.detail-save').addClass('hidden');
    if (quantity <= stock) {
        var importe = price * quantity;
        fila.find('div.detail-import').text(importe.toLocaleString('es-AR', {minimumFractionDigits: 2}));
        $('.sel').val('');
        $('.sel').trigger('change');
    } else {
        $.toast({
            heading: 'PRODUCTO SIN INVENTARIO',
            text: 'El PRODUCTO seleccionado no cuenta con la cantidad de productos requeridos.',
            hideAfter: 4000,
            position: 'top-left',
            icon: 'info'
        });
        quantity = oldValue.quantity;
    }
    fila.find('div.detail-price').text(price.toLocaleString('es-AR', {minimumFractionDigits: 2}));
    fila.find('div.detail-quantity').text(quantity);
    updateProduct(code, quantity, price);
});
$(document).on('click', '#detail-agregar', function (e) {
    e.preventDefault();
    var product = {
        product_code: $('#product').val(),
        quantity: parseInt($('#quantity').val()),
        price_unit: parseFloat($('#price').val())
    };
    const result = uniqueProduct(product);
    if (result === undefined) {
        if (parseInt($('#quantity').val()) <= parseInt($('#stock').val())) {
            var importe = product.price_unit * product.quantity;
            var productTableHtml = {
                product_code: product.product_code,
                description: $('#product option:selected').attr('data-description'),
                unit: $('#product option:selected').attr('data-unit'),
                quantity: product.quantity,
                price: product.price_unit.toLocaleString('es-AR', {minimumFractionDigits: 2}),
                importe: importe.toLocaleString('es-AR', {minimumFractionDigits: 2})
            };
            listProducts.push(product);
            var total = calculateTotal();
            $('#total').val(total);
            getTableDetailProducts(productTableHtml);
            $('#formSale select').each(function () {
                $(this).val(null).trigger('change');
            });
            $('#quantity').val('');
            $('#price').val('');
            $('#quantity').val('');
            $('#stock').val('');
            flagQuantity = false;
            flagPrice = false;
            flagProduct = false;
            disabledEnabledAgregar();
        } else {
            $.toast({
                heading: 'PRODUCTO SIN INVENTARIO',
                text: 'El PRODUCTO seleccionado no cuenta con la cantidad de productos requeridos.',
                hideAfter: 4000,
                position: 'top-left',
                icon: 'info'
            });
        }
    } else {
        $.toast({
            heading: 'PRODUCTO DUPLICADO',
            text: 'El PRODUCTO seleccionado ya se encuentra en el detalle.',
            hideAfter: 5000,
            position: 'top-left',
            icon: 'info'
        });
    }
});
$(document).on('keyup', '#quantity', function () {
    var valor = Number($(this).val());
    if (valor >= 1 && $(this).val().length > 0 && typeof valor === 'number') {
        flagQuantity = true;
    } else {
        flagQuantity = false;
    }
    disabledEnabledAgregar();
});

$(document).on('keyup', '#price', function () {
    var valor = Number($(this).val());
    if (valor >= 0 && $(this).val().length > 0 && typeof valor === 'number') {
        flagPrice = true;
    } else {
        flagPrice = false;
    }
    disabledEnabledAgregar();
});

$(document).on('change', '#product', function () {
    var etiqueta = $('#product option:selected');
    var stock = etiqueta.attr('data-stock');
    flagQuantity = true;
    flagPrice = true;
    $('#stock').val(stock);
    $('#quantity').val(1);
    $('#price').val(etiqueta.attr('data-price'));
    $('#unit').val(etiqueta.attr('data-unit'));
    if (etiqueta.val() !== '') {
        flagProduct = true;
    } else {
        flagProduct = false;
    }
    disabledEnabledAgregar();
});
$(document).on('click', '#store', function (e) {
    e.preventDefault();
    var elements = {
        method: 'POST',
        heading: 'GUARDADO'
    };
    setStoreUpdateAjax(elements);
});

$(document).on('click', '#update', function (e) {
    e.preventDefault();
    var elements = {
        method: 'PUT',
        heading: 'ACTUALIZADO'
    };
    setStoreUpdateAjax(elements);
});

$(document).on('click', '.edit', function (e) {
    e.preventDefault();
    var url = $(this).attr('data-url');
    $('#formSale').attr('data-url', url);
    $.ajax({
        type: 'GET',
        url: url,
        dataType: 'json',
        success: function (data) {
            $('#container').html(data.vista);
            $('.sel').select2();
            $('#sandbox-container-date .input-group.date').datepicker({
                format: "dd-mm-yyyy",
                language: "es",
                autoclose: true,
                minViewMode: 'month',
                startDate: new Date(year, month, '01'),
                endDate: "+0d"
            });
            $('#code').val(data.sale.code);
            $('#date').val(data.sale.date);
            $('#description').text(data.sale.description);
            $('#client').val(data.sale.client);
            $('#total').val(data.sale.total);
            listProducts = [];
            for (const product of data.sale.detail_sales) {
                var importe = product.price_unit * product.quantity;
                var productTableHtml = {
                    product_code: product.product_code,
                    description: product.product.description,
                    unit: product.product.unit,
                    quantity: product.quantity,
                    price: product.price_unit.toLocaleString('es-AR', {minimumFractionDigits: 2}),
                    importe: importe.toLocaleString('es-AR', {minimumFractionDigits: 2})
                };
                listProductsEdit.push({
                    product_code: product.product_code,
                    quantity: product.quantity
                });
                listProducts.push({
                    product_code: product.product_code,
                    quantity: product.quantity,
                    price_unit: product.price_unit
                });
                getTableDetailProducts(productTableHtml);
            }
        },
        error: function (e) {
        }
    });
});
$(document).on('click', '.delete', function (e) {
    e.preventDefault();
    var elements = {
        model: 'Compra',
        title: $(this).attr('data-code'),
        url: $(this).attr('data-url'),
        row: $(this).parents('tr')
    };
    deleteAjax(elements);
});

function disabledEnabledAgregar() {
    if (flagPrice && flagProduct && flagQuantity) {
        $('#detail-agregar').prop('disabled', false);
    } else {
        $('#detail-agregar').prop('disabled', true);
    }
}

function getListAjax(url) {
    var per_page = $('#per-page').val();
    var data = $('#formSearch').serialize() + '&per_page=' + JSON.stringify(parseInt(per_page));
    $.ajax({
        type: 'GET',
        url: url,
        data: data,
        dataType: 'json',
        success: function (data) {
            $('#table-sales').html(data.vista);
            $('#totale').text(`$${data.total.toLocaleString()}`);
            $('#per-page').val(per_page);
        },
        error: function (e) {
        }
    });
}

function setStoreUpdateAjax(elements) {
    var data = {
        date: $('#date').val(),
        client: $('#client').val(),
        description: $('#description').val(),
        _token: $('input[name=_token]').val(),
        products: listProducts
    };
    var code = $('#code').val();
    var url = $('#formSale').attr('data-url').replace(':ID', code);
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
                    ).then((result) => {
                if (result.value || result.dismiss) {
                    if (elements.method === 'POST') {
                        $('#container').html(data.vista);
                    } else {
                        window.location.href = $('#back').attr('href');
                    }
                }
            });
        },
        error: function (e) {
            console.log(e);
            if (e.status === 422) {
                errorsValidation(e.responseJSON);
            } else {
                if (e.status === 400) {
                    errorToast('VENTA', e.responseJSON.error);
                } else {
                    errorToast('VENTA');
                }
            }
        }
    });
}

function uniqueProduct(objProduct) {
    return listProducts.find(objeto => objeto.product_code === objProduct.product_code);
}

function filterProduct(code) {
    const newList = listProducts.filter(objeto => objeto.product_code != code);
    listProducts = [];
    listProducts = [...newList];
}

function updateProduct(code, quantity, price) {
    listProducts.forEach(function (objeto) {
        if (objeto.product_code === code) {
            objeto.quantity = quantity;
            objeto.price_unit = price;
        }
    });
}

function calculateTotal() {
    var total = 0;
    listProducts.forEach(function (objeto) {
        total += objeto.price_unit * objeto.quantity;
    });
    return total.toFixed(2);
}

function limpiarForms() {
    $('#sandbox-container-date .input-group.date').datepicker({
        format: "dd-mm-yyyy",
        language: "es",
        autoclose: true,
        firstDay: 1,
        minViewMode: 'month',
        startDate: new Date(year, month, '01'),
        endDate: "+0d"
    }).datepicker('setDate', new Date(year, month, day));
    $('#description').val('');
    $('#client').val('');
    listProducts = [];
    $('#body-detail tr').remove();
}

function getTableDetailProducts(productTable) {
    $('#body-detail').append(
            $('<tr>').attr('data-code', productTable.product_code)
            .append(
                    $('<td>').append(
                    productTable.product_code
                    )
                    ).append(
            $('<td>').append(
            productTable.description
            )
            ).append(
            $('<td>').append(
            productTable.unit
            )
            ).append(
            $('<td>').attr('align', 'right')
            .append(
                    `<input class="form-control edit-product hidden detail-quantity" min="1" type="number">`
                    )
            .append(
                    `<div class="detail-quantity">${productTable.quantity}</div>`
                    )
            ).append(
            $('<td>').attr('align', 'right')
            .append(
                    `<input class="form-control edit-product hidden detail-price" min="0" step=",01" type="number">`
                    )
            .append(
                    `<div class="detail-price">${productTable.price}</div>`
                    )
            ).append(
            $('<td>').append(
            `<div class="detail-import">${productTable.importe}</div>`
            ).attr('align', 'right')
            ).append(
            $('<td>')
            .append(
                    $('<button>').append(
                    '<i class="fa fa-fw fa-edit"></i>'
                    ).attr('type', 'button').addClass('btn btn-info btn-sm btn-action detail-edit')
                    )
            .append(
                    $('<button>').append(
                    '<i class="fa fa-fw fa-save"></i>'
                    ).attr('type', 'button').addClass('btn btn-success btn-sm btn-action hidden detail-save')
                    )
            .append(
                    $('<button>').append(
                    '<i class="fa fa-fw fa-trash"></i>'
                    ).attr('type', 'button').addClass('btn btn-danger btn-sm btn-action detail-delete')
                    )
            )
            );
}