<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;

use app\models\Users;
use app\components\Rows;
use app\components\WebApp;

if ($userRequestsProvider->getTotalCount() == 0)
    return true;

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
            [
                'attribute' => 'is_merchant',
                'format' => 'raw',
                'value' => function ($data) {
                    $status = [0=>Yii::t('app','Not Merchant'),1=>Yii::t('app','Is Merchant')];
                    return $status[$data->is_merchant];
                    },
            ],
            'first_name',
            'last_name',
            'email:email',
            'denomination',
        ],
    ]); ?>
    </div>
</div>
