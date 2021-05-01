<?php

namespace app\models;

use Yii;
use app\components\WebApp;

/**
 * This is the model class for table "host".
 *
 * @property int $id
 * @property string $tcpip
 * @property string $user
 * @property string $password
 */
class Host extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'host';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tcpip', 'user', 'password'], 'required'],
            [['tcpip', 'user', 'password'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'tcpip' => Yii::t('app', 'Tcpip'),
            'user' => Yii::t('app', 'User'),
            'password' => Yii::t('app', 'Password'),
        ];
    }

    /**
     * {@inheritdoc}
     * @return \app\models\query\HostQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\query\HostQuery(get_called_class());
    }

    public function beforeSave($insert) {
        $this->password = WebApp::encrypt($this->password);

        return parent::beforeSave($insert);
    }
}
