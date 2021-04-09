<?php


/* @var $this yii\web\View */

?>
<div class="site-index">
    <div class="body-content">

        <div class="row">
            <div class="col-lg-3 col-6">
                <?= $this->render('templates/total_sales',['dataProvider'=>$dataProvider]); ?>
            </div>
            <div class="col-lg-3 col-6">
                <?= $this->render('templates/total_tokens',['dataProvider'=>$dataProvider]); ?>
            </div>
        </div>
        <div class="row">
            <?= $this->render('templates/last_invoices',['dataProvider'=>$dataProvider]); ?>
        </div>
        <div class="row">
            <?= $this->render('templates/users_requests',['userRequestsProvider'=>$userRequestsProvider]); ?>
        </div>
    </div>
</div>
