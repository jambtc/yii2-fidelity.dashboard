<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;

use app\models\Users;
use app\components\Rows;
use app\components\WebApp;

if ($userRequestsProvider === null || $userRequestsProvider->getTotalCount() == 0)
    return true;

?>
<div class="card card-primary px-3">
    <div class="card-header border-transparent">
        <h3 class="card-title"><?= Yii::t('app','Subscriptions') ?></h3>
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
                'dataProvider' => $userRequestsProvider,
                // 'layout' => "{summary}\n{items}\n{pager}",
                'layout' => "{summary}\n{items}",
                'tableOptions' => ['class' => 'table m-0 table-striped'],
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    [
                        'attribute' => 'username',
                        'format' => 'raw',
                        'value' => function ($data) {
                            $id = WebApp::encrypt($data->id);
                            return Html::a($data->username, Url::toRoute(['/subscriptions/view', 'id' => $id]),
                                    [
                                        'class' => 'badge badge-primary center-block text-truncate',
                                        'style' => 'max-width: 250px;'
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
</div>
