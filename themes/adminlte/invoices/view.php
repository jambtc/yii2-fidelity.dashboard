<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

use app\components\WebApp;
use app\components\Rows;
use app\models\Users;

/* @var $this yii\web\View */
/* @var $model app\models\Invoices */

$id = WebApp::encrypt($model->id);

$this->title = $id;
// $this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Invoices'), 'url' => ['index']];
// $this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">


            <?= DetailView::widget([
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
                    'price',
                    'received',
                    'id_pos',
                    'invoice_timestamp:datetime',
                    'expiration_timestamp:datetime',
                    'from_address',
                    'to_address',
                    'txhash',
                ],
            ]) ?>

        </div>
    </div>
</div>
</div>
