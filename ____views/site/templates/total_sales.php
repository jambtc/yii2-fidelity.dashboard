<?php
use kartik\icons\Icon;
Icon::map($this);
?>

<!-- small box -->
<div class="small-box bg-info">
    <div class="inner">
        <h3><?= $dataProvider->totalCount ?></h3>
        <p>New Orders</p>
    </div>
    <div class="icon">
        <?= Icon::show('shopping-bag') ?>
    </div>
    <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
</div>
