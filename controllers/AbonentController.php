<?php

namespace app\controllers;

use app\services\PhoneService;
use Yii;
use app\models\Abonent;
use app\models\Phone;
use app\models\Group;
use app\models\AbonentSearch;
use app\models\SignupForm;
use app\models\LoginForm;
use yii\db\Exception;
use yii\db\StaleObjectException;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * AbonentController implements the CRUD actions for Abonent model.
 */
class AbonentController extends Controller
{
    private $phoneService;

    /**
     * @inheritdoc
     */
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

    public function __construct($id, $module, PhoneService $phoneService, $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->phoneService = $phoneService;
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
        if (Empty(user())) {
            Yii::$app->session->setFlash('error', 'Пожалуйста, зарегистрируйтесь или авторизуйтесь');
            return $this->redirect(['index']);
        }

        $model = new Abonent();
        $phones = new Phone();
        $post = post();

        if ($model->load($post) && $model->save()) {
            $this->phoneService->savePhone($model->id, $post);

            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model, 'phones' => $phones, 'update' => false
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
        $phones = $this->findPhones($id);
        $group = Group::find()->all();
        $post = post();

        if ($model->load($post) && $model->save()) {
            $this->phoneService->savePhone($id, $post, $phones);

            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model, 'phones' => $phones, 'group' => $group, 'update' => true
        ]);
    }

    /**
     * Deletes an existing Abonent model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     * @throws Exception
     */
    public function actionDelete()
    {
        $id = post('id') ?? '';
        $model = $this->findModel($id);
        try {
            $model->delete();
        } catch (\Throwable $e) {
            throw new Exception($e->getMessage());
        }

        $searchModel = new AbonentSearch();
        $dataProvider = $searchModel->search([]);

        return $this->renderAjax('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
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

        if ($model->load(post())) {
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
        if ($model->load(post()) && $model->login()) {
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
