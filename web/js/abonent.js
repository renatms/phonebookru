$(function () {
    $(document).on('click', '.glyphicon-trash', function () {
        if (confirm('Вы действительно хотите удалить запись?')) {
            let tr = this.parentNode.parentNode.parentNode;
            let abonentId = parseInt(tr.getAttribute('data-key'));

            $.ajax({
                url: '/web/abonent/delete',
                method: 'post',
                dataType: 'html',
                data: {id: abonentId},
                success: function (data) {
                    $('.abonent-index').html(data);
                }

            });
            return false;
        } else {
            return false;
        }
    })
})