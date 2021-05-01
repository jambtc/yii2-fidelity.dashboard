<?php


/* @var $this yii\web\View */

?>
<div class="site-index">
    <div class="body-content">

        <div class="row">
            <div class="col-lg-4 col-4">
                <?= $this->render('templates/total_sales',['dataProvider'=>$dataProvider]); ?>
            </div>
            <div class="col-lg-4 col-4">
                <?= $this->render('templates/total_tokens',['dataProvider'=>$dataProvider]); ?>
            </div>
            <?php if (Yii::$app->user->id == 1): ?>
                <div class="col-lg-4 col-4">
                    <?= $this->render('templates/total_users',['dataProvider'=>$dataProvider]); ?>
                </div>
            <?php endif; ?>
        </div>
        <div class="row">
            <div class="col-lg-12 col-12 col">
                <?= $this->render('templates/last_invoices',['dataProvider'=>$dataProvider]); ?>
            </div>

            <?php if (Yii::$app->user->id == 1): ?>
                <div class="col-lg-12 col-12 col">
                    <?= $this->render('templates/users_requests',['userRequestsProvider'=>$userRequestsProvider]); ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>
