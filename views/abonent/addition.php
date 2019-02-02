<?php
/* @var $this yii\web\View */
/* @var $form yii\widgets\ActiveForm */
/* @var $abonent app\models\Abonent[] */
/* @var $phone app\models\Phone[] */

use yii\widgets\ActiveForm;
use yii\helpers\html;

$this->params['breadcrumbs'][] = $this->title='Добавление контакта';
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


    <tr>
        <td>
            <?=$form->field($phone, 'number')->
            widget(\yii\widgets\MaskedInput::className(), [
                'mask' => '+7 (999) 999 99 99',
            ]);?>
        </td>
        <td>
            <?php echo $form->field($phone, 'group_id')->dropDownList($data) ?>
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
                ['class' => 'btn btn-primary pull-right']) ?>
        </td>
    </tr>
</table>
<?php ActiveForm::end()?>
   











        

        