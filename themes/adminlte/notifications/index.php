<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use app\components\WebApp;
use app\models\Users;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\NotificationsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Notifications');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    // 'filterModel' => $searchModel,
                    'columns' => [
                        // ['class' => 'yii\grid\SerialColumn'],

                        // 'id',
                        // 'id_user',
                        [
                            'attribute' => 'id_user',
                            'format' => 'raw',
                            'value' => function ($data) {
                                $id = WebApp::encrypt($data->id_user);
                                $user = Users::findOne($data->id_user);
                                return Html::a($user->username, Url::toRoute(['/users/view', 'id' => $id]),
                                        [
                                            'class' => 'badge badge-success center-block text-truncate',
                                            'style' => 'max-width: 250px;'
                                        ]
                                    );
                            },
                            'visible' => (Yii::$app->user->id == 1) ? true : false,    
                        ],
                        'notification.timestamp:datetime',
                        'notification.type',
                        'notification.status',
                        'notification.description:ntext',
                        //'url:ntext',
                        //'price',

                        // ['class' => 'yii\grid\ActionColumn'],
                    ],
                ]); ?>

            </div>
        </div>
    </div>
</div>
