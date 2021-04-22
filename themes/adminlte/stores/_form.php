<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use app\models\Merchants;
use app\models\Blockchains;
use app\components\WebApp;

/* @var $this yii\web\View */
/* @var $model app\models\Stores */
/* @var $form yii\widgets\ActiveForm */


if (Yii::$app->user->id == 1) {
    $merchants = ArrayHelper::map(Merchants::find()->all(), 'id', 'denomination');
} else {
    $merchants_id = Merchants::getIdByUser(Yii::$app->user->id);
}
$blockchains = ArrayHelper::map(Blockchains::find()->all(), 'id', 'denomination');

?>

<div class="stores-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="txt-left">
        <?= $form->errorSummary($model, ['id' => 'error-summary','class'=>'col-lg-12 callout callout-danger']) ?>
    </div>

    <?php if (Yii::$app->user->id == 1): ?>
        <?= $form->field($model, 'id_merchant')->dropDownList($merchants, ['options' => ['readonly' => !$model->isNewRecord]]) ?>
    <?php else: ?>

    <?= $form->field($model, 'id_merchant')->hiddenInput(['value' => $merchants_id])->label(false) ?>


    <?php endif; ?>

    <?= $form->field($model, 'id_blockchain')->dropDownList($blockchains, ['options' => ['readonly' => !$model->isNewRecord]]) ?>

    <?= $form->field($model, 'denomination')->textInput(['maxlength' => true]) ?>

    <?php
    if (!$model->isNewRecord){
        $model->derivedKey = WebApp::decrypt($model->derivedKey);
    }
    ?>

    <?= $form->field($model, 'derivedKey')->textInput(['maxlength' => true]) ?>
    <div class="invalid-feedback alert alert-danger" id="seed-error" ></div>

    <?= $form->field($model, 'wallet_address')->textInput(['maxlength' => true, 'readonly' => true]) ?>
    <?= $form->field($model, 'privateKey')->hiddenInput(['maxlength' => true])->label(false) ?>

    <div class="form-group">
        <?= Html::Button(Yii::t('app', 'Generate address'), ['class' => 'btn btn-warning btn-derivedKey']) ?>

        <?= Html::submitButton(Yii::t('app', 'Save'), [
            'class' => 'btn btn-success disabled',
            'disabled'=>'disabled',
            'id' => 'btn-save'
            ]) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
