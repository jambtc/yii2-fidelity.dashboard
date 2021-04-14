<?php

namespace app\controllers;

use Yii;
use app\models\Notifications;
use app\models\NotificationsReaders;
use app\models\search\NotificationsSearch;
use app\models\search\NotificationsReadersSearch;
use app\models\query\NotificationsReadersQuery;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\ActiveDataProvider;

/**
 * NotificationsController implements the CRUD actions for Notifications model.
 */
class NotificationsController extends Controller
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

    /**
     * Lists all Notifications models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new NotificationsReadersSearch();
        // echo '<pre>'.print_r(Yii::$app->request->queryParams,true);exit;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        //
        // $reader = new NotificationsReaders
        //
        // $dataProvider = NotificationsReaders::find()
        //  ->getNotification()
        //     // ->select('notifications_readers.*')
        //     // ->leftJoin('notifications', '`notifications`.`id` = `notifications_readers`.`id_notification`')
        //     // ->where(['notifications_readers.id_user' => Yii::$app->user->id])
        //     // ->with('notifications')
        //     ->all();
        //
        // echo '<pre>'.print_r($dataProvider,true);exit;


        // $dataProvider = new ActiveDataProvider([
        //     'query' => NotificationsReaders::find()
        //         ->getNotification()
        //         ->getUser()
        //                 // ->select('notifications_readers.*')
        //                 // ->leftJoin('notifications', '`notifications`.`id` = `notifications_readers`.`id_notification`')
        //                 // ->where(['notifications_readers.id_user' => Yii::$app->user->id])
        //                 // ->with('notifications')
        //
        // ]);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Notifications model.
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
     * Creates a new Notifications model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Notifications();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Notifications model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Notifications model.
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
     * Finds the Notifications model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Notifications the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Notifications::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
