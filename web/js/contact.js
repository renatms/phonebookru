$(function () {
    $(document).on('click', '.glyphicon-trash', function () {
        if (confirm('Вы действительно хотите удалить запись?')) {
            let tr = this.parentNode.parentNode.parentNode;
            let contactId = parseInt(tr.getAttribute('data-key'));

            console.log(contactId);

            $.ajax({
                url: '/web/contact/delete',
                method: 'post',
                dataType: 'html',
                data: {id: contactId},
                success: function (data) {
                    $('.contact-index').html(data);
                }

            });
            return false;
        } else {
            return false;
        }
    })
})