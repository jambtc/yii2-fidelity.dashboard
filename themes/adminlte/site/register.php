<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
use yii\helpers\Url;
use yii\web\View;


$this->title = Yii::t('app','Register');
?>
<!-- Masthead-->
<header class="masthead w-100">
    <div class="container h-100">
        <div class="row align-items-center justify-content-center text-center">
            <div class="col-lg-10 align-self-end">
                <div class="card">
                    <div class="card-header">
                        <h3><?= Html::encode($this->title) ?></h3>
                    </div>
                    <?php if (Yii::$app->session->hasFlash('registerFormSubmitted')): ?>
                        <div class="card-body login-card-body">
                            <div class="alert alert-success">
                                <?php echo Yii::t('app','Your registration request has been registered.');?><br>
                                <?php echo Yii::t('app','You will receive an email to confirm your subscription.');?>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="row">
                              <div class="col">
                                  <a style="color:#007bff;" href="<?php echo Url::to(['site/index']); ?>" data-loader="show">
                                      <?= Html::Button(Yii::t('app','Back to home!'), ['class' => 'btn btn-primary btn-block', 'name' => 'go-button']) ?>
                                 </a>
                              </div>
                              <!-- /.col -->
                            </div>
                        </div>
                    <?php else: ?>
                        <p class="login-box-msg"><?= Yii::t('app','Fill up all fields to register a new membership') ?></p>
                        <?php $form = \yii\bootstrap4\ActiveForm::begin(['id' => 'register-form']) ?>
                        <div class="card-body login-card-body">
                 			<fieldset class="border p-2">
                                <legend class="w-auto badge badge-warning p-2 rounded"><?= Yii::t('app','Account') ?></legend>
                                    <?= $form->field($model,'username', [
                                        'options' => ['class' => 'form-group has-feedback'],
                                        'inputTemplate' => '{input}<div class="input-group-append"><div class="input-group-text"><span class="fas fa-envelope"></span></div></div>',
                                        'template' => '{beginWrapper}{input}{error}{endWrapper}',
                                        'wrapperOptions' => ['class' => 'input-group mb-3'],
                                    ])
                                        ->label(false)
                                        ->textInput(['placeholder' => $model->getAttributeLabel('username')]) ?>

                                    <?= $form->field($model, 'password', [
                                        'options' => ['class' => 'form-group has-feedback'],
                                        'inputTemplate' => '{input}<div class="input-group-append"><div class="input-group-text"><span class="fas fa-lock"></span></div></div>',
                                        'template' => '{beginWrapper}{input}{error}{endWrapper}',
                                        'wrapperOptions' => ['class' => 'input-group mb-3']
                                    ])
                                        ->label(false)
                                        ->passwordInput(['placeholder' => $model->getAttributeLabel('password')]) ?>
                            </fieldset>

                            <fieldset class="border p-2">
                                <legend class="w-auto badge badge-info p-2 rounded"><?= Yii::t('app','Personal information') ?></legend>
                                <?= $form->field($model,'first_name', [
                                    'options' => ['class' => 'form-group has-feedback'],
                                    'inputTemplate' => '{input}<div class="input-group-append"><div class="input-group-text"><span class="fas fa-address-card"></span></div></div>',
                                    'template' => '{beginWrapper}{input}{error}{endWrapper}',
                                    'wrapperOptions' => ['class' => 'input-group mb-3'],
                                ])
                                    ->label(false)
                                    ->textInput(['placeholder' => $model->getAttributeLabel('first_name')]) ?>

                                <?= $form->field($model,'last_name', [
                                    'options' => ['class' => 'form-group has-feedback'],
                                    'inputTemplate' => '{input}<div class="input-group-append"><div class="input-group-text"><span class="fas fa-address-card"></span></div></div>',
                                    'template' => '{beginWrapper}{input}{error}{endWrapper}',
                                    'wrapperOptions' => ['class' => 'input-group mb-3'],
                                ])
                                    ->label(false)
                                    ->textInput(['placeholder' => $model->getAttributeLabel('last_name')]) ?>

                                <?= $form->field($model,'denomination', [
                                    'options' => ['class' => 'form-group has-feedback'],
                                    'inputTemplate' => '{input}<div class="input-group-append"><div class="input-group-text"><span class="fas fa-address-card"></div></div>',
                                    'template' => '{beginWrapper}{input}{error}{endWrapper}',
                                    'wrapperOptions' => ['class' => 'input-group mb-3'],
                                ])
                                    ->label(false)
                                    ->textInput(['placeholder' => $model->getAttributeLabel('denomination')]) ?>

                                <?= $form->field($model,'tax_code', [
                                    'options' => ['class' => 'form-group has-feedback'],
                                    'inputTemplate' => '{input}<div class="input-group-append"><div class="input-group-text"><span class="fas fa-address-card"></div></div>',
                                    'template' => '{beginWrapper}{input}{error}{endWrapper}',
                                    'wrapperOptions' => ['class' => 'input-group mb-3'],
                                ])
                                    ->label(false)
                                    ->textInput(['placeholder' => $model->getAttributeLabel('tax_code')]) ?>

                                <?= $form->field($model,'address', [
                                    'options' => ['class' => 'form-group has-feedback'],
                                    'inputTemplate' => '{input}<div class="input-group-append"><div class="input-group-text"><span class="fas fa-address-card"></div></div>',
                                    'template' => '{beginWrapper}{input}{error}{endWrapper}',
                                    'wrapperOptions' => ['class' => 'input-group mb-3'],
                                ])
                                    ->label(false)
                                    ->textInput(['placeholder' => $model->getAttributeLabel('address')]) ?>

                                    <?= $form->field($model,'cap', [
                                        'options' => ['class' => 'form-group has-feedback'],
                                        'inputTemplate' => '{input}<div class="input-group-append"><div class="input-group-text"><span class="fas fa-address-card"></div></div>',
                                        'template' => '{beginWrapper}{input}{error}{endWrapper}',
                                        'wrapperOptions' => ['class' => 'input-group mb-3'],
                                    ])
                                        ->label(false)
                                        ->textInput(['placeholder' => $model->getAttributeLabel('cap')]) ?>

                                    <?= $form->field($model,'city', [
                                        'options' => ['class' => 'form-group has-feedback'],
                                        'inputTemplate' => '{input}<div class="input-group-append"><div class="input-group-text"><span class="fas fa-address-card"></div></div>',
                                        'template' => '{beginWrapper}{input}{error}{endWrapper}',
                                        'wrapperOptions' => ['class' => 'input-group mb-3'],
                                    ])
                                        ->label(false)
                                        ->textInput(['placeholder' => $model->getAttributeLabel('city')]) ?>

                                    <?= $form->field($model,'country', [
                                        'options' => ['class' => 'form-group has-feedback'],
                                        'inputTemplate' => '{input}<div class="input-group-append"><div class="input-group-text"><span class="fas fa-address-card"></div></div>',
                                        'template' => '{beginWrapper}{input}{error}{endWrapper}',
                                        'wrapperOptions' => ['class' => 'input-group mb-3'],
                                    ])
                                        ->label(false)
                                        ->textInput(['placeholder' => $model->getAttributeLabel('country')]) ?>

                            </fieldset>
                        </div>
                        <div class="card-footer mb-3">
                            <div class="row">
                              <div class="col-8">
                                <div class="icheck-primary">
                                  <input type="checkbox" id="agreeTerms" name="terms" value="agree">
                                  <label for="agreeTerms">
                                   I agree to the <a href="#">terms</a>
                                  </label>
                                </div>
                              </div>
                              <!-- /.col -->
                              <div class="col">
                                  <?= Html::submitButton(Yii::t('app','Register'), ['class' => 'btn btn-primary btn-block', 'name' => 'register-button']) ?>
                              </div>
                              <!-- /.col -->
                            </div>
                        </div>
                        <?php ActiveForm::end(); ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</header>
