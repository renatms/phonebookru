<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Abonent */
/* @var $phone app\models\Phone[] */
/* @var $newPhone app\models\Phone */
/* @var $group app\models\Group[] */

$this->title = 'Обновить данные абонента:';
$this->params['breadcrumbs'][] = ['label' => 'Абоненты', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->first_name . ' ' . $model->second_name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Обновить';
?>
<div class="abonent-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model, 'phone' => $phone, 'group' => $group, 'newPhone' => $newPhone
    ]) ?>

</div>
