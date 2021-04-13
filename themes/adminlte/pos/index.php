<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use app\components\WebApp;
use app\models\Merchants;
use app\models\Stores;
use app\models\Pos;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\PosSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Pos');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">

                <p>
                    <?= Html::a(Yii::t('app', 'Create Pos'), ['create'], ['class' => 'btn btn-success']) ?>
                </p>

                <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    'filterModel' => $searchModel,
                    'tableOptions' => ['class' => 'table m-0 table-striped'],
                    'columns' => [
                        ['class' => 'yii\grid\SerialColumn'],


                        [
                            'attribute' => 'denomination',
                            'format' => 'raw',
                            'value' => function ($data) {
                                $id = WebApp::encrypt($data->id);
                                $pos = Pos::findOne($data->id);
                                return Html::a($pos->denomination, Url::toRoute(['/pos/view', 'id' => $id]),
                                        [
                                            'class' => 'badge badge-success center-block text-truncate',
                                            'style' => 'max-width: 250px;'
                                        ]
                                    );
                                },
                        ],
                        'sin',
                        [
                            'attribute' => 'id_store',
                            'format' => 'raw',
                            'value' => function ($data) {
                                $id = WebApp::encrypt($data->id_store);
                                $store = Stores::findOne($data->id_store);
                                return Html::a($store->denomination, Url::toRoute(['/stores/view', 'id' => $id]),
                                        [
                                            'class' => 'badge badge-primary center-block text-truncate',
                                            'style' => 'max-width: 250px;'
                                        ]
                                    );
                                },
                        ],
                        [
                            'attribute' => 'id_merchant',
                            'format' => 'raw',
                            'value' => function ($data) {
                                $id = WebApp::encrypt($data->id_merchant);
                                $merchant = Merchants::findOne($data->id_merchant);
                                return Html::a($merchant->denomination, Url::toRoute(['/merchants/view', 'id' => $id]),
                                        [
                                            'class' => 'badge badge-primary center-block text-truncate',
                                            'style' => 'max-width: 250px;'
                                        ]
                                    );
                                },
                            'visible' => (Yii::$app->user->id == 1),
                        ],


                        // ['class' => 'yii\grid\ActionColumn'],
                    ],
                ]); ?>


            </div>
        </div>
    </div>
</div>
