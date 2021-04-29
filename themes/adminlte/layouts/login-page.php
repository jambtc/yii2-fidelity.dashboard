<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\widgets\Alert;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap4\Nav;
use yii\bootstrap4\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\LandingAsset;
use app\assets\ServiceWorkerAsset;

LandingAsset::register($this);
ServiceWorkerAsset::register($this);
// \hail812\adminlte3\assets\AdminLteAsset::register($this);

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?php Yii::$app->language ?>">
    <head>
        <meta charset="<?php echo Yii::$app->charset ?>" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <!-- Manifest Progressive Web App -->
        <link rel="manifest" href="manifest.json">

        <meta name="description" content="" />
        <meta name="author" content="" />
        <title><?= Yii::$app->name ?> | <?= Yii::$app->controller->id ?></title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="landing-page/assets/favicon.ico" />
        <!-- Font Awesome icons (free version)-->
        <script src="https://use.fontawesome.com/releases/v5.15.3/js/all.js" crossorigin="anonymous"></script>

        <?php echo $this->head() ?>
    </head>
    <body id="page-top">
        <?php echo $this->beginBody(); ?>
        <!-- Navigation-->
        <nav class="navbar navbar-expand-lg navbar-light fixed-top py-3" id="mainNav">
            <div class="container">
                <a class="navbar-brand js-scroll-trigger" href="<?= Url::to(['/site/index']) ?>"><?= Yii::$app->name ?></a>
                <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
            </div>
        </nav>

        <?php echo $content ?>



        <!-- Footer-->
        <footer class="bg-light py-5">
            <div class="container">
                <div class="small text-center text-muted">
                    Copyright &copy;
                    <!-- This script automatically adds the current year to your website footer-->
                    <!-- (credit: https://updateyourfooter.com/)-->
                    <script>
                        document.write(new Date().getFullYear());
                    </script>
                    - <?= Yii::$app->params['company'] ?>
                </div>
            </div>
        </footer>

        <?php echo $this->endBody(); ?>

    </body>
</html>

<?php $this->endPage() ?>
