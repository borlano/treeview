// Lazy loading
$('.card-body').on('click', '.worker', function() {
    $.ajax({
        url: '/brunch',
        cache: false,
        data: {
            '_token': $('meta[name=csrf-token]').attr('content'),
            'id': $(this).attr('id')
        },
        type: "POST",
        dataType: "json",
        success: function (data) {
            $('#'+data.id).append(data.html);
            $('#'+data.id).removeClass('worker');
        }
    });
});