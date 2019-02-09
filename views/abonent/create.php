<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Abonent */
/* @var $phone app\models\Phone */
/* @var $group app\models\Group[] */

$this->title = 'Новый абонент';
$this->params['breadcrumbs'][] = ['label' => 'Абоненты', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="abonent-create">

    <h1><?= Html::encode($this->title) ?></h1>
    <?= $this->render('_form', [
        'model' => $model, 'phone' => $phone, 'group' => $group
    ]) ?>

</div>
