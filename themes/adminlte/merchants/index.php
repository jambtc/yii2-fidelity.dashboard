<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use app\components\WebApp;
use app\models\Users;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\MerchantsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Merchants');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    'filterModel' => $searchModel,
                    'tableOptions' => ['class' => 'table m-0 table-striped'],
                    'columns' => [
                        ['class' => 'yii\grid\SerialColumn'],

                        //'id',
                        // 'id_user',
                        [
                            'attribute' => 'id_user',
                            'format' => 'raw',
                            'value' => function ($data) {
                                $id = WebApp::encrypt($data->id);
                                $user = Users::findOne($data->id_user);
                                return Html::a($user->username, Url::toRoute(['/merchants/view', 'id' => $id]),
                                        [
                                            'class' => 'badge badge-primary center-block text-truncate',
                                            'style' => 'max-width: 250px;'
                                        ]
                                    );
                                },
                        ],
                        'denomination',
                        // 'tax_code',
                        // 'address',
                        //'cap',
                        //'city',
                        //'country',


                        // ['class' => 'yii\grid\ActionColumn'],
                    ],
                ]); ?>


            </div>
        </div>
    </div>
</div>
