<?php
use app\models\Invoices;
use kartik\icons\Icon;
use yii\helpers\Url;

Icon::map($this);

$sum = Invoices::getTotal($dataProvider,'received');
?>
<!-- small box -->
<div class="small-box bg-success">
    <div class="inner">
        <h3><?= $sum ?></h3>
        <p><?= Yii::t('app','Tokens received') ?></p>
    </div>
    <div class="icon">
        <?= Icon::show('star') ?>
    </div>
    <a href="<?= Url::to(['invoices/index']) ?>" class="small-box-footer"><?= Yii::t('app','More info') ?> <i class="fas fa-arrow-circle-right"></i></a>
</div>
