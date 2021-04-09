<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\components\WebApp;
use app\models\Users;

/* @var $this yii\web\View */
/* @var $model app\models\Merchants */

$this->title = Yii::t('app','Merchant id: ') . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Merchants'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="merchants-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => WebApp::encrypt($model->id)], ['class' => 'btn btn-primary']) ?>

    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            // 'id',
            // 'id_user',
            [
                'attribute' => 'id_user',
                'format' => 'raw',
                'value' => function ($data) {
                    $user = Users::findOne($data->id_user);
                    return $user->username;
                },
            ],
            'denomination',
            'tax_code',
            'address',
            'cap',
            'city',
            'country',
            'wallet_address',
            // 'derivedKey',
            // 'privateKey',
        ],
    ]) ?>

</div>
