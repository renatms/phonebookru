<?php

namespace app\controllers;
use Yii;
use app\models\Phone;
use yii\web\NotFoundHttpException;

class PhoneController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionDelete($id)
    {
        $phone=$this->findModel($id);
        $phone->delete();

        return $this->redirect(Yii::$app->request->referrer);
    }

    protected function findModel($id)
    {
        if (($phone = Phone::findOne($id)) !== null) {
            return $phone;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

}
