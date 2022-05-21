<?php

namespace app\controllers;

use app\models\Phone;
use yii\db\Exception;
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

    public function actionIndex(): string
    {
        return $this->render('index');
    }

    /**
     * @throws NotFoundHttpException
     * @throws \Throwable
     */
    public function actionDelete(): string
    {
        $id = post('id') ?? '';
        $phone=$this->findModel($id);
        try {
            $phone->delete();
        } catch (Exception $e) {
            throw new NotFoundHttpException('delete failed');
        }

        return 'Phone is deleted';
    }

    protected function findModel($id): ?Phone
    {
        if (($phone = Phone::findOne($id)) !== null) {
            return $phone;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

}
