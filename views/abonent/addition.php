<?php
use yii\widgets\ActiveForm;
use yii\helpers\html;
?>

<?php $form = ActiveForm::begin()?>

    <?=$form->field($abonent, 'name')->label('Имя')?>
    <?=$form->field($abonent, 'sname')->label('Фамилия')?>
    <?=$form->field($abonent, 'oname')->label('Отчество')?>
    <?=$form->field($abonent, 'birth')->label('Дата рождения')->
        widget(\yii\widgets\MaskedInput::className(), [
        'mask' => '99.99.9999 г.',
        ]);?>

    <?=$form->field($phone, 'number')->label('Номер телефона')->
        widget(\yii\widgets\MaskedInput::className(), [
        'mask' => '+7 (999) 999 99 99',
        ]);?>    
              
<table>
    <tr>        
        <td>
            <?= Html::submitButton('Назад',
                    ['name' => 'submit1', 'value' => '0','class'=>'btn btn-primary']) ?>
        </td>
        <td>            
            <?= Html::submitButton('Сохранить',
                    ['name' => 'submit1', 'value' => '1','class'=>'btn btn-primary pull-right']) ?>
        </td>        
    </tr>
</table>     
<?php ActiveForm::end()?>  
   











        

        