<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\Json;
use yii\web\View;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use app\models\Merchants;
use app\models\Stores;
use app\assets\ApikeysAsset;

/* @var $this yii\web\View */
/* @var $model app\models\Apikeys */
/* @var $form yii\widgets\ActiveForm */

$merchants = ArrayHelper::map(Merchants::find()->all(), 'id', 'denomination');
$merchants[0] = '';
asort($merchants);

if (Yii::$app->user->id == 1)
    $stores = [0=>''];
else
    $stores = ArrayHelper::map(Stores::find()->all(), 'id', 'denomination');


$options = [
    'spinner' => '<div class="button-spinner spinner-border text-primary" role="status"><span class="sr-only">Loading...</span></div>',
    'getStores' => Url::to(['/pos/stores-list']),
    'getApiKeys' => Url::to(['/apikeys/get-api-keys']),
];

$this->registerJs(
    "var yiiApiOptions = ".Json::htmlEncode($options).";",
    View::POS_HEAD,
    'yiiOptions'
);

ApikeysAsset::register($this);
?>

<div class="apikeys-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="txt-left">
        <?= $form->errorSummary($model, ['id' => 'error-summary','class'=>'col-lg-12']) ?>
    </div>

    <?php if (Yii::$app->user->id == 1): ?>
        <?= $form->field($model, 'id_merchant')->dropDownList($merchants) ?>
    <?php else: ?>
        <?= $form->field($model, 'id_merchant')->hiddenInput([
            'value' => Merchants::getIdByUser(Yii::$app->user->id)
            ])->label(false)
            ?>
    <?php endif; ?>

    <?= $form->field($model, 'id_store')->dropDownList($stores) ?>

    <?= $form->field($model, 'denomination')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'public_key')->textInput(['maxlength' => true, 'readonly'=>true]) ?>

    <?= $form->field($model, 'secret_key')->textInput(['maxlength' => true, 'readonly'=>true]) ?>
    <p class="alert alert-warning" id="last-chance" style="display:none;">
        <?= Yii::t('app','This is your only chance to copy the secret key, as it will no longer be shown.') ?>
    </p>

    <div class="form-group">
        <?= Html::Button(Yii::t('app', 'Generate keys'), ['class' => 'btn btn-warning', 'id' =>'btnApikeysCreate']) ?>
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
