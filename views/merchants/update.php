<?php

use yii\helpers\Html;
use app\components\WebApp;
use app\assets\LightWalletAsset;

LightWalletAsset::register($this);

/* @var $this yii\web\View */
/* @var $model app\models\Merchants */

$this->title = Yii::t('app', 'Update Merchant: {name}', [
    'name' => $model->id,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Merchants'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => WebApp::encrypt($model->id)]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');

include ('_js.php');



?>
<div class="merchants-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
