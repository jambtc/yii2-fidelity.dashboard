<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\RulesEngines */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Rules Engines'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="row">
    <div class="col-md-12">
        <div class="card card-primary px-3">
            <div class="card-header border-transparent ">
                <h3 class="card-title "></h3>
                <?= Html::a('<button type="button" class="btn btn-success float-right">
                    <i class="fas fa-edit"></i> '. Yii::t('app', 'Update').'
                </button>', ['update','id' => $model->id]) ?>
            </div>
            <!-- /.card-header -->
            <div class="card-body p-0">
                <div class="table-responsive">
                <?= DetailView::widget([
                    'model' => $model,
                    'options' => ['class' => 'table table-sm m-0 table-striped'],
                    'attributes' => [
                        'url',
                        'public_key',
                        // 'secret_key',
                    ],
                ]) ?>
            </div>
            </div>
        </div>
    </div>
</div>
