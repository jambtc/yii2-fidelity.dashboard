<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\BlockchainsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Blockchains');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">

                <p>
                    <?= Html::a(Yii::t('app', 'Create Blockchains'), ['create'], ['class' => 'btn btn-success']) ?>
                </p>

                <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    // 'filterModel' => $searchModel,
                    'tableOptions' => ['class' => 'table m-0 table-striped'],
                    'columns' => [
                        ['class' => 'yii\grid\SerialColumn'],

                        // 'id',
                        [
                            'attribute' => 'blockchain_denomination',
                            'format' => 'raw',
                            'value' => function ($data) {
                                return Html::a($data->blockchain_denomination, Url::toRoute(['view', 'id' => $data->id]));
                            },
                        ],
                        'invoice_expiration',
                        [
                            'attribute' => 'smart_contract_address',
                            'format' => 'raw',
                            'value' => function ($data) {
                                return $data->smart_contract_address;
                            },
                            'contentOptions' => ['class' => 'text-break'],
                        ],
                        // 'chain_id',
                        'url_block_explorer:url',
                        //'smart_contract_abi',
                        //'smart_contract_bytecode',
                        // 'sealer_address',
                        [
                            'attribute' => 'sealer_address',
                            'format' => 'raw',
                            'value' => function ($data) {
                                return $data->sealer_address;
                            },
                            'contentOptions' => ['class' => 'text-break'],
                        ],
                        //'sealer_private_key',

                        // ['class' => 'yii\grid\ActionColumn'],
                    ],
                ]); ?>


            </div>
        </div>
    </div>
</div>
