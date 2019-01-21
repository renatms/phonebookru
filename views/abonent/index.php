<?php
/* @var $this yii\web\View */
/* @var $form yii\widgets\ActiveForm */
/* @var $abonents app\models\Abonent[] */

use yii\widgets\ActiveForm;
use yii\helpers\Html;

$this->params['breadcrumbs'][] = $this->title;
?>

<?php $form = ActiveForm::begin()?>
<table class="table">
    <thead>
        <tr>            
            <th>Имя</th>
            <th>Фамилия</th>
            <th>Отчество</th>
            <th>Дата рождения</th>
        </tr>
        <tbody>
            <?php foreach ($abonents as $abonentx): ?> 
                <tr>
                    <td><?=$abonentx->name?></td>
                    <td><?=$abonentx->sname?></td>
                    <td><?=$abonentx->oname?></td>
                    <td><?=$abonentx->birth?></td>
                    
                    <td>
                    <a href="<?=yii\helpers\Url::to(['abonent/detail','id'=>$abonentx->id])?>">Подробнее</a>
                    </td>
                </tr>
            <?php endforeach;?>       
                
        </tbody>        
    </thead>    
                    
</table>

<?= Html::submitButton('Добавить',
        [ 'name'=>'submit1', 'value' => 'add', 'class' => 'btn btn-primary']) ?>            
<?php ActiveForm::end()?>    
    





