<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Abonent */
/* @var $phone app\models\Phone */
/* @var $update */

$this->title = 'Новый контакт';
$this->params['breadcrumbs'][] = ['label' => 'Контакты', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="abonent-create">

    <h1><?= Html::encode($this->title) ?></h1>
    <?= $this->render('_form', [
        'model' => $model, 'phone' => $phone, 'update' => $update
    ]) ?>

</div>
