<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

use app\components\WebApp;
use app\components\Rows;
use app\models\Users;
use app\models\Pos;

/* @var $this yii\web\View */
/* @var $model app\models\Invoices */

$id = WebApp::encrypt($model->id);

$this->title = $id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Invoices'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">

            <div class="callout callout-info">
              <h5><i class="fas fa-info"></i> <?= Yii::t('app','Invoices id:') ?></h5>
              <?= $this->title ?>
            </div>

            <div class="invoice p-3 mb-3">
                <div class="row">
                    <div class="col-12">
                      <h4>
                        <i class="fas fa-star"></i> <?= Yii::$app->name ?>
                        <small class="float-right"><?= $model->getAttributeLabel('invoice_timestamp') ?>: <?= \Yii::$app->formatter->asDatetime($model->invoice_timestamp) ?></small>
                      </h4>
                    </div>
                    <!-- /.col -->
                </div>
                <div class="row invoice-info">
                    <div class="col-sm-4 invoice-col">
                        <b><?= $model->getAttributeLabel('from_address') ?></b>
                        <address>
                            <?= $model->from_address ?>
                        </address>
                    </div>
                    <div class="col-sm-4 invoice-col">
                        <b><?= $model->getAttributeLabel('to_address') ?></b>
                        <address>
                            <?= $model->to_address ?>
                        </address>
                    </div>
                    <div class="col-sm-4 invoice-col">
                        <b>POS:</b> <?php
                            $pos = Pos::find()->andWhere(['id' => $model->id_pos])->one();
                            echo $pos->denomination;
                            ?><br>
                        <b><?= Yii::t('app','Payment Due:')?></b> <?= \Yii::$app->formatter->asDatetime($model->expiration_timestamp) ?><br>
                    </div>
                </div>

                <div class="row">
                <!-- accepted payments column -->
                    <div class="col-6">
                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th style="width:25%"><?= $model->getAttributeLabel('price') ?>:</th>
                                        <td><?= $model->price ?></td>
                                    </tr>
                                    <tr>
                                        <th><?= $model->getAttributeLabel('received') ?>:</th>
                                        <td><?= $model->received ?></td>
                                    </tr>
                                    <tr>
                                        <th><?= $model->getAttributeLabel('txhash') ?>:</th>
                                        <td class="text-break"><?= $model->txhash ?></td>
                                    </tr>
                                    <tr>
                                        <th><?= $model->getAttributeLabel('message') ?>:</th>
                                        <td class="text-break"><?= $model->message ?></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- /.col -->
                    <?php $color = Rows::statuscolor($model->status); ?>
                    <div class="col-6 callout callout-<?= $color ?>">
                        <p class="lead"><?= $model->getAttributeLabel('status') ?>:</p>

                        <p class="text-muted well well-sm shadow-none" style="margin-top: 10px;">
                            <button class="btn btn-block bg-gradient-<?= $color ?> text-capitalize"> <?= $model->status ?></button>
                        </p>
                    </div>
                </div>

            </div>

            <!-- <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    //'id',
                    //'id_user',
                    [
                        'attribute' => 'id_user',
                        'format' => 'raw',
                        'value' => function ($data) {
                            return Users::find()
                                ->andWhere(['id'=>$data->id_user])
                                ->one()->denomination;
                        },
                        'visible' => (Yii::$app->user->id == 1) ? true : false,
                    ],
                    //'status',
                    [
                        'attribute' => 'status',
                        'format' => 'raw',
                        'value' => function ($data) {
                            $color = Rows::statuscolor($data->status);
                            $row = '<span class="badge badge-'.$color.'">'.$data->status.'</span>';
                            return $row;
                        },
                    ],
                ],
            ]) ?> -->

        </div>
    </div>
</div>
</div>
