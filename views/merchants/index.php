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
<div class="merchants-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
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
                                'class' => 'btn btn-success center-block text-truncate',
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
