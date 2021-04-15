<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Blockchains */

$this->title = Yii::t('app', 'Create Blockchains');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Blockchains'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <?= $this->render('_form', [
                    'model' => $model,
                ]) ?>

            </div>
        </div>
    </div>
</div>
