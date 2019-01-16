<?php
use yii\widgets\ActiveForm;
use yii\helpers\html;
?>

<?php $form = ActiveForm::begin()?>

    <?=$form->field($query, 'name')->label('Имя')?>
    <?=$form->field($query, 'sname')->label('Фамилия')?>
    <?=$form->field($query, 'oname')->label('Отчество')?>
    <?=$form->field($query, 'birth')->label('Дата рождения')?>

<table>

<?php foreach ($query2 as $index => $qx): ?>
    <tr>
            <td>
                    <?=$form->field($qx, "[$index]number")->label('Номер телефона:');?>                                                
            </td>
            <td>
                               
                    <?php echo $form->field($qx, "[$index]group_id")->dropDownList($data)
                            ->label('Тип номера'); ?>
            </td>
            <td>                
                <a href="<?=yii\helpers\Url::to(['abonent/delete','id'=>$qx->id])?>">Удалить</a>
            </td>
    </tr>

<?php endforeach;?>     
    <tr>
        <td>
            <?=$form->field($queryn, 'number')->label('Номер телефона')->
            widget(\yii\widgets\MaskedInput::className(), [
            'mask' => '+7 (999) 999 99 99',
            ]);?>
        </td>
        <td>
            <?php echo $form->field($queryn, 'group_id')->dropDownList($data)
                            ->label('Тип номера'); ?>
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
            <?= Html::submitButton('Назад',
        [ 'name'=>'submit1', 'value' => '0', 'class' => 'btn btn-primary pull-right']) ?>            
        </td>
        <td>
<?= Html::submitButton('Обновить',
        [ 'name'=>'submit1', 'value' => '1', 'class' => 'btn btn-primary pull-right']) ?>     
        </td>
        <td>
<?= Html::submitButton('Удалить абонента',
        [ 'name'=>'submit1', 'value' => '3', 'class' => 'btn btn-primary pull-right']) ?>                        
        </td>    
    </tr>    
</table>
<?php ActiveForm::end()?>                











        

        