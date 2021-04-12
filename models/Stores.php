<?php

namespace app\models;

use Yii;
use app\components\WebApp;

/**
 * This is the model class for table "stores".
 *
 * @property int $id
 * @property int $id_merchant
 * @property string|null $denomination
 * @property string|null $bps_storeid
 * @property string|null $wallet_address
 * @property string|null $derivedKey
 * @property string|null $privateKey
 *
 * @property Merchants $merchant
 */
class Stores extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'stores';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_merchant'], 'required'],
            [['id_merchant'], 'integer'],
            [['denomination', 'bps_storeid'], 'string', 'max' => 255],
            [['wallet_address', 'derivedKey', 'privateKey'], 'string', 'max' => 500],
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
            'id_merchant' => Yii::t('app', 'Id Merchant'),
            'denomination' => Yii::t('app', 'Denomination'),
            'bps_storeid' => Yii::t('app', 'Bps Storeid'),
            'wallet_address' => Yii::t('app', 'Wallet Address'),
            'derivedKey' => Yii::t('app', 'Derived Key'),
            'privateKey' => Yii::t('app', 'Private Key'),
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
     * @return \app\models\query\StoresQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\query\StoresQuery(get_called_class());
    }

    public function beforeSave($insert) {
        if(isset($this->derivedKey))
            $this->derivedKey = WebApp::encrypt($this->derivedKey);

        if(isset($this->privateKey))
            $this->privateKey = WebApp::encrypt($this->privateKey);

        if(!isset($this->bps_storeid))
            $this->bps_storeid = Yii::$app->security->generateRandomString(32);

        return parent::beforeSave($insert);
    }
}
