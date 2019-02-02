<?php
/* @var $this yii\web\View */
/* @var $form yii\widgets\ActiveForm */
/* @var $abonent app\models\Abonent[] */

use yii\widgets\ActiveForm;
use yii\helpers\Html;

$this->params['breadcrumbs'][] = $this->title='Контакт';
?>

<?php $form = ActiveForm::begin()?>
<table>
    <tr>
        <td>
            <?=$form->field($abonent, 'created_at')?>
        </td>
        <td>
            <?=$form->field($abonent, 'updated_at')?>
        </td>
    </tr>
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
                <?=$form->field($ph, 'created_at')?>
            </td>
            <td>
                <?=$form->field($ph, 'updated_at')?>
            </td>
        </tr>

    <?php endforeach;?>
    <tr>
        <td>
            <?= Html::a('Назад', ['/abonent/index'], ['class'=>'btn btn-primary']) ?>
            <?= Html::a('Редактировать', ['/abonent/detail', 'id'=>$abonent->id], ['class'=>'btn btn-primary']) ?>
        </td>
        <td>
            <?= Html::submitButton('Удалить абонента',
                [ 'name'=>'submit1', 'value' => '1', 'class' => 'btn btn-primary pull-left',
                    'data-confirm'=>"Хотите удалить?",
                    'data-pjax'=>'1']) ?>
        </td>
    </tr>

</table>
<?php ActiveForm::end()?>    
    





