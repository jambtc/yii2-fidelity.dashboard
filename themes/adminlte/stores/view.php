<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;
use app\components\WebApp;
use app\models\Merchants;
use app\models\Blockchains;

/* @var $this yii\web\View */
/* @var $model app\models\Stores */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Stores'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
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
                                            'class' => 'badge badge-primary center-block text-truncate',
                                            'style' => 'max-width: 250px;'
                                        ]
                                    );
                                },
                            'visible' => (Yii::$app->user->id == 1),
                        ],
                        'denomination',
                        'bps_storeid',
                        'wallet_address',
                        [
                            'attribute' => 'id_blockchain',
                            'format' => 'raw',
                            'value' => function ($data) {
                                $blockchain = Blockchains::findOne($data->id_blockchain);
                                return $blockchain->denomination;
                            },
                        ],
                        // 'derivedKey',
                        // 'privateKey',
                    ],
                ]) ?>

            </div>
        </div>
    </div>
</div>
