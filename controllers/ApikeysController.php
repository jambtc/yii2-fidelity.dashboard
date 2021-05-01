<?php

namespace app\controllers;

use Yii;
use app\models\Apikeys;
use app\models\search\ApikeysSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Json;
use app\components\WebApp;
use app\models\Merchants;
use app\components\languageSwitcher;


/**
 * ApikeysController implements the CRUD actions for Apikeys model.
 */
class ApikeysController extends Controller
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
                ],
            ],
        ];
    }

    public function beforeAction($action)
	{
    	languageSwitcher::init();
        return parent::beforeAction($action);
	}

    /**
	 * Generate Api KEys for RULES ENGINE
	 * @param
	 */
	public function actionGetApiKeys()
	{
        return Json::encode([
			'public' => \Yii::$app->security->generateRandomString(48),
			'secret' => \Yii::$app->security->generateRandomString(24),
		]);
	}

    /**
     * Lists all Apikeys models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ApikeysSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        if (Yii::$app->user->id != 1)
            $dataProvider->query->andWhere(['=','id_merchant', Merchants::getIdByUser(Yii::$app->user->id)]);


        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Apikeys model.
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
     * Creates a new Apikeys model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Apikeys();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => WebApp::encrypt($model->id)]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Apikeys model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel(WebApp::decrypt($id));

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => WebApp::encrypt($model->id)]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Apikeys model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Apikeys model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Apikeys the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Apikeys::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
