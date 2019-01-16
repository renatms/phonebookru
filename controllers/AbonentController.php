<?php

namespace app\controllers;
use Yii;
use yii\helpers\html;
use yii\helpers\ArrayHelper;
use yii\base\Model;

use app\models\Abonent;
use app\models\Phones;
use app\models\Groups;

class AbonentController extends AppController
{   
      public function actionDelete(){

            $i=$_GET['id'];
            $query2 = Phones::find()->where(['id'=>$i])->one();            
            $query2->delete();
            //переход на предыдущую страницу
            return $this->redirect(Yii::$app->request->referrer);
    }
    
    public function actionAddition(){
        
        $query = new Abonent();
        $query2 = new Phones();
        
        $query3 = Groups::find()->all();
        //$data = yii\helpers\ArrayHelper::map($query3, 'id', 'grypa');                  
        $q=(Yii::$app->request->post('submit1'));
        if ($q=='0'){                        
            return $this->redirect(['abonent/index']);
        }
        if ($q=='1'){            
            $query->load(Yii::$app->request->post());
            $query2->load(Yii::$app->request->post());                        
                                    
            $query->save(false);
            $query2->abonent_id = $query->id;
            $query2->group_id = 1;
            $query2->save(false);     
            return $this->redirect(['abonent/index']);
        }
        
        
        return $this->render('addition', ['query' => $query, 'query2' => $query2]);
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

        $i=$_GET['id'];
        
        $query = Abonent::findOne($i);	

        $query2 = Phones::find()->where(['abonent_id'=>$i])->all();            

        $query3 = Groups::find()->all();
        $data = yii\helpers\ArrayHelper::map($query3, 'id', 'grypa');   
                
        $queryn = new Phones();

        $q=(Yii::$app->request->post('submit1'));
        if ($query->load(Yii::$app->request->post())){   
            
            if($q=='0'){
                return $this->redirect(['abonent/index']);
            }
            
            if($q=='1'){
        
                $isValid = $query->validate();            

                Model::loadMultiple($query2, Yii::$app->request->post());
                foreach ($query2 as $setting) {
                    $setting->save(false);                
                    }

                if ($isValid) {
                    $query->save(false);                                          
                    //return $this->refresh();
                    }
                
            }    //***********************************
                
            if ($q == '2') {
                $queryn->load(Yii::$app->request->post());

                $queryn->abonent_id = $query->id;
                $queryn->save(false);
                return $this->refresh();
            }
            
                //****************************
            if ($q == '3') {
                $query->delete();
                return $this->redirect(['abonent/index']);
            }                       
        
        } 
        
        return $this->render('detail.php', ['query' => $query, 'query2' => $query2,
            'data' => $data, 'queryn' => $queryn]);    
                
    }                                       

}            
            
	
	

