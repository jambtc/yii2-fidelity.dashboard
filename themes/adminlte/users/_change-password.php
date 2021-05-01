<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Users */
/* @var $form yii\widgets\ActiveForm */
$model->password = '';
?>

<div class="users-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="txt-left">
        <?= $form->errorSummary($model, ['id' => 'error-summary','class'=>'col-lg-12 callout callout-danger']) ?>
    </div>

    <?= $form->field($model, 'password')->passwordInput(['autofocus' => true, 'maxlength' => true]) ?>


    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
