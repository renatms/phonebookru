<?php
/* @var $this yii\web\View */
/* @var $user \frontend\models\domains\User */
/* @var $transactionsDataProvider yii\data\ActiveDataProvider */
use yii\widgets\ActiveForm;
use yii\helpers\html;
?>

<?php $form = ActiveForm::begin()?>

    <?=$form->field($abonent, 'name')?>
    <?=$form->field($abonent, 'sname')?>
    <?=$form->field($abonent, 'oname')?>
    <?=$form->field($abonent, 'birth')->
        widget(\yii\widgets\MaskedInput::className(), [
        'mask' => '99.99.9999 г.',
        ]);?>

    <?=$form->field($phone, 'number')->
        widget(\yii\widgets\MaskedInput::className(), [
        'mask' => '+7 (999) 999 99 99',
        ]);?>    
              
<table>
    <tr>        
        <td>
            <?= Html::a('Назад', ['/abonent/index'], ['class'=>'btn btn-primary']) ?>
        </td>
        <td>            
            <?= Html::submitButton('Сохранить', ['class'=>'btn btn-primary pull-right']) ?>
        </td>        
    </tr>
</table>     
<?php ActiveForm::end()?>  
   











        

        