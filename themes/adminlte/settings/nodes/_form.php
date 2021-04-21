<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use app\models\Blockchains;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Nodes */
/* @var $form yii\widgets\ActiveForm */
$blockchains = ArrayHelper::map(Blockchains::find()->all(), 'id', 'denomination');

?>

<div class="nodes-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="txt-left">
        <?= $form->errorSummary($model, ['id' => 'error-summary','class'=>'col-lg-12 callout callout-danger']) ?>
    </div>

    <?= $form->field($model, 'id_blockchain')->dropDownList($blockchains, ['options' => ['readonly' => !$model->isNewRecord]]) ?>

    <?= $form->field($model, 'url')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'port')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
