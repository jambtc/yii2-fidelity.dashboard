<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\search\MerchantsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="merchants-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'id_user') ?>

    <?= $form->field($model, 'denomination') ?>

    <?= $form->field($model, 'tax_code') ?>

    <?= $form->field($model, 'address') ?>

    <?php // echo $form->field($model, 'cap') ?>

    <?php // echo $form->field($model, 'city') ?>

    <?php // echo $form->field($model, 'country') ?>

    <?php // echo $form->field($model, 'derivedKey') ?>

    <?php // echo $form->field($model, 'privateKey') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
