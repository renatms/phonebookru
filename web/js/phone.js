$(function () {
    $("#mask").mask("+7 (999) 999 99 99");
});
var countOfFields = 1; // Текущее число полей
var curFieldNameId = 0; // Уникальное значение для атрибута name
var maxFieldLimit = 10; // Максимальное число возможных полей
function deleteField(a) {
    if (countOfFields > 1) {
        // Получаем доступ к тэгу, содержащему поле
        var contTr = a.parentNode;
        var contTable = contTr.parentNode; //подымаемся еще на одну ступеньку выше к родителю
        // Удаляем этот тэг Tr из DOM-дерева
        contTable.parentNode.removeChild(contTable);
        // Уменьшаем значение текущего числа полей
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
    tr.innerHTML = "<td><input class=\"form-control mask\" name=\"Phone[" + curFieldNameId + "][number]\" type=\"text\" /></td>" +
        "<td><select class=\"form-control\" size=\"1\" name=\"Phone[" + curFieldNameId + "][group_id]\" >" +
        "<option value=\"1\">Домашний</option>" +
        "<option value=\"2\">Рабочий</option>" +
        "<option value=\"3\">Сотовый</option>" +
        "<option value=\"4\">Главный</option>" +
        "</select></td>" +
        "<td><br /><a class=\"glyphicon glyphicon-trash\" onclick=\"return deleteField(this)\" href=\"#\"></a></td>";

    // Добавляем новый узел в конец списка полей
    document.getElementById("parentId").appendChild(tr);

    $(".mask").mask("+7 (999) 999 99 99");
}