<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\date\DatePicker;

/* @var $this yii\web\View */
/* @var $model app\models\Abonent */
/* @var $phone app\models\Phone[] */
/* @var $phone app\models\Phone */
/* @var $group app\models\Group[] */
/* @var $form yii\widgets\ActiveForm */
/* @var $update */

?>

<div class="abonent-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'first_name') ?>

    <?= $form->field($model, 'second_name') ?>

    <?= $form->field($model, 'middle_name') ?>

    <?= $form->field($model, 'FormattedBirthday')->widget(DatePicker::classname(), [
        'options' => ['placeholder' => 'Дата рождения'],
        'pluginOptions' => [
            'format' => 'dd.mm.yyyy',
            'autoclose' => true
        ]
    ]) ?>
    <table>
        <?php if ($update): ?>
            <?php foreach ($phone as $index => $ph): ?>
                <tr>
                    <td>
                        <?= $form->field($ph, "[$index]number")->
                        widget(\yii\widgets\MaskedInput::className(), [
                            'mask' => '+7 (999) 999 99 99',
                        ]) ?>
                    </td>
                    <td>
                        <?php echo $form->field($ph, "[$index]group_id")->dropDownList(ArrayHelper::map($group, 'id', 'type')) ?>
                    </td>
                    <td>
                        <?= Html::a('<span class="glyphicon glyphicon-trash"></span>',
                            ['phone/delete', 'id' => $ph->id],
                            [
                                'title' => 'Удалить',
                                'data-confirm' => "Хотите удалить?",
                                'data-pjax' => '1'
                            ]); ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php endif; ?>

        <table id="parentId">
            <tr>
                <td>
                    <label class="control-label" for="mask">Номер телефона</label>
                    <input class="form-control" id="mask" name="number[0]" type="text"/>
                </td>
                <td>
                    <label class="control-label" for="typephone">Тип номера</label>
                    <select class="form-control" id="typephone" size="1" name="type[0]">
                        "
                        <option value="1">Домашний</option>
                        " +
                        "
                        <option value="2">Рабочий</option>
                        " +
                        "
                        <option value="3">Сотовый</option>
                        " +
                        "
                        <option value="4">Главный</option>
                        " +
                    </select>
                </td>
                <td>
                    <br/>
                    <a class="glyphicon glyphicon-trash" onclick="return deleteField(this)" href="#"></a>
                    <a class="glyphicon glyphicon-plus" onclick="return addField()" href="#"></a>
                </td>
            </tr>
        </table>
    </table>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

<script>

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
        tr.innerHTML = "<td><label class=\"control-label\">Номер телефона</label><input class=\"form-control mask\" name=\"number[" + curFieldNameId + "]\" type=\"text\" /></td>" +
            "<td><label class=\"control-label\">Тип номера</label><select class=\"form-control\" size=\"1\" name=\"type[" + curFieldNameId + "]\" >" +
            "<option value=\"1\">Домашний</option>" +
            "<option value=\"2\">Рабочий</option>" +
            "<option value=\"3\">Сотовый</option>" +
            "<option value=\"4\">Главный</option>" +
            "</select></td>" +
            "<td><br /><a class=\"glyphicon glyphicon-trash\" onclick=\"return deleteField(this)\" href=\"#\"></a> " +
            "<a class=\"glyphicon glyphicon-plus\" onclick=\"return addField()\" href=\"#\"></a></td>";

        // Добавляем новый узел в конец списка полей
        document.getElementById("parentId").appendChild(tr);

        $(".mask").mask("+7 (999) 999 99 99");
    }
</script>
