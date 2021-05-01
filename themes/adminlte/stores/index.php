<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use app\components\WebApp;
use app\models\Merchants;
use app\models\Blockchains;
/* @var $this yii\web\View */
/* @var $searchModel app\models\search\StoresSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Stores');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <div class="col-md-12">
        <div class="card card-primary px-3">
            <div class="card-header border-transparent ">
                <h3 class="card-title "><?= $this->title ?></h3>
                <?= Html::a('<button type="button" class="btn btn-success float-right">
                    <i class="fas fa-plus"></i> '. Yii::t('app', 'Add Store').'
                </button>', ['create']) ?>
            </div>
            <!-- /.card-header -->
            <div class="card-body p-0">
                <div class="table-responsive">


            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'layout' => "{summary}\n{items}\n{pager}",
                'tableOptions' => ['class' => 'table m-0 table-striped'],
                    'columns' => [
                        ['class' => 'yii\grid\SerialColumn'],
                        // 'id',
                        // 'id_merchant',
                        // 'denomination',
                        [
                            'attribute' => 'denomination',
                            'format' => 'raw',
                            'value' => function ($data) {
                                $id = WebApp::encrypt($data->id);
                                return Html::a($data->denomination, Url::toRoute(['/stores/view', 'id' => $id]),
                                        [
                                            'class' => 'badge badge-success center-block text-break text-truncate',
                                            'style' => 'max-width: 110px;'
                                        ]
                                    );
                                },
                        ],
                        [
                            'attribute' => 'bps_storeid',
                            'format' => 'raw',
                            'value' => function ($data) {
                                return Html::tag('p', $data->bps_storeid,
                                        [
                                            'class' => 'center-block text-break text-truncate',
                                            'style' => 'max-width: 110px;'
                                        ]
                                    );
                                },
                        ],
                        [
                            'attribute' => 'wallet_address',
                            'format' => 'raw',
                            'value' => function ($data) {
                                return Html::tag('p', $data->wallet_address,
                                        [
                                            'class' => 'center-block text-break text-truncate',
                                            'style' => 'max-width: 110px;'
                                        ]
                                    );
                                },
                        ],
                        [
                            'attribute' => 'id_blockchain',
                            'format' => 'raw',
                            'value' => function ($data) {
                                $blockchain = Blockchains::findOne($data->id_blockchain);
                                return $blockchain->denomination;
                            },
                        ],
                        // 'derivedKey',
                        //'privateKey',
                        [
                            'attribute' => 'id_merchant',
                            'format' => 'raw',
                            'value' => function ($data) {
                                $id = WebApp::encrypt($data->id_merchant);
                                $merchant = Merchants::findOne($data->id_merchant);
                                return Html::a($merchant->denomination, Url::toRoute(['/merchants/view', 'id' => $id]),
                                        [
                                            'class' => 'badge badge-primary center-block text-break text-truncate',
                                            'style' => 'max-width: 110px;'
                                        ]
                                    );
                                },
                            'visible' => (Yii::$app->user->id == 1),
                        ],

                        //['class' => 'yii\grid\ActionColumn'],
                    ],
                ]); ?>


            </div>
        </div>
    </div>
</div>
</div>
