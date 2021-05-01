<?php

namespace app\controllers;

use Yii;
use app\models\ReRequests;
use app\models\search\ReRequestsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\ActiveDataProvider;
use app\components\languageSwitcher;


/**
 * ReRequestsController implements the CRUD actions for ReRequests model.
 */
class RulesenginerequestsController extends Controller
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
     * Lists all ReRequests models.
     * @return mixed
     */
    public function actionIndex()
    {
        $query = ReRequests::find()
            ->orderBy(['id' => SORT_DESC]);


        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 20,
            ],
        ]);

        $searchModel = new ReRequestsSearch();
        //$dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ReRequests model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }




    /**
     * Finds the ReRequests model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ReRequests the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ReRequests::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
