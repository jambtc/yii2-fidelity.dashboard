<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;
use app\components\WebApp;
use app\models\Merchants;

/* @var $this yii\web\View */
/* @var $model app\models\Stores */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Stores'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="stores-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
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
            'id',
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
                                'style' => 'max-width: 150px;'
                            ]
                        );
                    },
                'visible' => (Yii::$app->user->id == 1),
            ],
            'denomination',
            'bps_storeid',
        ],
    ]) ?>

</div>
