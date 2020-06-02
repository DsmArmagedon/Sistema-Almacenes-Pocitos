let flagQuantity = false;
let flagPrice = false;
let flagProduct = false;
let listProduts = [];
let totalimport;
let ivaP;
let percepivaP;
let percepiibbsaltaP;
let municipalP;
let iva;
let percepiva;
let percepiibbsalta;
let municipal;
$.fn.select2.defaults.set("theme", "bootstrap");
$(document).ready(function () {
    importTotal = 0;
    iva = 0;
    percepiva = 0;
    percepiibbsalta = 0;
    municipal = 0;
    ivaP = $('input[type=radio][name=taxe_iva]:checked').val();
    percepivaP = $('input[type=radio][name=taxe_percep_iva]:checked').val();
    percepiibbsaltaP = $('input[type=radio][name=taxe_percep_iibb_salta]:checked').val();
    municipalP = $('input[type=radio][name=taxe_municipal]:checked').val();
});
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
$('input[type=radio][name=purchase_date]').on('change', function (e) {
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
    importTotal = calculateTotalImport();
    $('#totalimport').text(importTotal.toLocaleString('es-AR', {minimumFractionDigits: 2, maximumFractionDigits: 2}));
    calculateTaxesAndTotal();
    fila.remove();
});
$(document).on('click', '#detail-agregar', function (e) {
    e.preventDefault();
    var product = {
        product_code: $('#product').val(),
        quantity: parseInt($('#quantity').val()),
        import: parseFloat($('#import').val())
    };
    const result = uniqueProduct(product);
    if (result === undefined) {
        var price = product.import / product.quantity;
        var productTableHtml = {
            product_code: product.product_code,
            description: $('#product option:selected').attr('data-description'),
            unit: $('#product option:selected').attr('data-unit'),
            quantity: product.quantity,
            price: price.toLocaleString('es-AR', {minimumFractionDigits: 2, maximumFractionDigits: 2}),
            import: product.import.toLocaleString('es-AR', {minimumFractionDigits: 2, maximumFractionDigits: 2})
        };
        listProduts.push(product);
        importTotal = calculateTotalImport();
        $('#totalimport').text(importTotal.toLocaleString('es-AR', {minimumFractionDigits: 2, maximumFractionDigits: 2}));
        calculateTaxesAndTotal();
        getTableDetailProducts(productTableHtml);
        $('#formPurchase select').each(function () {
            $(this).val(null).trigger('change');
        });
        $('#quantity').val('');
        $('#import').val('');
        $('#quantity').val('');
        $('#stock').val('');
        flagQuantity = false;
        flagPrice = false;
        flagProduct = false;
        disabledEnabledAgregar();
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

$(document).on('keyup', '#import', function () {
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
    $('#stock').val(stock);
    flagQuantity = true;
    $('#quantity').val(1);

    $('#unit').val(etiqueta.attr('data-unit'));
    if (etiqueta.val() !== '') {
        flagProduct = true;
    } else {
        flagProduct = true;
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
    $.ajax({
        type: 'GET',
        url: url,
        dataType: 'json',
        success: function (data) {
            $('#container').html(data.vista);
            /**
             * plugins
             */
            $('.sel').select2();
            $('#sandbox-container-date .input-group.date').datepicker({
                format: "dd-mm-yyyy",
                language: "es",
                autoclose: true,
                minViewMode: 'month',
                startDate: new Date(year, month, '01'),
                endDate: "+0d"
            });
            /**
             * Datos Venta
             */
            $('#code').val(data.purchase.code);
            $('#date').val(data.purchase.date);
            $('#description').text(data.purchase.description);
            $('#supplier').val(data.purchase.supplier);
            $('#invoice').val(data.purchase.invoice);
            listProduts = [];
            /**
             * Datos Detalle de Venta
             */
            for (const product of data.purchase.detail_purchases) {
                var price = product.import / product.quantity;
                var productTableHtml = {
                    product_code: product.product_code,
                    description: product.product.description,
                    unit: product.product.unit,
                    quantity: product.quantity,
                    price: price.toLocaleString('es-AR', {minimumFractionDigits: 2, maximumFractionDigits: 2}),
                    import: product.import.toLocaleString('es-AR', {minimumFractionDigits: 2, maximumFractionDigits: 2})
                };
                listProduts.push({
                    product_code: product.product_code,
                    quantity: product.quantity,
                    import: product.import
                });
                getTableDetailProducts(productTableHtml);
            }
            $(`input[type=radio][name=taxe_iva][value='${data.purchase.taxe_iva}']`).prop('checked', true);
            $(`input[type=radio][name=taxe_percep_iva][value='${data.purchase.taxe_percep_iva}']`).prop('checked', true);
            $(`input[type=radio][name=taxe_percep_iibb_salta][value='${data.purchase.taxe_iibb_salta}']`).prop('checked', true);
            $(`input[type=radio][name=taxe_municipal][value='${data.purchase.taxe_municipal}']`).prop('checked', true);
            importTotal = calculateTotalImport();
            $('#totalimport').text(importTotal.toLocaleString('es-AR', {minimumFractionDigits: 2, maximumFractionDigits: 2}));
            ivaP = data.purchase.taxe_iva;
            percepivaP = data.purchase.taxe_percep_iva;
            percepiibbsaltaP = data.purchase.taxe_iibb_salta;
            municipalP = data.purchase.taxe_municipal;
            calculateTaxesAndTotal();
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
$(document).on('change','input[type=radio][name=taxe_iva]', function (e) {
    e.preventDefault();
    ivaP = $(this).val();
    calculateIva();
    calculateTotal();
});
$(document).on('change','input[type=radio][name=taxe_percep_iva]', function (e) {
    e.preventDefault();
    percepivaP = $(this).val();
    calculatePercepIva();
    calculateTotal();
});
$(document).on('change','input[type=radio][name=taxe_percep_iibb_salta]', function (e) {
    e.preventDefault();
    percepiibbsaltaP = $(this).val();
    calculatePercepIibbSalta();
    calculateTotal();
});
$(document).on('change','input[type=radio][name=taxe_municipal]', function (e) {
    e.preventDefault();
    municipalP = $(this).val();
    calculateMunicipal();
    calculateTotal();
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
            $('#table-purchases').html(data.vista);
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
        supplier: $('#supplier').val(),
        description: $('#description').val(),
        taxe_iva: parseFloat(ivaP),
        taxe_percep_iva: percepivaP,
        taxe_iibb_salta: percepiibbsaltaP,
        taxe_municipal: municipalP,
        _token: $('input[name=_token]').val(),
        products: listProduts
    };
    var code = $('#code').val();
    var url = $('#formPurchase').attr('data-url').replace(':ID', code);
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
                        $('#code').val(data.code);
                        limpiarForms();
                    } else {
                        window.location.href = $('#back').attr('href');
                    }
                }
            });
        },
        error: function (e) {
            if (e.status === 422) {
                errorsValidation(e.responseJSON);
            } else {
                if (e.status === 400) {
                    errorToast('COMPRA', e.responseJSON.error);
                } else {
                    errorToast('COMPRA');
                }
            }
        }
    });
}

function uniqueProduct(objProduct) {
    return listProduts.find(objeto => objeto.product_code === objProduct.product_code);
}

function filterProduct(code) {
    const newList = listProduts.filter(objeto => objeto.product_code != code);
    listProduts = [];
    listProduts = [...newList];
}

function calculateTotalImport() {
    var total = 0;
    listProduts.forEach(function (objeto) {
        total += objeto.import;
    });
    return total;
}
function calculateTaxesAndTotal() {
    calculateIva();
    calculatePercepIva();
    calculatePercepIibbSalta();
    calculateMunicipal();
    calculateTotal();
}
function calculateTotal() {
    var total = 0;
    total = importTotal + iva + percepiva + percepiibbsalta + municipal;
    $('#total').val(total.toLocaleString('es-AR', {minimumFractionDigits: 2, maximumFractionDigits: 2}));
    $('#detailtotal').text(total.toLocaleString('es-AR', {minimumFractionDigits: 2, maximumFractionDigits: 2}));
}
function calculateIva() {
    iva = ivaP * importTotal / 100;
    $('#taxeiva').text(iva.toLocaleString('es-AR', {minimumFractionDigits: 2, maximumFractionDigits: 2}));
}
function calculatePercepIva() {
    percepiva = percepivaP * importTotal / 100;
    $('#taxepercepiva').text(percepiva.toLocaleString('es-AR', {minimumFractionDigits: 2, maximumFractionDigits: 2}));
}
function calculatePercepIibbSalta() {
    percepiibbsalta = percepiibbsaltaP * importTotal / 100;
    $('#taxepercepiibbsalta').text(percepiibbsalta.toLocaleString('es-AR', {minimumFractionDigits: 2, maximumFractionDigits: 2}));
}
function calculateMunicipal() {
    municipal = municipalP * importTotal / 100;
    $('#taxemunicipal').text(municipal.toLocaleString('es-AR', {minimumFractionDigits: 2, maximumFractionDigits: 2}));
}

function limpiarForms() {
    $('#sandbox-container-date .input-group.date').datepicker({
        format: "dd-mm-yyyy",
        language: "es",
        autoclose: true,
        minViewMode: 'month',
        startDate: new Date(year, month, '01'),
        endDate: "+0d"
    }).datepicker('setDate', new Date(year, month, day));
    $('#description').val('');
    $('#supplier').val('');
    $('#total').val('');
    $('#invoice').val('');
    listProduts = [];
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
            $('<td>').append(
            productTable.quantity
            ).attr('align', 'right')
            ).append(
            $('<td>').append(
            productTable.price
            ).attr('align', 'right')
            ).append(
            $('<td>').append(
            productTable.import
            ).attr('align', 'right')
            ).append(
            $('<td>')
            .append(
                    $('<button>').append(
                    '<i class="fa fa-fw fa-trash"></i>'
                    ).attr('type', 'button').addClass('btn btn-danger btn-sm btn-action detail-delete')
                    )
            )
            );
}