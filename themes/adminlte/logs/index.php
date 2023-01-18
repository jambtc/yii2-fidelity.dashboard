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
        <div class="card card-primary px-3">
            <div class="card-header border-transparent ">
                <h3 class="card-title "><?= $this->title ?></h3>

            </div>
            <!-- /.card-header -->
            <div class="card-body p-0">
                <div class="table-responsive">
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'layout' => "{summary}\n{items}\n{pager}",

                'tableOptions' => ['class' => 'table m-0 table-striped'],

                    'columns' => [
                        // ['class' => 'yii\grid\SerialColumn'],

                        'id',
                        [
                            'attribute' => 'timestamp',
                            'format' => 'raw',
                            'value' => function ($data) {
                                return Html::a(
                                    \Yii::$app->formatter->asDatetime($data->timestamp),
                                    Url::toRoute(['/logs/view', 'id' => $data->id]),
                                    [
                                        'class' => 'btn btn-success center-block text-truncate',
                                        // 'style' => 'max-width: 250px;'
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
                        // 'description:ntext',
                        [
                            'attribute' => 'description',
                            'format' => 'raw',
                            'value' => function ($data) {
                                return $data->description;
                            },
                            'contentOptions' => ['class' => 'text-primary'],

                        ],
                        'die',

                        // ['class' => 'yii\grid\ActionColumn'],
                    ],
                ]); ?>


            </div>
        </div>
    </div>
</div>
</div>
