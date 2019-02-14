<?php

namespace app\controllers;

use Yii;
use yii\base\Model;
use app\models\Abonent;
use app\models\Phone;
use app\models\Group;
use app\models\AbonentSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * AbonentController implements the CRUD actions for Abonent model.
 */
class AbonentController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Abonent models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AbonentSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Abonent model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id), 'phone' => $this->findPhone($id)
        ]);
    }

    /**
     * Creates a new Abonent model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Abonent();
        $phone = new Phone();
        $group = Group::find()->all();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $phone->load(Yii::$app->request->post());
            if(!empty($phone->number)){
                $phone->abonent_id = $model->id;
                $phone->save();
            }

            return $this->redirect(['view', 'id' => $model->id]);
        }
        return $this->render('create', [
            'model' => $model, 'phone'=>$phone, 'group' => $group
        ]);
    }

    /**
     * Updates an existing Abonent model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $phone = $this->findPhone($id);
        $newphone = new Phone();
        $group = Group::find()->all();

        $submit=Yii::$app->request->post('submit1');
        $newphone->load(Yii::$app->request->post());
        if ($submit == 'add' && $newphone->number!="") {
            $newphone->abonent_id = $model->id;
            $newphone->save();
            return $this->refresh();
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Model::loadMultiple($phone, Yii::$app->request->post());
            foreach ($phone as $setting) {
                $setting->save();
            }

            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model, 'phone'=>$phone, 'group' => $group, 'newphone' => $newphone
        ]);
    }

    /**
     * Deletes an existing Abonent model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $model=$this->findModel($id);
        $model->delete();
        return $this->redirect(['index']);
    }

    /**
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    /**
     * Finds the Abonent model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Abonent the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Abonent::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    /**
     * @param $id
     * @return array|\yii\db\ActiveRecord[]
     * @throws NotFoundHttpException
     */
    protected function findPhone($id)
    {
        if (($phone = Phone::find()->notDeleted($id)->all()) !== null) {
            return $phone;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
