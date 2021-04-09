<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;

use app\models\Users;
use app\components\Rows;
use app\components\WebApp;

?>
<div class="card bg-secondary px-3">
    <div class="card-header border-transparent">
        <h3 class="card-title"><?= Yii::t('app','Subscriptions') ?></h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body p-0">

    <?= GridView::widget([
        'dataProvider' => $userRequestsProvider,
        // 'layout' => "{summary}\n{items}\n{pager}",
        'layout' => "{summary}\n{items}",
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'username',
                'format' => 'raw',
                'value' => function ($data) {
                    $id = WebApp::encrypt($data->id);
                    return Html::a($data->username, Url::toRoute(['/users/view', 'id' => $id]),
                            [
                                'class' => 'btn btn-success center-block text-truncate',
                                'style' => 'width: 150px;'
                            ]
                        );
                    },
            ],
            [
                'attribute' => 'status_activation_code',
                'format' => 'raw',
                'value' => function ($data) {
                    $status = [0=>Yii::t('app','Not active'),1=>Yii::t('app','Active')];
                    return $status[$data->status_activation_code];
                    },
            ],
            'first_name',
            'last_name',
            'email:email',
            'denomination',
        ],
    ]); ?>
    </div>
    <!-- /.card-body -->
    <!-- <div class="card-footer clearfix">
    <a href="javascript:void(0)" class="btn btn-sm btn-info float-left">Place New Order</a>
    <a href="javascript:void(0)" class="btn btn-sm btn-secondary float-right">View All Orders</a>
    </div> -->
    <!-- /.card-footer -->
</div>
