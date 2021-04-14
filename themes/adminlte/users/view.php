<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\components\WebApp;

/* @var $this yii\web\View */
/* @var $model app\models\Users */

$this->title = Yii::t('app','User id: ') . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Users'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>

<div class="row">
    <div class="col-md-12">
        <div class="card card-primary card-outline">
            <div class="card-body box-profile">
                <?php if (Yii::$app->session->hasFlash('errorSubscription')): ?>
                      <div class="alert alert-warning">
                          <?= Yii::$app->session->getFlash('errorSubscription') ?>
                      </div>
                <?php endif; ?>


                <div class="text-center">
                  <img class="profile-user-img img-fluid img-circle" src="css/images/anonymous.png" alt="User profile picture">
                </div>
                <h3 class="profile-username text-center"><?= $model->first_name .' '. $model->last_name ?></h3>
                <p class="text-muted text-center"><?= $model->username ?></p>
            </div>
        </div>

        <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">About Me</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                  <div class="row">
                    <strong><i class="fas fa-book mr-1"></i> Status</strong>

                    <?php
                        $status = [0=>Yii::t('app','Not active'),1=>Yii::t('app','Active')];
                        $merchant = [0=>Yii::t('app','Not merchant'),1=>Yii::t('app','Merchant')];
                        $color = [0=>'warning',1=>'success'];


                        //echo Yii::t('app','Account status is: '). $status[$model->status_activation_code];
                    ?>
                    <div class="col-md-3 col-sm-6 col-12">
                        <div class="info-box shadow-sm">
                            <span class="info-box-icon bg-<?= $color[$model->status_activation_code] ?>"><i class="far fa-flag"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text"><?= Yii::t('app','Account status') ?></span>
                                <span class="info-box-number"><?= $status[$model->status_activation_code] ?></span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                    <div class="col-md-3 col-sm-6 col-12">
                        <div class="info-box shadow-sm">
                            <span class="info-box-icon bg-<?= $color[$model->is_merchant] ?>"><i class="far fa-flag"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text"><?= Yii::t('app','User account') ?></span>
                                <span class="info-box-number"><?= $merchant[$model->is_merchant] ?></span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                </div>

                <hr>

                <strong><i class="fas fa-pencil-alt mr-1"></i> <?= Yii::t('app','Denomination') ?></strong>
                <p class="text-muted"><?= $model->denomination ?></p>
                <hr>

                <strong><i class="fas fa-map-marker-alt mr-1"></i> <?= Yii::t('app','Location') ?></strong>

                <p class="text-muted"><?= $model->address ?>, <?= $model->city ?> (<?= $model->country ?>)</p>

                 <hr>

                <!--<strong><i class="fas fa-pencil-alt mr-1"></i> Skills</strong>

                <p class="text-muted">
                  <span class="tag tag-danger">UI Design</span>
                  <span class="tag tag-success">Coding</span>
                  <span class="tag tag-info">Javascript</span>
                  <span class="tag tag-warning">PHP</span>
                  <span class="tag tag-primary">Node.js</span>
                </p>

                <hr>

                <strong><i class="far fa-file-alt mr-1"></i> Notes</strong>

                <p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam fermentum enim neque.</p> -->





                <p>
                    <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => WebApp::encrypt($model->id)], ['class' => 'btn btn-primary']) ?>

                    <?php if ( (Yii::$app->user->id == 1 && $model->id == 1) || Yii::$app->user->id > 1) { ?>
                        <?= Html::a(Yii::t('app', 'Change password'), ['change-password', 'id' => WebApp::encrypt($model->id)], ['class' => 'btn btn-warning']) ?>
                    <?php } ?>

                    <?php if ($model->id != 1 && $model->is_merchant == 0 && Yii::$app->user->id == 1) : ?>
                        <?= Html::a(Yii::t('app', 'Make him merchant'), ['subscribe', 'id' => WebApp::encrypt($model->id)], [
                            'class' => 'btn btn-warning',
                            'data' => [
                                'confirm' => Yii::t('app', 'Are you sure you want to make a merchant this user?'),
                                'method' => 'post',
                            ],
                        ]) ?>
                    <?php endif; ?>
                    <?php if ($model->status_activation_code == 0) : ?>
                        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => WebApp::encrypt($model->id)], [
                            'class' => 'btn btn-danger',
                            'data' => [
                                'confirm' => Yii::t('app', 'Are you sure you want to delete this user?'),
                                'method' => 'post',
                            ],
                        ]) ?>
                    <?php endif; ?>
                </p>

            </div>
        </div>
    </div>
</div>
