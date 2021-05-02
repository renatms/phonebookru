<?php

namespace app\controllers;

use Yii;
use app\models\Phone;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class PhoneController extends Controller
{

    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionDelete()
    {
        $id = post('id') ?? '';
        $phone=$this->findModel($id);
        $phone->delete();

        return 'Phone is deleted';
    }

    protected function findModel($id)
    {
        if (($phone = Phone::findOne($id)) !== null) {
            return $phone;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

}
