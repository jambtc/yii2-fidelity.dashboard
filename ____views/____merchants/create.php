<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Merchants */

$this->title = Yii::t('app', 'Create Merchants');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Merchants'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="merchants-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
