<?php
use app\components\WebApp;
use yii\helpers\Url;
$darkmode = 'bg-white';
$brand_link = 'bg-light';
if (isset($_COOKIE['darkmode'])) {
    $cookie = \yii\helpers\Json::decode($_COOKIE['darkmode']);
    $darkmode = $cookie['sidebar'];
    $brand_link = null;

}
?>
<aside class="main-sidebar <?= $darkmode ?> elevation-4">
    <!-- Brand Logo -->
    <a href="<?= Yii::$app->homeUrl ?>" class="brand-link <?= $brand_link ?>">
        <?=
        \yii\helpers\Html::img('@web/css/images/logo.png', [
            'alt' => Yii::$app->name,
            'class' => "brand-image img-circle elevation-3",
            // 'style' => 'opacity: .8; height: 50px; width: 50px; top: 2.5px; position: absolute;'
        ]) ?>
        <span class="brand-text font-weight-light"><?= Yii::$app->name ?></span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="css/images/anonymous.png" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="<?= Url::to(['users/view','id'=>WebApp::encrypt(Yii::$app->user->id)]) ?>" class="d-block">
                    <?php if (!Yii::$app->user->isGuest) : ?>
                        <?= Yii::$app->user->identity->first_name .' '.Yii::$app->user->identity->last_name ?>
                    <?php endif ?>
                </a>
            </div>
        </div>

        <?php
        $items[] = [
            'label' => Yii::t('app','Manage Payments'),
            'icon' => 'tasks',
            // 'badge' => '<span class="right badge badge-info">2</span>',
            'items' => [
                ['label' => Yii::t('app','Invoices'), 'url' => ['invoices/index'], 'iconStyle' => 'far', 'icon' => 'star'],
                ['label' => Yii::t('app','Notifications'), 'url' => ['notifications/index'], 'iconStyle' => 'far', 'icon' => 'comment'],
            ]
        ];

        if ((Yii::$app->user->id == 1)
            || (Yii::$app->user->id > 1 && Yii::$app->user->identity->is_merchant == 1))  {

            $subarray = null;
            if (Yii::$app->user->id == 1){
                $subarray = [
                    ['label' => Yii::t('app','Merchants'), 'url' => ['/merchants/index'], 'icon' => 'industry'],
                ];
            }
            $subarray[] = ['label' => Yii::t('app','Stores'), 'url' => ['/stores/index'], 'icon' => 'shopping-cart'];
            $subarray[] = ['label' => Yii::t('app','Point of sale'), 'url' => ['/pos/index'], 'icon' => 'desktop'];

            $items[] = [
                'label' => Yii::t('app','Manage App'),
                'icon' => 'check-square',
                'items' => $subarray,
            ];
        }

        if (Yii::$app->user->id == 1){
            $items[] = [
                    'label' => Yii::t('app','Administration'),
                    'icon' => 'archive',
                    'items' => [
                        ['label' => Yii::t('app','Users'), 'url' => ['/users/index'], 'icon' => 'users'],
                        ['label' => Yii::t('app','Subscriptions'), 'url' => ['/subscriptions/index'], 'icon' => 'eye'],
                        ['label' => Yii::t('app','Api Keys'), 'url' => ['/apikeys/index'], 'icon' => 'key'],
                    ],
                ];

            $items[] = [
                    'label' => Yii::t('app','Logs'),
                    'icon' => 'clipboard-list',
                    'items' => [
                        ['label' => Yii::t('app','Status'), 'url' => ['/logs/index'], 'icon' => 'list-alt'],
                        ['label' => Yii::t('app','Rules Engine'), 'url' => ['/rulesenginerequests/index'], 'icon' => 'cogs'],
                    ],
                ];
        }
        $subarray = null;
        if (Yii::$app->user->id == 1){
            $subarray = [
                // ['label' => Yii::t('app','Application'), 'url' => ['/settings/index'], 'icon' => 'server'],
                ['label' => Yii::t('app','Owner'), 'url' => ['/settings/owner/index'], 'icon' => 'paragraph'],
                ['label' => Yii::t('app','Server host'), 'url' => ['/settings/host/index'], 'icon' => 'server'],
                ['label' => Yii::t('app','Blockchain'), 'url' => ['/settings/blockchains/index'], 'icon' => 'link'],
                ['label' => Yii::t('app','Poa Nodes'), 'url' => ['/settings/nodes/index'], 'icon' => 'code-branch'],
                ['label' => Yii::t('app','VAPID Keys'), 'url' => ['/settings/vapid/index'], 'icon' => 'user-shield'],
                ['label' => Yii::t('app','Rules Engine'), 'url' => ['/settings/rules-engines/index'], 'icon' => 'pencil-ruler'],
            ];
        }
        if (Yii::$app->user->id != 1 && Yii::$app->user->identity->is_merchant == 1){
            $subarray[] = ['label' => Yii::t('app','Api keys'), 'url' => ['/apikeys/index'], 'icon' => 'key'];
        }
        $subarray[] = ['label' => Yii::t('app','User account'), 'url' => ['/users/view','id'=>WebApp::encrypt(Yii::$app->user->id)], 'icon' => 'user'];

        // $items[] = ['label' => 'Settings', 'header' => true],

        $items[] = [
            'label' => Yii::t('app','Settings'),
            'icon' => 'cog',
            'items' => $subarray,
        ];


        ?>
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <?php
            echo \hail812\adminlte\widgets\Menu::widget([
                'items' => $items,
                //[
                    // [
                    //     'label' => Yii::t('app','Manage Payments'),
                    //     'icon' => 'tasks',
                    //     // 'badge' => '<span class="right badge badge-info">2</span>',
                    //     'items' => [
                    //         ['label' => Yii::t('app','Invoices'), 'url' => ['invoices/index'], 'iconStyle' => 'far', 'icon' => 'star'],
                    //         ['label' => Yii::t('app','Notifications'), 'url' => ['notifications/index'], 'iconStyle' => 'far', 'icon' => 'comment'],
                    //     ]
                    // ],
                    // ['label' => 'Simple Link', 'icon' => 'th', 'badge' => '<span class="right badge badge-danger">New</span>'],
                    // ['label' => 'Yii2 PROVIDED', 'header' => true],
                    // ['label' => 'Login', 'url' => ['site/login'], 'icon' => 'sign-in-alt', 'visible' => Yii::$app->user->isGuest],
                    // ['label' => 'Gii',  'icon' => 'file-code', 'url' => ['/gii'], 'target' => '_blank'],
                    // ['label' => 'Debug', 'icon' => 'bug', 'url' => ['/debug'], 'target' => '_blank'],
                    // ['label' => 'MULTI LEVEL EXAMPLE', 'header' => true],
                    // ['label' => 'Level1'],
                    // [
                    //     'label' => 'Level1',
                    //     'items' => [
                    //         ['label' => 'Level2', 'iconStyle' => 'far'],
                    //         [
                    //             'label' => 'Level2',
                    //             'iconStyle' => 'far',
                    //             'items' => [
                    //                 ['label' => 'Level3', 'iconStyle' => 'far', 'icon' => 'dot-circle'],
                    //                 ['label' => 'Level3', 'iconStyle' => 'far', 'icon' => 'dot-circle'],
                    //                 ['label' => 'Level3', 'iconStyle' => 'far', 'icon' => 'dot-circle']
                    //             ]
                    //         ],
                    //         ['label' => 'Level2', 'iconStyle' => 'far']
                    //     ]
                    // ],
                    // ['label' => 'Level1'],
                    // ['label' => 'LABELS', 'header' => true],
                    // ['label' => 'Important', 'iconStyle' => 'far', 'iconClassAdded' => 'text-danger'],
                    // ['label' => 'Warning', 'iconClass' => 'nav-icon far fa-circle text-warning'],
                    // ['label' => 'Informational', 'iconStyle' => 'far', 'iconClassAdded' => 'text-info'],
                //],
            ]);
            ?>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
