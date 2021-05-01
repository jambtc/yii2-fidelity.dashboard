<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\PasswordResetRequestForm */

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;

$this->title = Yii::t('app','Request password reset');
?>
<!-- Masthead-->
<header class="masthead w-100">
    <div class="container h-100">
        <div class="row align-items-center justify-content-center text-center">
            <div class="col-lg-6 align-self-end">
                <div class="card">
                    <div class="card-body login-card-body">
                        <p class="login-box-msg"><?= $this->title ?></p>
                        <p class="text-light"><?= Yii::t('app','Please fill out your email. A link to reset password will be sent there.') ?></p>

                        <?php $form = \yii\bootstrap4\ActiveForm::begin(['id' => 'login-form']) ?>

                        <?= $form->field($model,'email', [
                            'options' => ['class' => 'form-group has-feedback'],
                            'inputTemplate' => '{input}<div class="input-group-append"><div class="input-group-text"><span class="fas fa-envelope"></span></div></div>',
                            'template' => '{beginWrapper}{input}{error}{endWrapper}',
                            'wrapperOptions' => ['class' => 'input-group mb-3'],
                        ])
                            ->label(false)
                            ->textInput(['placeholder' => $model->getAttributeLabel('email')]) ?>

                        <div class="row">
                            <div class="col-4">
                                <?= Html::submitButton('Request', ['class' => 'btn btn-primary btn-block']) ?>
                            </div>
                        </div>

                        <?php \yii\bootstrap4\ActiveForm::end(); ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
