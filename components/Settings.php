<?php
namespace app\components;

use Yii;
use yii\base\Component;
use yii\base\InvalidConfigException;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use yii\db\ActiveRecord;

use app\models\SettingsWebapp;

define('WEBAPPFIELDS',   [
       'poa_expiration',
       'quota_iscrizione_socio',
       'quota_iscrizione_socioGiuridico',
       'gdpr_address',
       'gdpr_cap',
       'gdpr_telefono',
       'gdpr_fax'
]);


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

      if (!(isset($array['blockchainAsset'])) || $array['blockchainAsset'] == '' || $array['blockchainAsset'] == '0')
          $array['blockchainAsset'] = "{'BTC':'BTC'}";

      if (!(isset($array['poa_decimals'])) || $array['poa_decimals'] == '')
          $array['poa_decimals'] = 2;

      if (!(isset($array['id_exchange'])) || $array['id_exchange'] == '')
        $array['id_exchange'] = 1;

      if (!(isset($array['gdpr_city'])) || $array['gdpr_city'] == '')
        $array['gdpr_city'] = 1;

      foreach (WEBAPPFIELDS as $key) {
        if (!array_key_exists($key, $array))
          $array[$key] = '';
      }

      $settings = (object) $array;
      // echo "<pre>".print_r($settings,true)."</pre>";
      // exit;
      return $settings;
  }

}
