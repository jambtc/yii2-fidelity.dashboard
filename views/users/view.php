<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\components\WebApp;

/* @var $this yii\web\View */
/* @var $model app\models\Users */

$this->title = Yii::t('app','User id: ') . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Users'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="users-view">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php if (Yii::$app->session->hasFlash('errorSubscription')): ?>

          <div class="alert alert-warning">
              <?= Yii::$app->session->getFlash('errorSubscription') ?>
          </div>


    <?php endif; ?>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => WebApp::encrypt($model->id)], ['class' => 'btn btn-primary']) ?>


        <?php if ($model->status_activation_code == 0) : ?>

            <?= Html::a(Yii::t('app', 'Make him merchant'), ['subscribe', 'id' => WebApp::encrypt($model->id)], [
                'class' => 'btn btn-warning',
                'data' => [
                    'confirm' => Yii::t('app', 'Are you sure you want to make a merchant this user?'),
                    'method' => 'post',
                ],
            ]) ?>

            <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => WebApp::encrypt($model->id)], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => Yii::t('app', 'Are you sure you want to delete this user?'),
                    'method' => 'post',
                ],
            ]) ?>
        <?php endif; ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'id',
            'username',
            // 'password',
            // 'activation_code',
            // 'status_activation_code',
            [
                'attribute' => 'status_activation_code',
                'format' => 'raw',
                'value' => function ($data) {
                    $status = [0=>Yii::t('app','Not active'),1=>Yii::t('app','Active')];
                    return $status[$data->status_activation_code];
                    },
            ],
            // 'authKey',
            // 'accessToken',
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
            'tax_code',
            'address',
            'cap',
            'city',
            'country',
        ],
    ]) ?>

</div>
