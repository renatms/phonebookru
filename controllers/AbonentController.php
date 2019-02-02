<?php

namespace app\controllers;
use Yii;
use yii\base\Model;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use app\models\Abonent;
use app\models\Phone;
use app\models\Group;

//use yii\data\ActiveDataProvider;

class AbonentController extends Controller
{
    public function actionContact($id){

        $abonent = Abonent::find()->Where(['id'=>$id])->andWhere(['is_deleted'=>0])->one();

        $phone = Phone::find()->where(['abonent_id'=>$id])->andWhere(['is_deleted'=>0])->all();

        $group = Group::find()->all();
        $data = ArrayHelper::map($group, 'id', 'grypa');

        $q=Yii::$app->request->post('submit1');
        if ($q == '1') {
            $abonent->is_deleted = true;
            $abonent->save();
            return $this->redirect(['abonent/index']);
        }
        $abonent->birthday = Yii::$app->formatter->asDatetime($abonent->birthday, "php:d.m.Y");
        $abonent->created_at = Yii::$app->formatter->asDatetime($abonent->created_at,'php:d.m.Y H:i:s');
        $abonent->updated_at = Yii::$app->formatter->asDatetime($abonent->updated_at,'php:d.m.Y H:i:s');
        foreach ($phone as $ph){
            $ph->created_at = Yii::$app->formatter->asDatetime($ph->created_at,'php:d.m.Y H:i:s');
            $ph->updated_at = Yii::$app->formatter->asDatetime($ph->updated_at,'php:d.m.Y H:i:s');
        }

        return $this->render('contact', [
            'abonent' => $abonent, 'phone' =>$phone, 'data'=>$data
        ]);
    }

    public function actionDelete($id){
        $phone = Phone::find()->where(['id'=>$id])->one();
        $phone->is_deleted=true;
        $phone->save();
        return $this->redirect(Yii::$app->request->referrer);
    }

    public function actionDeleteabonent($id){
        $abonent = Abonent::find()->where(['id'=>$id])->one();
        $abonent->is_deleted=true;
        $abonent->save();
        return $this->redirect(Yii::$app->request->referrer);
    }

    public function actionAddition(){

        $abonent = new Abonent();
        $phone = new Phone();

        $group = Group::find()->all();
        $data = ArrayHelper::map($group, 'id', 'grypa');

        if($abonent->load(Yii::$app->request->post())){
            $phone->load(Yii::$app->request->post());
            $abonent->birthday = Yii::$app->formatter->asDatetime($abonent->birthday, "php:Y.m.d");

            $abonent->save(false);
            $phone->abonent_id = $abonent->id;
            $phone->save(false);
            return $this->redirect(['abonent/index']);
        }
        return $this->render('addition.php', ['abonent' => $abonent, 'phone' => $phone,
            'data' => $data]);
    }
    
    public function actionIndex(){

        $searchModel = new Abonent();
        $dataProvider = $searchModel->search(Yii::$app->request->post());

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel,
        ]);
    }

    public function actionDetail($id){

        $abonent = Abonent::find()->Where(['id'=>$id])->andWhere(['is_deleted'=>0])->one();

        $phone = Phone::find()->where(['abonent_id'=>$id])->andWhere(['is_deleted'=>0])->all();

        $group = Group::find()->all();
        $data = ArrayHelper::map($group, 'id', 'grypa');

        $newphone = new Phone();

        $q=Yii::$app->request->post('submit1');
        if ($abonent->load(Yii::$app->request->post())){

            if($q=='1'){
        
                $isValid = $abonent->validate();

                Model::loadMultiple($phone, Yii::$app->request->post());
                foreach ($phone as $setting) {
                    $setting->save(false);                
                    }

                if ($isValid) {
                    $abonent->birthday = Yii::$app->formatter->asDatetime($abonent->birthday, "php:Y-m-d");
                    $abonent->save(false);
                    }
                return $this->redirect(['abonent/index']);
            }
            $newphone->load(Yii::$app->request->post());
            if ($q == '2' && $newphone->number!="") {
                $newphone->abonent_id = $abonent->id;
                $newphone->save(false);
                return $this->refresh();
            }
        
        }
        $abonent->birthday = Yii::$app->formatter->asDatetime($abonent->birthday, "php:d.m.Y");
        return $this->render('detail.php', ['abonent' => $abonent, 'phone' => $phone,
            'data' => $data, 'newphone' => $newphone]);
                
    }                                       

}            
            
	
	

