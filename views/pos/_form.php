<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\Json;
use yii\web\View;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use app\models\Merchants;
use app\models\Stores;
use app\assets\PosAsset;



/* @var $this yii\web\View */
/* @var $model app\models\Pos */
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
];

$this->registerJs(
    "var yiiPosOptions = ".Json::htmlEncode($options).";",
    View::POS_HEAD,
    'yiiOptions'
);

PosAsset::register($this);

?>

<div class="pos-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="txt-left">
        <?= $form->errorSummary($model, ['id' => 'error-summary','class'=>'col-lg-12']) ?>
    </div>

    <?php if (Yii::$app->user->id == 1): ?>
        <?= $form->field($model, 'id_merchant')->dropDownList($merchants) ?>
    <?php endif; ?>

    <?= $form->field($model, 'id_store')->dropDownList($stores) ?>

    <?= $form->field($model, 'denomination')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'sin')->hiddenInput()->label(false) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
