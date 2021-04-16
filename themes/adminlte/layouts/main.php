<?php

/* @var $this \yii\web\View */
/* @var $content string */
use yii\helpers\Html;

\hail812\adminlte3\assets\FontAwesomeAsset::register($this);
\hail812\adminlte3\assets\AdminLteAsset::register($this);
$this->registerCssFile('https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback');

$assetDir = Yii::$app->assetManager->getPublishedUrl('@vendor/almasaeed2010/adminlte/dist');

$darkmode = null;
if (isset($_COOKIE['darkmode'])) {
    $cookie = \yii\helpers\Json::decode($_COOKIE['darkmode']);
    $darkmode = $cookie['body'];
}


app\assets\NotificationsAsset::register($this);
app\assets\ServiceWorkerAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Manifest Progressive Web App -->
    <link rel="manifest" href="manifest.json">

    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Yii::$app->name ?> | <?= Yii::$app->controller->id ?></title>
    <?php $this->head() ?>
</head>
<body class="<?= $darkmode ?> hold-transition sidebar-mini">
<?php $this->beginBody() ?>

<div class="wrapper">
    <!-- Navbar -->
    <?= $this->render('navbar', ['assetDir' => $assetDir]) ?>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <?= $this->render('sidebar', ['assetDir' => $assetDir]) ?>

    <div id="snackbar">
        <?= Yii::t('app','A new version of this app is available.'); ?>

            <?= Yii::t('app','Click'); ?>
            <a id="reload">
                <button type="button" class="btn btn-warning px-5">
                    <?= Yii::t('app','here') ?>
                </button>
            </a>
            <?= Yii::t('app',' to update.') ?>
        
    </div>

    <!-- Content Wrapper. Contains page content -->
    <?= $this->render('content', ['content' => $content, 'assetDir' => $assetDir]) ?>
    <!-- /.content-wrapper -->

    <!-- Control Sidebar -->
    <?= $this->render('control-sidebar') ?>
    <!-- /.control-sidebar -->

    <!-- Main Footer -->
    <?= $this->render('footer') ?>
</div>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
