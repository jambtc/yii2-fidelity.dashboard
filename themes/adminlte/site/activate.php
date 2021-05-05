<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
use yii\helpers\Url;
use yii\web\View;


$this->title = 'Activation';

?>
<!-- Masthead-->
<header class="masthead w-100">
    <div class="container h-100">
        <div class="row align-items-center justify-content-center text-center">
            <div class="col-lg-6 align-self-end">
                <div class="card">
                    <div class="card-header">
                        <h3><?= Html::encode($this->title) ?></h3>
                    </div>
                    <div class="card-body login-card-body">

                          <?php if (Yii::$app->session->hasFlash('dataOutdated')): ?>
                              <div class="alert alert-warning">
                                  <?php echo Yii::t('app','The registration time has expired.');?><br>
                                  <?php echo Yii::t('app','Maybe you have to register again.');?>
                              </div>
                                <div class="form-row txt-center text-light mt-15">
                                  <?php echo Yii::t('app','Please, repeat the registration.');?>
                                  <a class="btn btn-primary btn-block" href="<?php echo Url::to(['site/index']); ?>" data-loader="show">
                                      <?php echo Yii::t('app','Go home');?>
                                  </a>
                                </div>
                        <?php endif; ?>

                        <?php if (Yii::$app->session->hasFlash('dataNotSigned')): ?>
                            <div class="alert alert-warning">
                                <?php echo Yii::t('app','The registration data isn\'t valid.');?><br>
                                <?php echo Yii::t('app','Maybe you have to register again.');?>
                            </div>
                            <div class="form-row txt-center text-light mt-15">
                                <?php echo Yii::t('app','Please, repeat the registration.');?>
                                <a class="btn btn-primary btn-block" href="<?php echo Url::to(['site/index']); ?>" data-loader="show">
                                    <?php echo Yii::t('app','Go home');?>
                                </a>
                            </div>

                        <?php endif; ?>
                        <?php if (Yii::$app->session->hasFlash('userActived')): ?>

                            <div class="alert alert-success">
                                <?php echo Yii::t('app','You have registered your account successfully.');?><br>
                            </div>
                            <div class="form-row txt-center text-light mt-15">
                                <?php echo Yii::t('app','You can now login.');?>
                                <a class="btn btn-primary btn-block" href="<?php echo Url::to(['site/login']); ?>" data-loader="show">
                                    <?php echo Yii::t('app','Sign In');?>
                                </a>
                            </div>

                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
