<?php

namespace app\models;

use Yii;
use app\components\WebApp;

/**
 * This is the model class for table "rules_engines".
 *
 * @property int $id
 * @property string $url
 * @property string $public_key
 * @property string $secret_key
 */
class RulesEngines extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'rules_engines';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['url', 'public_key', 'secret_key'], 'required'],
            [['url', 'public_key', 'secret_key'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'url' => Yii::t('app', 'Url'),
            'public_key' => Yii::t('app', 'Public Key'),
            'secret_key' => Yii::t('app', 'Secret Key'),
        ];
    }

    /**
     * {@inheritdoc}
     * @return \app\models\query\RulesEnginesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\query\RulesEnginesQuery(get_called_class());
    }

    public function beforeSave($insert) {
        $this->secret_key = WebApp::encrypt($this->secret_key);

        return parent::beforeSave($insert);
    }
}
