<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\search\ApikeysSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="apikeys-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'id_merchant') ?>

    <?= $form->field($model, 'id_store') ?>

    <?= $form->field($model, 'denomination') ?>

    <?= $form->field($model, 'public_key') ?>

    <?php // echo $form->field($model, 'secret_key') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
