<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "re_requests".
 *
 * @property int $id
 * @property int $timestamp
 * @property int $id_merchant
 * @property string $payload
 * @property int $sent
 *
 * @property Merchants $merchant
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
            [['timestamp', 'id_merchant', 'payload', 'sent'], 'required'],
            [['timestamp', 'id_merchant', 'sent'], 'integer'],
            [['payload'], 'string'],
            [['id_merchant'], 'exist', 'skipOnError' => true, 'targetClass' => Merchants::className(), 'targetAttribute' => ['id_merchant' => 'id']],
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
     * {@inheritdoc}
     * @return \app\models\query\ReRequestsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\query\ReRequestsQuery(get_called_class());
    }
}
