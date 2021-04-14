<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\widgets\Alert;
use yii\helpers\Html;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use app\assets\AdminLteAsset;

AppAsset::register($this);
AdminLteAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body class="da rk-mode">
<?php $this->beginBody() ?>

<div class="wrap">
    <?php echo $this->render('menu'); ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
    <footer class="footer">
        <strong>Copyright © <?= date('Y') ?> <a href="https://<?= Yii::$app->params['website'] ?>"><?= Yii::$app->params['company'] ?></a>.</strong>
        All rights reserved.
        <div class="float-right d-none d-sm-inline-block">
          <?= Yii::powered() ?>
        </div>
    </footer>
</div>




<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>