<?php
namespace app\components;

use Yii;
use yii\base\Component;
use yii\base\InvalidConfigException;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use yii\db\ActiveRecord;

use app\models\Owner;

class Settings extends Component
{
    /**
    * Questa funzione carica le impostazioni della webapp
    */
    public static function owner(){
        return Owner::findOne(1);
    }
}
