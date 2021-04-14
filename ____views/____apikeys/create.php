<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Apikeys */

$this->title = Yii::t('app', 'Create Apikeys');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Apikeys'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="apikeys-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
