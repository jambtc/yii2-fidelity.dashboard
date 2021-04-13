<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;

$this->title = Yii::t('app','Login');
// $this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-login">
    <div class="card shadow-lg border">
        <?php $form = ActiveForm::begin([
            'id' => 'login-form',
            'layout' => 'horizontal',
            'fieldConfig' => [
                'template' => "{label}\n<div class=\"col-lg-4\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
                'labelOptions' => ['class' => 'col-lg-2 control-label'],
            ],
        ]); ?>
        <div class="card-header">
            <h1><?= Html::encode($this->title) ?></h1>
        </div>

        <div class="card-body">
            <p><?= Yii::t('app','Sign in to start your session') ?></p>

            <div class="txt-left">
                <?= $form->errorSummary($model, ['id' => 'error-summary','class'=>'col-lg-12']) ?>
            </div>

            <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>

            <?= $form->field($model, 'password')->passwordInput() ?>

        </div>
        <div class="card-footer">
            <?= Html::submitButton('Login', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
        </div>
        <?php ActiveForm::end(); ?>
    </div>
</div>
