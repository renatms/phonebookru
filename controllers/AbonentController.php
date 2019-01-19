<?php

namespace app\controllers;
use Yii;
use yii\base\Model;
use app\models\Abonent;
use app\models\Phones;
use app\models\Groups;

class AbonentController extends AppController
{   
      public function actionDelete(){

            $i=Yii::$app->request->get('id');
            $phone = Phones::find()->where(['id'=>$i])->one();
            $phone->delete();

            return $this->redirect(Yii::$app->request->referrer);
    }
    
    public function actionAddition(){
        
        $abonent = new Abonent();
        $phone = new Phones();

        $q=(Yii::$app->request->post('submit1'));
        if ($q=='0'){                        
            return $this->redirect(['abonent/index']);
        }
        if ($q=='1'){            
            $abonent->load(Yii::$app->request->post());
            $phone->load(Yii::$app->request->post());
                                    
            $abonent->save(false);
            $phone->abonent_id = $abonent->id;
            $phone->group_id = 1;
            $phone->save(false);
            return $this->redirect(['abonent/index']);
        }

        return $this->render('addition', ['abonent' => $abonent, 'phone' => $phone]);
    }
    
    public function actionIndex(){
        
            $abonents = Abonent::find()->all();             
            $q=(Yii::$app->request->post('submit1'));
            if ($q == 'add'){
                return $this->redirect(['abonent/addition']);
            }
                                    
            return $this->render('index', [
                    'abonents' => $abonents
            ]);
    }

    public function actionDetail(){

        $i=Yii::$app->request->get('id');
        
        $abonent = Abonent::findOne($i);

        $phone = Phones::find()->where(['abonent_id'=>$i])->all();

        $group = Groups::find()->all();
        $data = yii\helpers\ArrayHelper::map($group, 'id', 'grypa');
                
        $newphone = new Phones();

        $q=(Yii::$app->request->post('submit1'));
        if ($abonent->load(Yii::$app->request->post())){
            
            if($q=='0'){
                return $this->redirect(['abonent/index']);
            }
            
            if($q=='1'){
        
                $isValid = $abonent->validate();

                Model::loadMultiple($phone, Yii::$app->request->post());
                foreach ($phone as $setting) {
                    $setting->save(false);                
                    }

                if ($isValid) {
                    $abonent->save(false);
                    }
                
            }
                
            if ($q == '2') {
                $newphone->load(Yii::$app->request->post());

                $newphone->abonent_id = $abonent->id;
                $newphone->save(false);
                return $this->refresh();
            }

            if ($q == '3') {
                $abonent->delete();
                return $this->redirect(['abonent/index']);
            }                       
        
        } 
        
        return $this->render('detail.php', ['abonent' => $abonent, 'phone' => $phone,
            'data' => $data, 'newphone' => $newphone]);
                
    }                                       

}            
            
	
	

