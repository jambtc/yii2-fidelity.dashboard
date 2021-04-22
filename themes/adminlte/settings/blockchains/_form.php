<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\components\WebApp;

/* @var $this yii\web\View */
/* @var $model app\models\Blockchains */
/* @var $form yii\widgets\ActiveForm */
if (!$model->isNewRecord)
    $model->sealer_private_key = WebApp::decrypt($model->sealer_private_key);
?>

<div class="blockchains-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'denomination')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'invoice_expiration')->textInput() ?>

    <?= $form->field($model, 'smart_contract_address')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'decimals')->textInput([
                                 'type' => 'number',
                                 'maxlength' => true
                            ]) ?>

    <?= $form->field($model, 'chain_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'url_block_explorer')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'smart_contract_abi')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'smart_contract_bytecode')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'sealer_address')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'sealer_private_key')->passwordInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
