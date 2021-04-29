<?php
use yii\helpers\Url;
use app\components\Settings;

$owner = Settings::owner();
?>

<!-- Masthead-->
<header class="masthead w-100">
    <div class="container h-100">
        <div class="row h-100 align-items-center justify-content-center text-center">
            <div class="col-lg-10 align-self-end">
                <h1 class="text-uppercase text-white font-weight-bold"><?= Yii::t('app','Blockchain based fidelity program') ?></h1>
                <hr class="divider my-4" />
            </div>
            <div class="col-lg-8 align-self-baseline">
                <p class="text-white-75 font-weight-light mb-5"><?= Yii::t('app','The blockchain is an efficient way to manage retail and fidelity programs. It tends indeed to make these systems cheaper and more secure.') ?></p>
                <a class="btn btn-primary btn-xl js-scroll-trigger" href="#about">Find Out More</a>
            </div>
        </div>
    </div>
</header>
<!-- About-->
<section class="page-section bg-primary w-100" id="about">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 text-center">
                <h2 class="text-white mt-0"><?= Yii::t('app','Blockchain services for <h2>Your Business</h2>') ?></h2>
                <hr class="divider light my-4" />
                <p class="text-white-50 mb-4">
                    <?= Yii::t('app','{company} offers cutting-edge solutions and consulting to create new Blockchain oriented applications. Through the use of innovative methodologies – especially Agile framework – and constant research we have built a structured approach, the result of national experiences and an international network. We build payment systems and blockchain-based data management to rationalize costs, improve processes and significantly increase production.</br>This is our world, this is {company}.', ['company' => Yii::$app->params['company']]) ?>
                </p>
                <a class="btn btn-light btn-xl js-scroll-trigger" href="<?= Url::to(['/site/login']) ?>"><?= Yii::t('app','Sign in') ?></a>
            </div>
        </div>
    </div>
</section>
<!-- Services-->
<section class="page-section w-100" id="services">
    <div class="container">
        <h2 class="text-center mt-0">At Your Service</h2>
        <hr class="divider my-4" />
        <div class="row">
            <div class="col-lg-3 col-md-6 text-center">
                <div class="mt-5">
                    <i class="fas fa-4x fa-gem text-primary mb-4"></i>
                    <h3 class="h4 mb-2">Sturdy Themes</h3>
                    <p class="text-muted mb-0">Our themes are updated regularly to keep them bug free!</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 text-center">
                <div class="mt-5">
                    <i class="fas fa-4x fa-laptop-code text-primary mb-4"></i>
                    <h3 class="h4 mb-2">Up to Date</h3>
                    <p class="text-muted mb-0">All dependencies are kept current to keep things fresh.</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 text-center">
                <div class="mt-5">
                    <i class="fas fa-4x fa-globe text-primary mb-4"></i>
                    <h3 class="h4 mb-2">Ready to Publish</h3>
                    <p class="text-muted mb-0">You can use this design as is, or you can make changes!</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 text-center">
                <div class="mt-5">
                    <i class="fas fa-4x fa-heart text-primary mb-4"></i>
                    <h3 class="h4 mb-2">Made with Love</h3>
                    <p class="text-muted mb-0">Is it really open source if it's not made with love?</p>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Portfolio-->
<div id="portfolio">
    <div class="container-fluid p-0">
        <div class="row no-gutters">
            <div class="col-lg-4 col-sm-6">
                <a class="portfolio-box" href="landing-page/assets/img/portfolio/fullsize/1.jpg">
                    <img class="img-fluid" src="landing-page/assets/img/portfolio/thumbnails/1.jpg" alt="..." />
                    <div class="portfolio-box-caption">
                        <div class="project-category text-white-50">Category</div>
                        <div class="project-name">Project Name</div>
                    </div>
                </a>
            </div>
            <div class="col-lg-4 col-sm-6">
                <a class="portfolio-box" href="landing-page/assets/img/portfolio/fullsize/2.jpg">
                    <img class="img-fluid" src="landing-page/assets/img/portfolio/thumbnails/2.jpg" alt="..." />
                    <div class="portfolio-box-caption">
                        <div class="project-category text-white-50">Category</div>
                        <div class="project-name">Project Name</div>
                    </div>
                </a>
            </div>
            <div class="col-lg-4 col-sm-6">
                <a class="portfolio-box" href="landing-page/assets/img/portfolio/fullsize/3.jpg">
                    <img class="img-fluid" src="landing-page/assets/img/portfolio/thumbnails/3.jpg" alt="..." />
                    <div class="portfolio-box-caption">
                        <div class="project-category text-white-50">Category</div>
                        <div class="project-name">Project Name</div>
                    </div>
                </a>
            </div>
            <div class="col-lg-4 col-sm-6">
                <a class="portfolio-box" href="landing-page/assets/img/portfolio/fullsize/4.jpg">
                    <img class="img-fluid" src="landing-page/assets/img/portfolio/thumbnails/4.jpg" alt="..." />
                    <div class="portfolio-box-caption">
                        <div class="project-category text-white-50">Category</div>
                        <div class="project-name">Project Name</div>
                    </div>
                </a>
            </div>
            <div class="col-lg-4 col-sm-6">
                <a class="portfolio-box" href="landing-page/assets/img/portfolio/fullsize/5.jpg">
                    <img class="img-fluid" src="landing-page/assets/img/portfolio/thumbnails/5.jpg" alt="..." />
                    <div class="portfolio-box-caption">
                        <div class="project-category text-white-50">Category</div>
                        <div class="project-name">Project Name</div>
                    </div>
                </a>
            </div>
            <div class="col-lg-4 col-sm-6">
                <a class="portfolio-box" href="landing-page/assets/img/portfolio/fullsize/6.jpg">
                    <img class="img-fluid" src="landing-page/assets/img/portfolio/thumbnails/6.jpg" alt="..." />
                    <div class="portfolio-box-caption p-3">
                        <div class="project-category text-white-50">Category</div>
                        <div class="project-name">Project Name</div>
                    </div>
                </a>
            </div>
        </div>
    </div>
</div>
<!-- Call to action-->
<section class="page-section bg-dark text-white w-100">
    <div class="container text-center">
        <h2 class="mb-4"><?= Yii::t('app','Change language') ?></h2>
        <?= app\components\languageSwitcher::Widget() ?>
    </div>
</section>
<!-- Contact-->
<section class="page-section w-100" id="contact">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 text-center">
                <h2 class="mt-0">Let's Get In Touch!</h2>
                <hr class="divider my-4" />
                <p class="text-muted mb-5">Ready to start your next project with us? Give us a call or send us an email and we will get back to you as soon as possible!</p>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4 ml-auto text-center mb-5 mb-lg-0">
                <i class="fas fa-phone fa-3x mb-3 text-muted"></i>
                <div>
                    <?= isset($owner->phone) ? $owner->phone : '+1 (555) 123-4567' ?>
                </div>
            </div>
            <div class="col-lg-4 mr-auto text-center">
                <i class="fas fa-envelope fa-3x mb-3 text-muted"></i>
                <!-- Make sure to change the email address in BOTH the anchor text and the link target below!-->
                <a class="d-block" href="mailto:<?= Yii::$app->params['supportEmail'] ?>"><?= Yii::$app->params['supportEmail'] ?></a>
            </div>
        </div>
    </div>
</section>
