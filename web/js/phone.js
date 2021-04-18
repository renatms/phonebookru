var countOfFields = $('#parentId').children('tr').length; // Текущее число полей
var curFieldNameId = $('#parentId').children('tr').length; // Уникальное значение для атрибута name
var maxFieldLimit = 10; // Максимальное число возможных полей

$(function () {
    $("#mask").mask("+7 (999) 999 99 99");

    $('body').on('click', '.glyphicon-trash', function () {
        let tr = this.parentNode.parentNode.parentNode;
        deleteField(tr);
        let phoneId = this.getAttribute('data-phone-id');
        if (phoneId !== null) {
            $.ajax({
                url: '/web/phone/delete',
                method: 'get',
                dataType: 'json',
                data: {id: phoneId},
                success: function (data) {
                    alert(data);
                }
            });
            return false;
        }

        console.log(phoneId);
        return false;
    });
});

function deleteField(tr) {
    if (countOfFields > 1) {
        tr.parentNode.removeChild(tr);
        countOfFields--;
    }
    // Возвращаем false, чтобы не было перехода по сслыке
    return false;
}

function addField() {

    // Проверяем, не достигло ли число полей максимума
    if (countOfFields >= maxFieldLimit) {
        alert("Число полей достигло своего максимума = " + maxFieldLimit);
        return false;
    }
    // Увеличиваем текущее значение числа полей
    countOfFields++;
    // Увеличиваем ID
    curFieldNameId++;
    // Создаем строку таблицы
    var tr = document.createElement("tr");
    // Добавляем HTML-контент с пом. свойства innerHTML
    tr.innerHTML = "<td><input class=\"form-control mask\" name=\"NewPhone[" + curFieldNameId + "][number]\" type=\"text\" /></td>" +
        "<td><select class=\"form-control\" size=\"1\" name=\"NewPhone[" + curFieldNameId + "][group_id]\" >" +
        "<option value=\"1\">Домашний</option>" +
        "<option value=\"2\">Рабочий</option>" +
        "<option value=\"3\">Сотовый</option>" +
        "<option value=\"4\">Главный</option>" +
        "</select></td>" +
        "<td><a><span class=\"glyphicon glyphicon-trash\" onclick=\"return deleteField(this.parentNode.parentNode.parentNode)\" href=\"#\"></span></a></td><br/>\n" +
        "    <br/>";

    // Добавляем новый узел в конец списка полей
    document.getElementById("parentId").appendChild(tr);

    $(".mask").mask("+7 (999) 999 99 99");
}