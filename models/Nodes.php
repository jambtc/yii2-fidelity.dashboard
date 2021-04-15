<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "nodes".
 *
 * @property int $id
 * @property string $url
 * @property string $port
 */
class Nodes extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'nodes';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['url', 'port'], 'required'],
            [['url'], 'string', 'max' => 255],
            [['port'], 'string', 'max' => 50],
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
            'port' => Yii::t('app', 'Port'),
        ];
    }

    /**
     * {@inheritdoc}
     * @return \app\models\query\NodesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\query\NodesQuery(get_called_class());
    }
}
