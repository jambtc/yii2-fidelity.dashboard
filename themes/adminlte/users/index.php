<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use app\components\WebApp;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\UsersSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Users');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">

                <p>
                    <?= Html::a(Yii::t('app', 'Create Users'), ['create'], ['class' => 'btn btn-success']) ?>
                </p>

                <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    'filterModel' => $searchModel,
                    'tableOptions' => ['class' => 'table m-0 table-striped'],
                    'columns' => [
                        //['class' => 'yii\grid\SerialColumn'],

                        //'id',
                        // 'username',
                        [
                            'attribute' => 'username',
                            'format' => 'raw',
                            'value' => function ($data) {
                                $id = WebApp::encrypt($data->id);
                                return Html::a($data->username, Url::toRoute(['/users/view', 'id' => $id]),
                                        [
                                            'class' => 'badge badge-success center-block text-truncate',
                                            'style' => 'max-width: 250px;'
                                        ]
                                    );
                                },
                        ],
                        //'password',
                        //'activation_code',
                        // 'status_activation_code',
                        [
                            'attribute' => 'status_activation_code',
                            'format' => 'raw',
                            'value' => function ($data) {
                                $status = [0=>Yii::t('app','Not active'),1=>Yii::t('app','Active')];
                                return $status[$data->status_activation_code];
                            },
                        ],
                        //'authKey',
                        //'accessToken',
                        'first_name',
                        'last_name',
                        'email:email',
                        // 'is_merchant',
                        [
                            'attribute' => 'is_merchant',
                            'format' => 'raw',
                            'value' => function ($data) {
                                $status = [0=>Yii::t('app','Not Merchant'),1=>Yii::t('app','Is Merchant')];
                                return $status[$data->is_merchant];
                                },
                        ],
                        'denomination',
                        //'tax_code',
                        //'address',
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
