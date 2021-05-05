<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\components\WebApp;
use app\models\Users;

/* @var $this yii\web\View */
/* @var $model app\models\Merchants */

$this->title = Yii::t('app','Merchant id: ') . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Merchants'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="row">
    <div class="col-md-12">
        <div class="card card-primary px-3">
            <div class="card-header border-transparent ">
                <h3 class="card-title "><?= $this->title ?></h3>
                <?= Html::a('<button type="button" class="btn btn-success float-right">
                    <i class="fas fa-edit"></i> '. Yii::t('app', 'Update').'
                </button>', ['update','id' => WebApp::encrypt($model->id)]) ?>
            </div>
            <!-- /.card-header -->
            <div class="card-body p-0">
                <div class="table-responsive">


                <?= DetailView::widget([
                    'model' => $model,
                    'options' => ['class' => 'table table-sm m-0 table-striped'],
                    'attributes' => [
                        // 'id',
                        // 'id_user',
                        [
                            'attribute' => 'id_user',
                            'format' => 'raw',
                            'value' => function ($data) {
                                $user = Users::findOne($data->id_user);
                                return $user->username;
                            },
                        ],
                        'denomination',
                        'tax_code',
                        'address',
                        'cap',
                        'city',
                        'country',

                    ],
                ]) ?>
                </div>
            </div>
        </div>
    </div>
</div>
