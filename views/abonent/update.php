<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Abonent */
/* @var $phones app\models\Phone[] */
/* @var $group app\models\Group[] */
/* @var $update bool */

$this->title = 'Обновить данные контакта:';
$this->params['breadcrumbs'][] = ['label' => 'Контакты', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->first_name . ' ' . $model->second_name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Обновить';
?>
<div class="abonent-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model, 'phones' => $phones, 'group' => $group, 'update' => $update
    ]) ?>

</div>
