<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use app\components\WebApp;
use app\models\Merchants;
use app\models\Stores;
use app\models\Apikeys;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\ApikeysSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Apikeys');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="apikeys-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create Apikeys'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'id',
            // 'id_merchant',
            // 'id_store',
            [
                'attribute' => 'id_merchant',
                'format' => 'raw',
                'value' => function ($data) {
                    $id = WebApp::encrypt($data->id_merchant);
                    $merchant = Merchants::findOne($data->id_merchant);
                    return Html::a($merchant->denomination, Url::toRoute(['/merchants/view', 'id' => $id]),
                            [
                                'class' => 'btn btn-success center-block text-truncate',
                                'style' => 'max-width: 250px;'
                            ]
                        );
                    },
                'visible' => (Yii::$app->user->id == 1),
            ],
            [
                'attribute' => 'id_store',
                'format' => 'raw',
                'value' => function ($data) {
                    $id = WebApp::encrypt($data->id_store);
                    $store = Stores::findOne($data->id_store);
                    return Html::a($store->denomination, Url::toRoute(['/stores/view', 'id' => $id]),
                            [
                                'class' => 'btn btn-success center-block text-truncate',
                                'style' => 'max-width: 250px;'
                            ]
                        );
                    },
            ],
            // 'denomination',
            [
                'attribute' => 'denomination',
                'format' => 'raw',
                'value' => function ($data) {
                    $id = WebApp::encrypt($data->id);
                    $pos = Apikeys::findOne($data->id);
                    return Html::a($pos->denomination, Url::toRoute(['/apikeys/view', 'id' => $id]),
                            [
                                'class' => 'btn btn-success center-block text-truncate',
                                'style' => 'max-width: 250px;'
                            ]
                        );
                    },
            ],
            'public_key',
            //'secret_key',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
