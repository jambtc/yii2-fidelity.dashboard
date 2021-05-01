<?php

use yii\helpers\Html;
use app\components\WebApp;


/* @var $this yii\web\View */
/* @var $model app\models\Merchants */

$this->title = Yii::t('app', 'Update Merchant: {name}', [
    'name' => $model->id,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Merchants'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => WebApp::encrypt($model->id)]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');


?>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <?= $this->render('_form', [
                    'model' => $model,
                ]) ?>

            </div>
        </div>
    </div>
</div>
