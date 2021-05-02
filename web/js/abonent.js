$(function () {
    $(document).on('click', '.glyphicon-trash', function () {
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
    })
})