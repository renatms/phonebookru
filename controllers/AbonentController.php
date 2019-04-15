<?php

namespace app\controllers;

use Yii;
use yii\base\Model;
use app\models\Abonent;
use app\models\Phone;
use app\models\Group;
use app\models\AbonentSearch;
use app\models\SignupForm;
use app\models\LoginForm;
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
            'model' => $this->findModel($id), 'phone' => $this->findPhones($id)
        ]);
    }

    /**
     * Creates a new Abonent model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if (Empty(Yii::$app->user->identity)) {
            Yii::$app->session->setFlash('error', 'Пожалуйста, зарегистрируйтесь или авторизуйтесь');
            return $this->redirect(['index']);
        }

        $update = false;
        $model = new Abonent();
        $phone = new Phone();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            $post = Yii::$app->request->post();
            foreach ($post[number] as $key => $num) {
                if (!empty($num)) {

                    $phone = new Phone();
                    $phone->abonent_id = $model->id;
                    $phone->number = $num;
                    $phone->group_id = $post[type][$key];
                    $phone->save();
                }
            }

            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model, 'phone' => $phone, 'update' => $update
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
        $update = true;
        $model = $this->findModel($id);
        $phone = $this->findPhones($id);
        $group = Group::find()->all();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Model::loadMultiple($phone, Yii::$app->request->post());
            foreach ($phone as $setting) {
                $setting->save();
            }

            $post = Yii::$app->request->post();

            foreach ($post[number] as $key => $num) {
                if (!empty($num)) {

                    $phone = new Phone();
                    $phone->abonent_id = $model->id;
                    $phone->number = $num;
                    $phone->group_id = $post[type][$key];
                    $phone->save();
                }
            }

            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model, 'phone' => $phone, 'group' => $group, 'update' => $update
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
        $model = $this->findModel($id);
        $model->delete();
        return $this->redirect(['index']);
    }

    /**
     * @return string
     */
    public function actionAbout()
    {
        $model = new Abonent();

        return $this->render('about', [
            'model' => $model
        ]);
    }

    /**
     * @return string|\yii\web\Response
     */
    public function actionSignup()
    {
        $model = new SignupForm();

        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->signup()) {
                if (Yii::$app->getUser()->login($user)) {
                    return $this->goHome();
                }
            }
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
    }


    /**
     * @return string|\yii\web\Response
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }


    /**
     * @return \yii\web\Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
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
    protected function findPhones($id)
    {
        if (($phone = Phone::find()->notDeleted()->forAbonent($id)->all()) !== null) {
            return $phone;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
