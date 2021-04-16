<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\assets\ServiceWorkerAsset;

\hail812\adminlte3\assets\AdminLteAsset::register($this);
$this->registerCssFile('https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700');
$this->registerCssFile('https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css');
\hail812\adminlte3\assets\PluginAsset::register($this)->add(['fontawesome', 'icheck-bootstrap']);

ServiceWorkerAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?= Yii::$app->name ?> | <?= Yii::$app->controller->id ?></title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Manifest Progressive Web App -->
    <link rel="manifest" href="manifest.json">
    
    <?php $this->registerCsrfMetaTags() ?>
    <?php $this->head() ?>
</head>
<body class="hold-transition login-page">
<?php  $this->beginBody() ?>
<div class="login-box">
    <div class="login-logo">
        <a href="<?=Yii::$app->homeUrl?>">
            <div class="text-left">
                <img src="css/images/logo.png" alt="" width="60">
                <b><?= Yii::$app->name ?></b>
            </div>
        </a>
    </div>
    <!-- /.login-logo -->

    <?= $content ?>
</div>
<!-- /.login-box -->

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
