$(document).ready(function() {
    if($('#dateYearMonth').prop('checked')) {
        $('#saleMonth').select2({
            containerCss: {
             visibility: 'none'
            }
        });
    } else {
        $('#saleMonth').select2({
            containerCss: {
             visibility: 'hidden'
            }
        });
    }
});
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$.fn.select2.defaults.set("theme", "bootstrap");

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
    if ($(this).attr('id') === 'dateYearMonth') {
        $('#saleMonth').select2({
            containerCss: {
             visibility: 'none'
            }
        });
    } else {
        $('#saleMonth').select2({
            containerCss: {
             visibility: 'hidden'
            }
        });
    }
});