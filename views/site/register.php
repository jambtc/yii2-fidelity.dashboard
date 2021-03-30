<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
use yii\helpers\Url;
use yii\web\View;


$this->title = 'Register';




?>

<h1><?= Html::encode($this->title) ?></h1>
        <?php if (Yii::$app->session->hasFlash('registerFormSubmitted')): ?>

              <div class="alert alert-success">
                  <?php echo Yii::t('app','Your registration request has been registered.');?><br>
                  <?php echo Yii::t('app','You will receive an email to confirm your subscription.');?>
              </div>
              <div class="form-row txt-center text-light mt-15">
                  <?php echo Yii::t('app','Back to home!'); ?>
                 <a style="color:#007bff;" href="<?php echo Url::to(['site/index']); ?>" data-loader="show">Home</a>
              </div>



        <?php else: ?>
            <?php $form = ActiveForm::begin([
                'id' => 'register-form',
                'layout' => 'horizontal',
                'fieldConfig' => [
                    'template' => "{label}\n<div class=\"col-lg-12\">{input}</div>\n{error}\n<div class=\"col-lg-8\">{error}</div>",
                    'labelOptions' => ['class' => 'col-lg-6 control-label'],
                ],
            ]); ?>
            <?= $form->errorSummary($model, ['id' => 'error-summary','class'=>'col-lg-12']) ?>


 			<fieldset class="border p-2">
                <legend class="w-auto"><?= Yii::t('app','Account') ?></legend>


                <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>
                <?= $form->field($model, 'password')->passwordInput() ?>
            </fieldset>

            <fieldset class="border p-2">
                <legend class="w-auto"><?= Yii::t('app','Personal information') ?></legend>
                <?= $form->field($model, 'first_name')->textInput() ?>
                <?= $form->field($model, 'last_name')->textInput() ?>
                <?= $form->field($model, 'denomination')->textInput() ?>
                <?= $form->field($model, 'tax_code')->textInput() ?>
                <?= $form->field($model, 'address')->textInput() ?>
                <?= $form->field($model, 'cap')->textInput() ?>
                <?= $form->field($model, 'city')->textInput() ?>
                <?= $form->field($model, 'country')->textInput() ?>
            </fieldset>

            <div class="form-group">
                <div class="col-lg-offset-1 col-lg-11">
                    <?= Html::submitButton('Subscribe', ['class' => 'btn btn-primary', 'name' => 'subscribe-button']) ?>
                </div>
            </div>



        <?php ActiveForm::end(); ?>
        <?php endif; ?>
  </div>
</div>
