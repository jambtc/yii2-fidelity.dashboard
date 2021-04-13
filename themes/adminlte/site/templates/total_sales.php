<?php
use kartik\icons\Icon;
use yii\helpers\Url;

Icon::map($this);
?>

<!-- small box -->
<div class="small-box bg-info">
    <div class="inner">
        <h3><?= $dataProvider->totalCount ?></h3>
        <p><?= Yii::t('app','New Orders') ?></p>
    </div>
    <div class="icon">
        <?= Icon::show('shopping-bag') ?>
    </div>
    <a href="<?= Url::to(['invoices/index']) ?>" class="small-box-footer"><?= Yii::t('app','More info') ?> <i class="fas fa-arrow-circle-right"></i></a>
</div>
