<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\date\DatePicker;

/* @var $this yii\web\View */
/* @var $model app\models\Abonent */
/* @var $phone app\models\Phone[] */
/* @var $phone app\models\Phone */
/* @var $newPhone app\models\Phone */
/* @var $group app\models\Group[] */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="abonent-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'first_name') ?>

    <?= $form->field($model, 'second_name') ?>

    <?= $form->field($model, 'middle_name') ?>

    <?= $form->field($model, 'FormattedBirthday')->widget(DatePicker::classname(), [
        'options' => ['placeholder' => 'Дата рождения'],
        'pluginOptions' => [
            'autoclose' => true
        ]
    ]) ?>
    <table>
        <?php if ($model->first_name != null): ?>
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
            <tr>
                <td>
                    <?= $form->field($newPhone, 'number')->
                    widget(\yii\widgets\MaskedInput::className(), [
                        'mask' => '+7 (999) 999 99 99',
                    ]); ?>
                </td>
                <td>
                    <?php echo $form->field($newPhone, 'group_id')->dropDownList(ArrayHelper::map($group, 'id', 'type')) ?>
                </td>
                <td align="justify">
                    <?= Html::submitButton("<span class='glyphicon glyphicon-plus' aria-hidden='true'></span>",
                        ['name' => 'submit1', 'value' => 'add', 'class' => 'kv-action-btn']) ?>
                </td>
            </tr>
        <?php else: ?> <!-- если модель пустая (форма для создания абонента-->
            <tr>
                <td>
                    <?= $form->field($phone, 'number')->
                    widget(\yii\widgets\MaskedInput::className(), [
                        'mask' => '+7 (999) 999 99 99',
                    ]); ?>
                </td>
                <td>
                    <?php echo $form->field($phone, 'group_id')->dropDownList(ArrayHelper::map($group, 'id', 'type')) ?>
                </td>
            </tr>
        <?php endif; ?>
    </table>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
