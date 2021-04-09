<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "settings_webapp".
 *
 * @property int $id
 * @property string $setting_name
 * @property string $setting_value
 */
class SettingsWebapp extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'settings_webapp';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['setting_name', 'setting_value'], 'required'],
            [['setting_name'], 'string', 'max' => 20],
            [['setting_value'], 'string', 'max' => 10000],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'setting_name' => Yii::t('app', 'Setting Name'),
            'setting_value' => Yii::t('app', 'Setting Value'),
        ];
    }

    /**
     * {@inheritdoc}
     * @return \app\models\query\SettingsWebappQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\query\SettingsWebappQuery(get_called_class());
    }
}
