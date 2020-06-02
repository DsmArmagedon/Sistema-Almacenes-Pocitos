$(document).on('blur', '#username', function(e) {
    e.preventDefault();
    var value = $(this).val();
    if (value !== '') {
        $(this).parents('div.has-feedback').removeClass('has-error');
        $('#hpUsername').text('');
    }
});

$(document).on('blur', '#password', function(e) {
    e.preventDefault();
    var value = $(this).val();
    if (value !== '') {
        $(this).parents('div.has-feedback').removeClass('has-error');
        $('#hpPassword').text('');
    }
});