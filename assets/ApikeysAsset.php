<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use Yii;
use yii\web\AssetBundle;

/**
 * Blockchain Synchronization asset bundle.
 *
 * @author Sergio Casizzone <jambtc@gmail.com>
 * @since 2.0
 */
class ApikeysAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
    ];
    public $js = [
        'js/apikeys-create.js'
    ];


    public $depends = [
        'yii\web\YiiAsset',
        'yii\web\JqueryAsset'
    ];
}
