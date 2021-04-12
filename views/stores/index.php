<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use app\components\WebApp;
use app\models\Merchants;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\StoresSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Stores');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="stores-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create Store'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'id',
            // 'id_merchant',
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
            // 'denomination',
            [
                'attribute' => 'denomination',
                'format' => 'raw',
                'value' => function ($data) {
                    $id = WebApp::encrypt($data->id);
                    return Html::a($data->denomination, Url::toRoute(['/stores/view', 'id' => $id]),
                            [
                                'class' => 'btn btn-success center-block text-truncate',
                                'style' => 'max-width: 250px;'
                            ]
                        );
                    },
            ],
            'bps_storeid',

            //['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
