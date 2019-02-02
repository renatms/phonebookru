<?php
/* @var $this yii\web\View */
/* @var $form yii\widgets\ActiveForm */

use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\data\ActiveDataProvider;

$this->params['breadcrumbs'][] = $this->title='Контакты';
?>

<?php $form = ActiveForm::begin()?>

<?php

/** @var TYPE_NAME $searchModel */
/** @var TYPE_NAME $dataProvider */
echo GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'second_name',
            'first_name',
            'middle_name',
            [
                'attribute' => 'birthday',
                'format' => ['date', 'php:d.m.Y'],
            ],

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view} {update}{delete}',
                'buttons' => [

                    'view' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-eye-open"></span>',
                            ['abonent/contact', 'id' => $model->id],
                        [
                            'title' => 'Посмотреть',
                        ]);
                    },
                    'update' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-pencil"></span>',
                            ['abonent/detail', 'id' => $model->id],
                        [
                            'title' => 'Редактировать',
                        ]);
                    },
                    'delete' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-trash"></span>',
                            ['abonent/deleteabonent', 'id' => $model->id],
                            [
                                'title' => 'Удалить',
                                'data-confirm'=>"Хотите удалить?",
                                'data-pjax'=>'1'
                            ]);
                    },
                ],

            ],
        ],
    ]);
?>

<?= Html::a('Добавить', ['/abonent/addition'], ['class'=>'btn btn-primary']) ?>
<?php ActiveForm::end()?>    
    





