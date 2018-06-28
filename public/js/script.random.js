$('#button__random').on('click', function() {
    // alert()
    $.ajax({
        url: '/wks/random',
        cache: false,
        data: {
            '_token': $('meta[name=csrf-token]').attr('content')
        },
        type: "POST",
        dataType: "json",
        success: function (data) {
            $('#field__random').val(data);
        }
    });
});
