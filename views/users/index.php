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
<div class="users-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create Users'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'tableOptions' => ['class' => 'table w-auto small'],
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
                                'class' => 'btn btn-success center-block text-truncate',
                                'style' => 'width: 150px;'
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
            //'corporate',
            'denomination',
            //'tax_code',
            //'address',
            //'cap',
            //'city',
            //'country',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
