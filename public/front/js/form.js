$('.toggleable').click(function () {
    $('.' + $(this).data('btnclass')).removeClass('active')
    $('.' + $(this).data('togclass')).slideUp();
    $('#' + $(this).data('toggle')).slideDown();
    $(this).addClass('active')

    if ($(this).data('inputid')) {
        $('#' + $(this).data('inputid')).val($(this).data('value'))
    }

})
