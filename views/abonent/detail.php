<?php
/* @var $this yii\web\View */
/* @var $form yii\widgets\ActiveForm */
/* @var $abonent app\models\Abonent[] */
/* @var $phone app\models\Phone[] */
/* @var $newphone app\models\Phone[] */

use yii\widgets\ActiveForm;
use yii\helpers\html;

$this->params['breadcrumbs'][] = $this->title='Подробнее';
?>

<?php $form = ActiveForm::begin()?>
<table>
    <tr>
        <td>
    <?=$form->field($abonent, 'first_name')?>
    <?=$form->field($abonent, 'second_name')?>
    <?=$form->field($abonent, 'middle_name')?>
    <?=$form->field($abonent, 'birthday')->
        widget(\yii\widgets\MaskedInput::className(), [
        'mask' => '99.99.9999',
        ]);?>
        </td>
    </tr>
<?php foreach ($phone as $index => $ph): ?>
    <tr>
            <td>
                    <?=$form->field($ph, "[$index]number")?>
            </td>
            <td>
                               
                    <?php echo $form->field($ph, "[$index]group_id")->dropDownList($data)?>
            </td>
            <td>                
                <?=Html::a('<span class="glyphicon glyphicon-trash"></span>',
                    ['abonent/delete', 'id' => $ph->id],
                    [
                        'title' => 'Удалить',
                        'data-confirm'=>"Хотите удалить?",
                        'data-pjax'=>'1'
                    ]);?>
            </td>
    </tr>

<?php endforeach;?>     
    <tr>
        <td>
            <?=$form->field($newphone, 'number')->
            widget(\yii\widgets\MaskedInput::className(), [
            'mask' => '+7 (999) 999 99 99',
            ]);?>
        </td>
        <td>
            <?php echo $form->field($newphone, 'group_id')->dropDownList($data) ?>
        </td>
        <td align="justify"> 
            <?= Html::submitButton("<span class='glyphicon glyphicon-plus' aria-hidden='true'></span>",
        [ 'name'=>'submit1', 'value' => '2', 'class' => 'kv-action-btn']) ?>
        </td>
    </tr>
</table>	

<br />
<table>
    <tr>
        <td>
            <?= Html::a('Назад', ['/abonent/index'], ['class'=>'btn btn-primary']) ?>
        </td>
        <td>
<?= Html::submitButton('Сохранить',
        [ 'name'=>'submit1', 'value' => '1', 'class' => 'btn btn-primary pull-right']) ?>
        </td>

    </tr>    
</table>
<?php ActiveForm::end()?>                











        

        