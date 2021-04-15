<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Blockchains */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Blockchains'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <p>
                    <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
                </p>

                <?= DetailView::widget([
                    'model' => $model,
                    'attributes' => [
                        // 'id',
                        // 'blockchain_denomination',
                        [
                            'attribute' => 'blockchain_denomination',
                            'type' => 'raw',
                            'value' => $model->blockchain_denomination,
                            'contentOptions' => ['style' => 'width:75%;']
                        ],
                        'invoice_expiration',
                        'smart_contract_address',
                        'chain_id',
                        'url_block_explorer:url',
                        // 'smart_contract_abi',
                        [
                            'attribute' => 'smart_contract_abi',
                            'type' => 'raw',
                            'value' => $model->smart_contract_abi,
                            'contentOptions' => ['class' => 'text-break']
                        ],
                        [
                            'attribute' => 'smart_contract_bytecode',
                            'type' => 'raw',
                            'value' => $model->smart_contract_bytecode,
                            'contentOptions' => ['class' => 'text-break']
                        ],
                        // 'smart_contract_bytecode',
                        'sealer_address',
                        // 'sealer_private_key',
                    ],
                ]) ?>

            </div>
        </div>
    </div>
</div>
