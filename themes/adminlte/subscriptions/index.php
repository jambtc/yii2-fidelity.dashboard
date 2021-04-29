<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use app\components\WebApp;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\UsersSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Subscriptions');
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
                'layout' => "{summary}\n{items}\n{pager}",
                'tableOptions' => ['class' => 'table m-0 table-striped'],

                    'columns' => [
                        //['class' => 'yii\grid\SerialColumn'],

                        //'id',
                        // 'username',
                        [
                            'attribute' => 'username',
                            'format' => 'raw',
                            'value' => function ($data) {
                                $id = WebApp::encrypt($data->id);
                                return Html::a($data->username, Url::toRoute(['/subscriptions/view', 'id' => $id]),
                                        [
                                            'class' => 'badge badge-success center-block text-truncate',
                                            'style' => 'max-width: 250px;'
                                        ]
                                    );
                                },
                        ],
                        //'password',
                        //'activation_code',
                        // 'status_activation_code',
                        [
                            'attribute' => 'status_activation_code',
                            'format' => 'raw',
                            'value' => function ($data) {
                                $status = [0=>Yii::t('app','Not active'),1=>Yii::t('app','Active')];
                                return $status[$data->status_activation_code];
                            },
                        ],
                        //'authKey',
                        //'accessToken',
                        'first_name',
                        'last_name',
                        'email:email',
                        // 'is_merchant',
                        [
                            'attribute' => 'is_merchant',
                            'format' => 'raw',
                            'value' => function ($data) {
                                $status = [0=>Yii::t('app','Not Merchant'),1=>Yii::t('app','Is Merchant')];
                                return $status[$data->is_merchant];
                                },
                        ],
                        'denomination',
                        //'tax_code',
                        //'address',
                        //'cap',
                        //'city',
                        //'country',

                        // ['class' => 'yii\grid\ActionColumn'],
                    ],
                ]); ?>


            </div>
        </div>
    </div>
</div>
</div>
