<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\components\WebApp;

/* @var $this yii\web\View */
/* @var $model app\models\Vapid */
/* @var $form yii\widgets\ActiveForm */
if (!$model->isNewRecord)
    $model->secret_key = WebApp::decrypt($model->secret_key);
?>

<div class="vapid-form">
    <p>
        <?= Yii::t('app','You can get Vapid keys at this url: ') ?>
        <a href="https://d3v.one/vapid-key-generator" target="_blank">https://d3v.one/vapid-key-generator</a>
    </p>

    <?php $form = ActiveForm::begin(); ?>

    <div class="txt-left">
        <?= $form->errorSummary($model, ['id' => 'error-summary','class'=>'col-lg-12 callout callout-danger']) ?>
    </div>

    <?= $form->field($model, 'public_key')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'secret_key')->passwordInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
