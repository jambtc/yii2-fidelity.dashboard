<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use app\models\Merchants;

/* @var $this yii\web\View */
/* @var $model app\models\Stores */
/* @var $form yii\widgets\ActiveForm */

$items = ArrayHelper::map(Merchants::find()->all(), 'id', 'denomination');

?>

<div class="stores-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="txt-left">
        <?= $form->errorSummary($model, ['id' => 'error-summary','class'=>'col-lg-12']) ?>
    </div>

    <?php if (Yii::$app->user->id == 1): ?>
        <?= $form->field($model, 'id_merchant')->dropDownList($items) ?>
    <?php endif; ?>

    <?= $form->field($model, 'denomination')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
