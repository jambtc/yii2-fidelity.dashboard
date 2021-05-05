<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\Json;
use yii\web\View;
use yii\widgets\ActiveForm;
use app\components\WebApp;
use app\assets\ApikeysAsset;


/* @var $this yii\web\View */
/* @var $model app\models\RulesEngines */
/* @var $form yii\widgets\ActiveForm */
if (!$model->isNewRecord)
    $model->secret_key = WebApp::decrypt($model->secret_key);


$options = [
    'controller' => 'rulesengines',
    'spinner' => '<div class="button-spinner spinner-border text-primary" role="status"><span class="sr-only">Loading...</span></div>',
    'getApiKeys' => Url::to(['/apikeys/get-api-keys']),
];

$this->registerJs(
    "var yiiApiOptions = ".Json::htmlEncode($options).";",
    View::POS_HEAD,
    'yiiOptions'
);

ApikeysAsset::register($this);
?>

<div class="rules-engines-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="txt-left">
        <?= $form->errorSummary($model, ['id' => 'error-summary','class'=>'col-lg-12 callout callout-danger']) ?>
    </div>

    <?= $form->field($model, 'url')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'public_key')->textInput(['maxlength' => true]) ?>


    <div  id="last-chance" style="display:none;">
        <?= $form->field($model, 'secret_key')->textInput(['maxlength' => true, 'readonly'=>true]) ?>
        <p class="alert alert-warning"><?= Yii::t('app','This is your only chance to copy the secret key, as it will no longer be shown.') ?></p>
    </div>

    <div class="form-group">
        <?= Html::Button(Yii::t('app', 'Generate keys'), ['class' => 'btn btn-warning', 'id' =>'btnApikeysCreate']) ?>
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
