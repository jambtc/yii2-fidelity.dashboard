<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\LogsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Logs');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">

                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    'filterModel' => $searchModel,
                    'tableOptions' => ['class' => 'table m-0 table-striped'],
                    'columns' => [
                        // ['class' => 'yii\grid\SerialColumn'],

                        'id',
                        [
                            'attribute' => 'timestamp',
                            'format' => 'raw',
                            'value' => function ($data) {
                                return Html::a(
                                    \Yii::$app->formatter->asDatetime($data->timestamp,'long'),
                                    Url::toRoute(['/logs/view', 'id' => $data->id]),
                                    [
                                        'class' => 'badge badge-success center-block text-truncate',
                                        'style' => 'max-width: 250px;'
                                    ]
                                    );
                                },
                        ],
                        // 'timestamp:datetime',
                        'id_user',
                        //'remote_address',
                        //'browser',
                        'app',
                        'controller',
                        'action',
                        'description:ntext',
                        'die',

                        // ['class' => 'yii\grid\ActionColumn'],
                    ],
                ]); ?>


            </div>
        </div>
    </div>
</div>
