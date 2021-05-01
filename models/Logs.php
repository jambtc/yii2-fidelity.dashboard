<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "logs".
 *
 * @property int $id
 * @property int $timestamp
 * @property int|null $id_user
 * @property string $remote_address
 * @property string $browser
 * @property string $app
 * @property string $controller
 * @property string $action
 * @property string $description
 * @property int|null $die
 */
class Logs extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'logs';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['timestamp', 'remote_address', 'browser', 'app', 'controller', 'action', 'description'], 'required'],
            [['timestamp', 'id_user', 'die'], 'integer'],
            [['description'], 'string'],
            [['remote_address'], 'string', 'max' => 20],
            [['browser'], 'string', 'max' => 255],
            [['app', 'controller', 'action'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'timestamp' => Yii::t('app', 'Timestamp'),
            'id_user' => Yii::t('app', 'Id User'),
            'remote_address' => Yii::t('app', 'Remote Address'),
            'browser' => Yii::t('app', 'Browser'),
            'app' => Yii::t('app', 'App'),
            'controller' => Yii::t('app', 'Controller'),
            'action' => Yii::t('app', 'Action'),
            'description' => Yii::t('app', 'Description'),
            'die' => Yii::t('app', 'Die'),
        ];
    }

    /**
     * {@inheritdoc}
     * @return \app\models\query\LogsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\query\LogsQuery(get_called_class());
    }
}
