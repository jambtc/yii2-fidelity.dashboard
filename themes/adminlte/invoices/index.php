<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;

use app\models\Users;
use app\components\Rows;
use app\components\WebApp;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Invoices');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <div class="col-md-12">
        <div class="card card-primary px-3">
            <div class="card-header border-transparent ">
                <h3 class="card-title "><?= $this->title ?></h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body p-0">
                <div class="table-responsive">

            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'layout' => "{summary}\n{items}\n{pager}",
                'tableOptions' => ['class' => 'table m-0 table-striped'],
                // 'layout' => "{summary}\n{items}",
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
                    // ['class' => 'yii\grid\ActionColumn'],
                ],
            ]); ?>
        </div>
    </div>


            </div>
        </div>
    </div>
</div>
