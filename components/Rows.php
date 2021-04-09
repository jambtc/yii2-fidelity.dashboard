<?php
namespace app\components;

use Yii;
use yii\base\Component;
use yii\base\InvalidConfigException;

use yii\base\Model;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;

use yii\components\WebApp;



class Rows extends Component
{
    public static function statuscolor($status){
        switch (strtolower(trim($status))){
            case 'new':
                $color = 'secondary';
                break;

            case 'failed':
            case 'invalid':
                $color = 'danger';
                break;

            case 'expired':
                $color = 'warning';
                break;

            case 'complete':
            case 'paid':
            case 'confirmed':
                $color = 'success';
                break;

            case 'paidover':
                $color = 'info';
                break;

            default:
                $color = 'dark';
        }
        return $color;
    }



}
