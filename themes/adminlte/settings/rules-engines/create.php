<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\RulesEngines */

$this->title = Yii::t('app', 'Create Rules Engines');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Rules Engines'), 'url' => ['index']];
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
