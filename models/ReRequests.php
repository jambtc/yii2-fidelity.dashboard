<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "re_requests".
 *
 * @property int $id
 * @property int $timestamp
 * @property int $id_merchant
 * @property int $id_store
 * @property string $payload
 * @property int $sent
 *
 * @property Merchants $merchant
 * @property Stores $store
 */
class ReRequests extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 're_requests';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['timestamp', 'id_merchant', 'id_store', 'payload', 'sent'], 'required'],
            [['timestamp', 'id_merchant', 'id_store', 'sent'], 'integer'],
            [['payload'], 'string'],
            [['id_merchant'], 'exist', 'skipOnError' => true, 'targetClass' => Merchants::className(), 'targetAttribute' => ['id_merchant' => 'id']],
            [['id_store'], 'exist', 'skipOnError' => true, 'targetClass' => Stores::className(), 'targetAttribute' => ['id_store' => 'id']],
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
            'id_merchant' => Yii::t('app', 'Id Merchant'),
            'id_store' => Yii::t('app', 'Id Store'),
            'payload' => Yii::t('app', 'Payload'),
            'sent' => Yii::t('app', 'Sent'),
        ];
    }

    /**
     * Gets query for [[Merchant]].
     *
     * @return \yii\db\ActiveQuery|\app\models\query\MerchantsQuery
     */
    public function getMerchant()
    {
        return $this->hasOne(Merchants::className(), ['id' => 'id_merchant']);
    }

    /**
     * Gets query for [[Store]].
     *
     * @return \yii\db\ActiveQuery|\app\models\query\StoresQuery
     */
    public function getStore()
    {
        return $this->hasOne(Stores::className(), ['id' => 'id_store']);
    }

    /**
     * {@inheritdoc}
     * @return \app\models\query\ReRequestsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\query\ReRequestsQuery(get_called_class());
    }
}
