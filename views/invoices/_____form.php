<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Invoices */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="invoices-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_user')->textInput() ?>

    <?= $form->field($model, 'status')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'price')->textInput() ?>

    <?= $form->field($model, 'received')->textInput() ?>

    <?= $form->field($model, 'id_pos')->textInput() ?>

    <?= $form->field($model, 'invoice_timestamp')->textInput() ?>

    <?= $form->field($model, 'expiration_timestamp')->textInput() ?>

    <?= $form->field($model, 'from_address')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'to_address')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'txhash')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
