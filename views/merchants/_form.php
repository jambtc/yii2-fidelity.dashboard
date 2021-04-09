<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Merchants */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="merchants-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id')->hiddenInput(['maxlength' => true])->label(false) ?>

    <?= $form->field($model, 'denomination')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tax_code')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'address')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'cap')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'city')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'country')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'derivedKey')->textInput(['maxlength' => true]) ?>
    <div class="invalid-feedback alert alert-danger" id="seed-error" ></div>

    <?= $form->field($model, 'wallet_address')->hiddenInput(['maxlength' => true])->label(false) ?>
    <?= $form->field($model, 'privateKey')->hiddenInput(['maxlength' => true])->label(false) ?>

    <div class="form-group">
        <?= Html::Button(Yii::t('app', 'Confirm Seed'), ['class' => 'btn btn-info derivedKey']) ?>
    </div>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
