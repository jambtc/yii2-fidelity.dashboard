<?php
use yii\helpers\Html;
use yii\bootstrap4\Nav;
use yii\bootstrap4\NavBar;
use app\components\WebApp;

use kartik\icons\Icon;
Icon::map($this);

$items[] = ['label' => Icon::show('home') . 'Home', 'url' => ['/site/index']];

if (Yii::$app->user->isGuest)
{
    $items[] = ['label' => Icon::show('address-card') . 'About', 'url' => 'https://txlab.it'];
    $items[] = ['label' => Icon::show('user-plus') . Yii::t('app','Register'), 'url' => ['/site/register']];
    $items[] = ['label' => Icon::show('sign-in-alt') . Yii::t('app','Login'), 'url' => ['/site/login']];
} else {
    $items[] = [
            'label' => Icon::show('tasks') . Yii::t('app','Manage Payments'),
            'items' => [
                ['label' => Icon::show('star') . Yii::t('app','Invoices'), 'url' => ['/invoices/index']],
                ['label' => Icon::show('comment') . Yii::t('app','Notifications'), 'url' => ['/notifications/index']],
            ],
        ];


    if ((Yii::$app->user->id == 1)
        || (Yii::$app->user->id > 1 && Yii::$app->user->identity->is_merchant == 1))  {

        $items[] = [
            'label' => Icon::show('check-square') . Yii::t('app','Manage App'),
            'items' => [
                (Yii::$app->user->id == 1) ?
                    (['label' => Icon::show('industry') . Yii::t('app','Merchants'), 'url' => ['/merchants/index']]) :
                    '',
                ['label' => Icon::show('shopping-cart') . Yii::t('app','Stores'), 'url' => ['/stores/index']],
                ['label' => Icon::show('desktop') . Yii::t('app','Point of sale'), 'url' => ['/pos/index']],
            ],
        ];
    }

    if (Yii::$app->user->id == 1){
        $items[] = [
                'label' => Icon::show('archive') . Yii::t('app','Administration'),
                'items' => [
                    ['label' => Icon::show('users') . Yii::t('app','Users'), 'url' => ['/users/index']],
                    ['label' => Icon::show('eye') . Yii::t('app','Subscriptions'), 'url' => ['/subscriptions/index']],
                    ['label' => Icon::show('key') . Yii::t('app','Api Keys'), 'url' => ['/apikeys/index']],
                ],
            ];

        $items[] = [
                'label' => Icon::show('clipboard-list') . Yii::t('app','Logs'),
                'items' => [
                    ['label' => Icon::show('list-alt') . Yii::t('app','Status'), 'url' => ['/logs/index']],
                    ['label' => Icon::show('cogs') . Yii::t('app','Rules Engine'), 'url' => ['/rerequests/index']],
                ],
            ];
    }

    $items[] = [
            'label' => Icon::show('cog') . Yii::t('app','Settings'),
            'items' => [
                (Yii::$app->user->id == 1) ?
                    (['label' => Icon::show('paragraph') . Yii::t('app','Owner'), 'url' => ['/owner/index']]) :
                '',
                (Yii::$app->user->id == 1) ?
                    (['label' => Icon::show('server') . Yii::t('app','Server host'), 'url' => ['/host/index']]) :
                '',
                (Yii::$app->user->id == 1) ?
                    (['label' => Icon::show('link') . Yii::t('app','Blockchain'), 'url' => ['/blockchains/index']]) :
                '',
                (Yii::$app->user->id == 1) ?
                    (['label' => Icon::show('code-branch') . Yii::t('app','Poa Nodes'), 'url' => ['/nodes/index']]) :
                '',
                (Yii::$app->user->id == 1) ?
                    (['label' => Icon::show('handshake') . Yii::t('app','Social auth'), 'url' => ['/oauths/index']]) :
                '',
                (Yii::$app->user->id == 1) ?
                    (['label' => Icon::show('user-shield') . Yii::t('app','VAPID Keys'), 'url' => ['/vapid/index']]) :
                '',
                (Yii::$app->user->id == 1) ?
                    (['label' => Icon::show('pencil-ruler') . Yii::t('app','Rules Engine'), 'url' => ['/rulesengine/index']]) :
                '',
                (Yii::$app->user->id != 1 && Yii::$app->user->identity->is_merchant == 1) ?
                    (['label' => Icon::show('key') . Yii::t('app','Api keys'), 'url' => ['/apikeys/index']]) :
                '',
                ['label' => Icon::show('user') . Yii::t('app','User account'), 'url' => ['/users/view','id'=>WebApp::encrypt(Yii::$app->user->id)]]
            ],
        ];


    $items[] = '<li>'
        . Html::beginForm(['/site/logout'], 'post')
        . Html::submitButton(
            Icon::show('sign-out-alt') . Yii::t('app','Logout'),
            ['class' => 'btn btn-primary logout py-2']
        )
        . Html::endForm()
        . '</li>';
}

NavBar::begin([
    'brandLabel' => Html::img('@web/css/images/logo.png', ['alt'=>Yii::$app->name,'style'=>'height: 50px; width: 50px; top: 2.5px; position: absolute;']),
    'brandUrl' => Yii::$app->homeUrl,
    'options' => ['class' => 'navbar-expand-lg navbar-light bg-light shadow'],
    'innerContainerOptions' => [
        'class' => 'container-fluid'
    ]
]);
echo Nav::widget([
    'options' => ['class' => 'navbar-nav ml-auto'],
    'items' => $items,
    'encodeLabels' => false
]);
NavBar::end();
?>
