<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap4\ActiveForm */
/* @var $model \frontend\models\ResetPasswordForm */

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;

$this->title = Yii::t('app','Reset password');
?>
<!-- Masthead-->
<header class="masthead w-100">
    <div class="container h-100">
        <div class="row align-items-center justify-content-center text-center">
            <div class="col-lg-6 align-self-end">
                <div class="card">
                    <div class="card-body login-card-body">
                        <p class="login-box-msg"><?= $this->title ?></p>
                        <p class="text-light"><?= Yii::t('app','Please choose your new password:') ?></p>
                        <?php $form = \yii\bootstrap4\ActiveForm::begin(['id' => 'login-form']) ?>

                        <?= $form->field($model, 'password', [
                            'options' => ['class' => 'form-group has-feedback'],
                            'inputTemplate' => '{input}<div class="input-group-append"><div class="input-group-text"><span class="fas fa-lock"></span></div></div>',
                            'template' => '{beginWrapper}{input}{error}{endWrapper}',
                            'wrapperOptions' => ['class' => 'input-group mb-3']
                        ])
                            ->label(false)
                            ->passwordInput(['placeholder' => $model->getAttributeLabel('password')]) ?>

                        <div class="row">
                            <div class="col-4">
                                <?= Html::submitButton('Confirm', ['class' => 'btn btn-primary btn-block']) ?>
                            </div>
                        </div>
                        <?php \yii\bootstrap4\ActiveForm::end(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
