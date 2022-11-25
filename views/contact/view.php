<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Contact */
/* @var $phone app\models\Phone[] */
/* @var $group app\models\Group[] */

$this->title = $model->first_name . ' ' . $model->second_name;
$this->params['breadcrumbs'][] = ['label' => 'Контакты', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="contact-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'first_name',
            'second_name',
            'middle_name',
            [
                'attribute' => 'birthday',
                'format' => ['date', 'php:d.m.Y'],
            ],
            [
                'attribute' => 'created_at',
                'format' => ['date', 'php:d.m.Y H:s'],
            ],
            [
                'attribute' => 'updated_at',
                'format' => ['date', 'php:d.m.Y H:s'],
            ],
        ],
    ]) ?>
    <?php foreach ($phone as $index => $ph): ?>
        <?= DetailView::widget([
            'model' => $phone[$index],
            'attributes' => [
                'number',
                [
                    'attribute' => 'group_id',
                    'value' => function ($model) {
                        $group = \app\models\Group::findOne($model->group_id);
                        return $group->type;
                    },
                ],
                [
                    'attribute' => 'created_at',
                    'format' => ['date', 'php:d.m.Y H:s'],
                ],
                [
                    'attribute' => 'updated_at',
                    'format' => ['date', 'php:d.m.Y H:s'],
                ],
            ],
        ]) ?>

    <?php endforeach; ?>

</div>
