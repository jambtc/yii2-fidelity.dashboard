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
// $this->params['breadcrumbs'][] = $this->title;
?>
<div class="invoices-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <!-- <p>
        //Html::a(Yii::t('app', 'Create Invoices'), ['create'], ['class' => 'btn btn-success'])
    </p> -->


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'layout' => "{summary}\n{items}\n{pager}",
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
                                'class' => 'btn btn-success center-block text-truncate',
                                'style' => 'width: 150px;'
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
