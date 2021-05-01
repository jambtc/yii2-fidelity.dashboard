<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Vapid */

$this->title = Yii::t('app', 'Create Vapid');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Vapids'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
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
