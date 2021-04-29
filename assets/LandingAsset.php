<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * Main application asset bundle.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class LandingAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        // <!-- Google fonts-->
        'https://fonts.googleapis.com/css?family=Merriweather+Sans:400,700',
        'https://fonts.googleapis.com/css?family=Merriweather:400,300,300italic,400italic,700,700italic',
        'https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.min.css',
        'landing-page/css/styles.css',
    ];
    public $js = [
        'https://cdnjs.cloudflare.com/ajax/libs/animejs/3.2.1/anime.min.js',
        'https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.min.js',
        'landing-page/js/scripts.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap4\BootstrapAsset',
    ];
}
