<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Owner */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Owner'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <p>
                    <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
                </p>

                <?= DetailView::widget([
                    'model' => $model,
                    'attributes' => [
                        // 'id',
                        'owner',
                        'tax_code',
                        'address',
                        'cap',
                        'city',
                        'country',
                        'phone',
                        'email:email',
                        'dpo_officer',
                        'dpo_email:email',
                        'dpo_phone',
                    ],
                ]) ?>

            </div>
        </div>
    </div>
</div>
