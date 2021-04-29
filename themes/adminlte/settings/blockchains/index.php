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
        <div class="card card-primary px-3">
            <div class="card-header border-transparent ">
                <h3 class="card-title "><?= $this->title ?></h3>
                <?= Html::a('<button type="button" class="btn btn-success float-right">
                    <i class="fas fa-plus"></i> '. Yii::t('app', 'Add Blockchain').'
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
                        [
                            'attribute' => 'denomination',
                            'format' => 'raw',
                            'value' => function ($data) {
                                return Html::a($data->denomination, Url::toRoute(['view', 'id' => $data->id]));
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
</div>
