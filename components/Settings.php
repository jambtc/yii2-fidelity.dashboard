<?php
namespace app\components;

use Yii;
use yii\base\Component;
use yii\base\InvalidConfigException;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use yii\db\ActiveRecord;

use app\models\SettingsWebapp;


class Settings extends Component
{
    /**
    * Questa funzione carica le impostazioni della webapp
    */
    public static function load(){
        $array = array();
        // use "slug" column as key values

        $dataProvider = new ActiveDataProvider([
          'query' => SettingsWebapp::find(),
          'pagination' => false // !!! IMPORTANT TO GET ALL MODELS
        ]);

        // echo "<pre>".print_r($dataProvider,true)."</pre>";
        // exit;
        // $iterator = new CDataProviderIterator($dataProvider);

        foreach ($dataProvider->getModels() as $item) {
            $array[$item->setting_name] = $item->setting_value;
        }
        // echo "<pre>".print_r($array,true)."</pre>";
        // exit;

        if (!(isset($array['id'])) || $array['id'] == '')
            $array['id'] = 1;

        $settings = (object) $array;
        // echo "<pre>".print_r($settings,true)."</pre>"; exit;

        return $settings;
    }
}
