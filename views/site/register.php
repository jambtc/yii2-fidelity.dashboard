<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
use yii\helpers\Url;
use yii\web\View;


$this->title = Yii::t('app','Register');;
?>

<div class="container-fluid h-100 justify-content-center align-items-center">
    <div class="card shadow-lg border">

        <div class="card-header">
            <h1><?= Html::encode($this->title) ?></h1>
        </div>
        <?php if (Yii::$app->session->hasFlash('registerFormSubmitted')): ?>
            <div class="card-body">
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
            <?php $form = ActiveForm::begin([
                'id' => 'register-form',
                'layout' => 'horizontal',
                'fieldConfig' => [
                    'template' => "{label}\n<div class=\"col-lg-12\">{input}</div>\n{error}\n<div class=\"col-lg-8\">{error}</div>",
                    'labelOptions' => ['class' => 'col-lg-6 control-label'],
                ],
            ]); ?>
            <div class="card-body">
                <div class="txt-left">
                    <?= $form->errorSummary($model, ['id' => 'error-summary','class'=>'col-lg-12']) ?>
                </div>

     			<fieldset class="border p-2">
                    <legend class="w-auto bg-warning p-2 rounded"><?= Yii::t('app','Account') ?></legend>
                    <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>
                    <?= $form->field($model, 'password')->passwordInput() ?>
                </fieldset>

                <fieldset class="border p-2">
                    <legend class="w-auto  bg-info p-2 rounded"><?= Yii::t('app','Personal information') ?></legend>
                    <?= $form->field($model, 'first_name')->textInput() ?>
                    <?= $form->field($model, 'last_name')->textInput() ?>
                    <?= $form->field($model, 'denomination')->textInput() ?>
                    <?= $form->field($model, 'tax_code')->textInput() ?>
                    <?= $form->field($model, 'address')->textInput() ?>
                    <?= $form->field($model, 'cap')->textInput() ?>
                    <?= $form->field($model, 'city')->textInput() ?>
                    <?= $form->field($model, 'country')->textInput() ?>
                </fieldset>
            </div>
            <div class="card-footer">
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
