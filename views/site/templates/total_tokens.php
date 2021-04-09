<?php
use app\models\Invoices;
use kartik\icons\Icon;
Icon::map($this);

$sum = Invoices::getTotal($dataProvider,'price');
?>
<!-- small box -->
<div class="small-box bg-success">
    <div class="inner">
        <h3><?= $sum ?></h3>
        <p>Token sent</p>
    </div>
    <div class="icon">
        <?= Icon::show('star') ?>
    </div>
    <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
</div>
