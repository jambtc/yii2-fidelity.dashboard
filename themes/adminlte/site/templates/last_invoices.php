<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;

use app\models\Users;
use app\components\Rows;
use app\components\WebApp;

?>
<div class="card card-primary px-3">
    <div class="card-header border-transparent">
        <h3 class="card-title"><?= Yii::t('app','Latest Orders') ?></h3>

        <div class="card-tools">
          <button type="button" class="btn btn-tool" data-card-widget="collapse">
            <i class="fas fa-minus"></i>
          </button>
          <button type="button" class="btn btn-tool" data-card-widget="remove">
            <i class="fas fa-times"></i>
          </button>
        </div>
    </div>
    <!-- /.card-header -->
    <div class="card-body p-0">
        <div class="table-responsive">
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                // 'layout' => "{summary}\n{items}\n{pager}",
                'layout' => "{summary}\n{items}",
                'tableOptions' => ['class' => 'table m-0 table-striped'],
                // 'options' => [
                //     'class' => 'table m-0',
                // ],
                'columns' => [
                    //['class' => 'yii\grid\SerialColumn'],
                    //'id',
                    [
                        'attribute' => 'id',
                        'format' => 'raw',
                        'value' => function ($data) {
                            $id = WebApp::encrypt($data->id);
                            return Html::a($id, Url::toRoute(['/invoices/view', 'id' => $id]),
                                    [
                                        'class' => 'badge badge-success center-block text-break text-truncate',
                                        'style' => 'max-width: 110px;'
                                    ]
                                );
                            },
                    ],
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
                    'price',
                    'received',
                    //'id_pos',
                    'invoice_timestamp:datetime',
                    //'expiration_timestamp:datetime',
                    //'from_address',
                    //'to_address',
                    //'txhash',

                    ['class' => 'yii\grid\ActionColumn'],
                ],
            ]); ?>
        </div>
    </div>
    <!-- /.card-body -->
    <!-- <div class="card-footer clearfix">
    <a href="javascript:void(0)" class="btn btn-sm btn-info float-left">Place New Order</a>
    <a href="javascript:void(0)" class="btn btn-sm btn-secondary float-right">View All Orders</a>
    </div> -->
    <!-- /.card-footer -->
</div>
