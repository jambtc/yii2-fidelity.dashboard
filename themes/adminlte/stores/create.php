<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Stores */

$this->title = Yii::t('app', 'Create Stores');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Stores'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

include ('_js.php');
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
