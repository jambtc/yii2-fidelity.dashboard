<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\ReRequestsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Re Requests');
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
                    'columns' => [
                        // ['class' => 'yii\grid\SerialColumn'],

                        'id',
                        'timestamp:datetime',
                        'id_merchant',
                        'id_store',
                        'payload:ntext',
                        'sent',

                        // ['class' => 'yii\grid\ActionColumn'],
                    ],
                ]); ?>


            </div>
        </div>
    </div>
</div>
</div>
