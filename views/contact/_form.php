<?php

use app\assets\PhoneAsset;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\date\DatePicker;

/* @var $this yii\web\View */
/* @var $model app\models\Contact */
/* @var $phones app\models\Phone[] */
/* @var $group app\models\Group[] */
/* @var $form yii\widgets\ActiveForm */
/* @var $update bool */

PhoneAsset::register($this);
?>

<div class="contact-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'first_name') ?>

    <?= $form->field($model, 'second_name') ?>

    <?= $form->field($model, 'middle_name') ?>

    <?= $form->field($model, 'formattedBirthday')->widget(DatePicker::classname(), [
        'options' => ['placeholder' => 'Дата рождения'],
        'pluginOptions' => [
            'format' => 'dd.mm.yyyy',
            'autoclose' => true
        ]
    ]) ?>
    <table>
        <thead>
        <th>
            <label class="control-label" for="mask">Номер телефона</label>
        </th>
        <th>
            <label class="control-label" for="typephone">Тип номера</label>
        </th>
        </thead>
        <tbody id="parentId">
        <?php if ($update): ?>
            <?php foreach ($phones as $index => $ph): ?>
                <tr>
                    <td>
                        <?= $form->field($ph, "[$index]number")->
                        widget(\yii\widgets\MaskedInput::className(), [
                            'mask' => '+7 (999) 999 99 99',
                        ])->label(false) ?>
                    </td>
                    <td>
                        <?= $form->field($ph, "[$index]group_id")->dropDownList(ArrayHelper::map($group, 'id', 'type'))->label(false) ?>
                    </td>
                    <td>
                        <?= Html::a('<span data-phone-id='  . $ph->id . ' class="glyphicon glyphicon-trash"></span>',
                            ['#'],
                            [
                                'title' => 'Удалить',
                                'data-confirm' => "Хотите удалить?",
                                'data-pjax' => '1'
                            ]); ?>
                    </td>
                </tr>
            <?php endforeach; ?>


        <?php else: ?>
            <tr>
                <td>

                    <input class="form-control" id="mask" name="NewPhone[0][number]" type="text"/>
                </td>
                <td>

                    <select class="form-control" id="typephone" size="1" name="NewPhone[0][group_id]">
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
                    <a class="glyphicon glyphicon-trash" onclick="return deleteField(this)" href="#"></a>
                </td>
            </tr>

        <?php endif; ?>

    </table>

    <a class="glyphicon glyphicon-plus" onclick="return addField()" href="#">Добавить номер</a>
    <br/>
    <br/>
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
