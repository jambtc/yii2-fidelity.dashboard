<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;
use app\components\WebApp;
use app\models\Merchants;
use app\models\Stores;
/* @var $this yii\web\View */
/* @var $model app\models\Apikeys */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Apikeys'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="apikeys-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
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
                                'class' => 'badge badge-success center-block text-truncate',
                                'style' => 'max-width: 250px;'
                            ]
                        );
                    },
                'visible' => (Yii::$app->user->id == 1),
            ],
            // 'id_store',
            [
                'attribute' => 'id_store',
                'format' => 'raw',
                'value' => function ($data) {
                    $id = WebApp::encrypt($data->id_store);
                    $store = Stores::findOne($data->id_store);
                    return Html::a($store->denomination, Url::toRoute(['/stores/view', 'id' => $id]),
                            [
                                'class' => 'badge badge-success center-block text-truncate',
                                'style' => 'max-width: 250px;'
                            ]
                        );
                    },
            ],
            'denomination',
            'public_key',
            // 'secret_key',
        ],
    ]) ?>

</div>
