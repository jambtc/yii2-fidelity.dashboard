<?php
/*
author :: Sergio Casizzone
website :: https://sergiocasizzone.altervista.org
change language by get language=EN, language=TH,...
or select on this widget
*/

namespace app\components;

use Yii;
use yii\base\Component;
use yii\base\Widget;
use yii\bootstrap4\ButtonDropdown;
use yii\helpers\Url;
use yii\helpers\Html;

use yii\web\Cookie;

class languageSwitcher extends Widget
{
	/* list of languagesี่ */
	public $languages = [
		'en-US' => 'English',
		'it-IT' => 'Italian',
	];

	public function init()
	{
		if(php_sapi_name() === 'cli')
		{
			return true;
		}

        $languageNew = Yii::$app->request->get( 'language' );
		if( $languageNew ) {
			if( isset( $this->languages[ $languageNew ] ) ) {

				Yii::$app->language = $languageNew;

				$cookie = new Cookie( [
					'name' => 'language',
					'value' => $languageNew,
                    'httpOnly' => true,
				]);
				\Yii::$app->getResponse()->getCookies()->add($cookie);
			}
		}
		elseif( \Yii::$app->getRequest()->getCookies()->has( 'language' ) ) {
			Yii::$app->language = \Yii::$app->getRequest()->getCookies()->getValue( 'language' );
		}

	}

	public function run(){
		$languages = $this->languages;
		$current = $languages[Yii::$app->language];
		unset($languages[Yii::$app->language]);

		$items = [];
		foreach($languages as $code => $language)
		{
			$temp = [];
			$temp['label'] = $language; //Html::img('@app/css/images/'.$code.'.png', ['alt' => $language]) ;
			$temp['url'] = Url::current(['language' => $code]);
			array_push($items, $temp);
		}

		echo ButtonDropdown::widget([
			'label' => $current,
			'dropdown' => [
				'items' => $items,
                'encodeLabels' => false,
                'submenuOptions' => [
                    'class' => 'bg-primary'
                ]
			],
            'options' => [
                'class' => 'rounded'
            ]
		]);
	}

}
