<?php

namespace app\models;

use Yii;

use app\components\WebApp;

/**
 * This is the model class for table "merchants".
 *
 * @property int $id
 * @property int $id_user
 * @property string|null $denomination
 * @property string|null $tax_code
 * @property string|null $address
 * @property string|null $cap
 * @property string|null $city
 * @property string|null $country
 * @property string|null $wallet_address
 * @property string|null $derivedKey
 * @property string|null $privateKey
 *
 * @property Users $user
 */
class Merchants extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'merchants';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_user'], 'required'],
            [['id_user'], 'integer'],
            [['denomination', 'address', 'city', 'country'], 'string', 'max' => 255],
            [['tax_code'], 'string', 'max' => 50],
            [['cap'], 'string', 'max' => 10],
            [['wallet_address', 'derivedKey', 'privateKey'], 'string', 'max' => 500],
            [['id_user'], 'exist', 'skipOnError' => true, 'targetClass' => Users::className(), 'targetAttribute' => ['id_user' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'id_user' => Yii::t('app', 'Id User'),
            'denomination' => Yii::t('app', 'Denomination'),
            'tax_code' => Yii::t('app', 'Tax Code'),
            'address' => Yii::t('app', 'Address'),
            'cap' => Yii::t('app', 'Cap'),
            'city' => Yii::t('app', 'City'),
            'country' => Yii::t('app', 'Country'),
            'wallet_address' => Yii::t('app', 'Wallet Address'),
            'derivedKey' => Yii::t('app', 'Derived Key'),
            'privateKey' => Yii::t('app', 'Private Key'),
        ];
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery|\app\models\query\UsersQuery
     */
    public function getUser()
    {
        return $this->hasOne(Users::className(), ['id' => 'id_user']);
    }

    /**
     * {@inheritdoc}
     * @return \app\models\query\MerchantsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\query\MerchantsQuery(get_called_class());
    }

    public function beforeSave($insert) {
        if(isset($this->derivedKey))
            $this->derivedKey = WebApp::encrypt($this->derivedKey);

        if(isset($this->privateKey))
            $this->privateKey = WebApp::encrypt($this->privateKey);

        return parent::beforeSave($insert);
    }

    public function getIdByUser($id) {
        return self::find(['id_user'=>$id])->one()->id;
    }
}
