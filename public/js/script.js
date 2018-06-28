// get worker info in the modal window
$('#workers_list').on('click', '.worker_name', function() {
    $.ajax({
        url: '/admin/show',
        cache: false,
        data: {
            '_token': $('meta[name=csrf-token]').attr('content'),
            'id': $(this).closest('tr').attr('id')
        },
        type: "POST",
        dataType: "json",
        success: function (data) {
            $('#modal__wrapper').html(data.html);
        },
        complete: function () {
            $('#Modal').modal('show');
        }
    });
});

// get bosses list for chosen post
$('form[name=worker-crud] select[name=post_id]').on('change', function () {
    $.ajax({
        url: '/admin/get_bosses',
        cache: false,
        data: {
            '_token': $('meta[name=csrf-token]').attr('content'),
            'post_id': $(this).val()
        },
        type: "POST",
        dataType: "json",
        success: function (data) {
            $('#boss').html(data.html);
        }
    });
});

//Startup settings for dataTable plugin
$.extend( $.fn.dataTable.defaults, {
    language: {
        "processing": "Подождите...",
        "search": "Поиск:",
        "lengthMenu": "Показать _MENU_ записей",
        "info": "Записи с _START_ до _END_ из _TOTAL_ записей",
        "infoEmpty": "Записи с 0 до 0 из 0 записей",
        "infoFiltered": "(отфильтровано из _MAX_ записей)",
        "infoPostFix": "",
        "loadingRecords": "Загрузка записей...",
        "zeroRecords": "Записи отсутствуют.",
        "emptyTable": "В таблице отсутствуют данные",
        "paginate": {
            "first": "Первая",
            "previous": "Предыдущая",
            "next": "Следующая",
            "last": "Последняя"
        },
        "aria": {
            "sortAscending": ": активировать для сортировки столбца по возрастанию",
            "sortDescending": ": активировать для сортировки столбца по убыванию"
        }
    }
});