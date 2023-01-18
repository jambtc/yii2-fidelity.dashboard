<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Logs */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Logs'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <?= DetailView::widget([
                    'model' => $model,
                    'attributes' => [
                        'id',
                        'timestamp',
                        'timestamp:datetime',
                        'id_user',
                        'remote_address',
                        'browser',
                        'app',
                        'controller',
                        'action',
                        // 'description:ntext',
                        [
                            'attribute' => 'description',
                            'format' => 'raw',
                            'value' => function ($data) {
                                return $data->description;
                            },
                            'contentOptions' => ['class' => 'text-primary'],

                        ],
                        'die',
                    ],
                ]) ?>

            </div>
        </div>
    </div>
</div>
