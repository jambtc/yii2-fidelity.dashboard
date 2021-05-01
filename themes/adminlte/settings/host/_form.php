<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\components\WebApp;

/* @var $this yii\web\View */
/* @var $model app\models\Host */
/* @var $form yii\widgets\ActiveForm */
if (!$model->isNewRecord)
    $model->password = WebApp::decrypt($model->password);
?>

<div class="host-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'tcpip')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'user')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'password')->passwordInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
