<?php
use yii\widgets\ActiveForm;
use yii\helpers\html;
?>

<?php $form = ActiveForm::begin()?>

    <?=$form->field($query, 'name')->label('Имя')?>
    <?=$form->field($query, 'sname')->label('Фамилия')?>
    <?=$form->field($query, 'oname')->label('Отчество')?>
    <?=$form->field($query, 'birth')->label('Дата рождения')->
        widget(\yii\widgets\MaskedInput::className(), [
        'mask' => '99.99.9999 г.',
        ]);?>

    <?=$form->field($query2, 'number')->label('Номер телефона')->
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
   











        

        