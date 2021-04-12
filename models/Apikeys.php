<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "apikeys".
 *
 * @property int $id
 * @property int $id_merchant
 * @property int $id_store
 * @property string $denomination
 * @property string $public_key
 * @property string $secret_key
 *
 * @property Merchants $merchant
 * @property Stores $store
 */
class Apikeys extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'apikeys';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_merchant', 'id_store', 'denomination', 'public_key', 'secret_key'], 'required'],
            [['id_merchant', 'id_store'], 'integer'],
            [['denomination', 'public_key', 'secret_key'], 'string', 'max' => 255],
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
            'id_merchant' => Yii::t('app', 'Id Merchant'),
            'id_store' => Yii::t('app', 'Id Store'),
            'denomination' => Yii::t('app', 'Denomination'),
            'public_key' => Yii::t('app', 'Public Key'),
            'secret_key' => Yii::t('app', 'Secret Key'),
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
     * @return \app\models\query\ApikeysQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\query\ApikeysQuery(get_called_class());
    }
}
