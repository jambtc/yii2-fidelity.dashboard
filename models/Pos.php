<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "pos".
 *
 * @property int $id
 * @property int $id_merchant
 * @property int $id_store
 * @property string $denomination
 * @property string $sin
 *
 * @property Merchants $merchant
 * @property Stores $store
 */
class Pos extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'pos';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_merchant', 'id_store', 'denomination', 'sin'], 'required'],
            [['id_merchant', 'id_store'], 'integer'],
            [['denomination', 'sin'], 'string', 'max' => 255],
            [['id_merchant'], 'exist', 'skipOnError' => true, 'targetClass' => Merchants::className(), 'targetAttribute' => ['id_merchant' => 'id']],
            [['id_store'], 'exist', 'skipOnError' => true, 'targetClass' => Stores::className(), 'targetAttribute' => ['id_store' => 'id']],
            // ['sin', 'sinValidate'],
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
            'sin' => Yii::t('app', 'Sin'),
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
     * @return \app\models\query\PosQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\query\PosQuery(get_called_class());
    }

    public function setSin(){
        $this->sin = Yii::$app->security->generateRandomString(16);
    }

    // public function sinValidate($attribute, $params) {
    //     echo '<pre>'.print_r($this,true).'</pre>'; exit;
    //
    //     if($this->isNewRecord)
    //         $this->sin = Yii::$app->security->generateRandomString(16);
    //
    //     return true;
    // }
}
