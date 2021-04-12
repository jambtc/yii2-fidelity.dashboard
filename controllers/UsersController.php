<?php

namespace app\controllers;

use Yii;
use app\models\Users;
use app\models\search\UsersSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\SignupForm;
use app\models\Merchants;
use app\components\WebApp;

/**
 * UsersController implements the CRUD actions for Users model.
 */
class UsersController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                    'subscribe' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Users models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new UsersSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Users model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel(WebApp::decrypt($id)),
        ]);
    }

    /**
     * Creates a new Users model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new SignupForm();

        if ($model->load(Yii::$app->request->post()) && $model->signup()) {
            return $this->redirect(['index']);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Users model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel(WebApp::decrypt($id));

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => WebApp::decrypt($model->id)]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }
    /**
     * Make a Merchant for an existing user.
     * If make is successful, the browser will be redirected to the merchants 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionSubscribe($id)
    {
        $user = $this->findModel(WebApp::decrypt($id));
        // echo '<pre>'.print_r($user,true);exit;

        // check whether merchant exists
        $merchant = Merchants::find()
            ->andWhere(['id_user' => $user->id])
            ->one();

        if ($merchant === null){
            $merchant = new Merchants();
            $merchant->id_user = $user->id;
            $merchant->denomination = $user->denomination;
            $merchant->tax_code = $user->tax_code;
            $merchant->address = $user->address;
            $merchant->cap = $user->cap;
            $merchant->city = $user->city;
            $merchant->country = $user->country;
        }

        if ($merchant->save()){
            $user->is_merchant = 1;
            $user->save();
            $this->sendMerchantActivationEmail($user);
            return $this->redirect(['merchants/index']);
        } else {
            Yii::$app->session->setFlash('errorSubscription', '<pre>'.print_r($merchant->errors,true));
        }

        return $this->render('view', [
            'model' => $user,
        ]);
    }

    /**
     * Deletes an existing Users model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $model = $this->findModel(WebApp::decrypt($id));
        return $this->redirect(['index']);
    }

    /**
     * Finds the Users model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Users the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Users::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }

    /**
     * Sends email to registered user with account activation link.
     *
     * @param  object $user Registered user.
     * @return bool         Whether the message has been sent successfully.
     */
    public function sendMerchantActivationEmail($user)
    {
        return Yii::$app->mailer->compose('accountActivationMerchant', ['user' => $user])
            ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->name . ' robot'])
            ->setTo($user->email)
            ->setSubject(Yii::t('app','Merchant account activation for ') . Yii::$app->name)
            ->send();
    }
}
