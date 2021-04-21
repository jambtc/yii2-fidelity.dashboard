<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "invoices".
 *
 * @property int $id
 * @property int $id_user
 * @property string $status
 * @property float $price
 * @property float $received
 * @property int $id_pos
 * @property int $invoice_timestamp
 * @property int $expiration_timestamp
 * @property string|null $from_address
 * @property string|null $to_address
 * @property string|null $txhash
 * @property string|null $message

 *
 * @property Users $user
 * @property Pos $pos
 */
class Invoices extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'invoices';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_user', 'status', 'price', 'received', 'id_pos', 'invoice_timestamp', 'expiration_timestamp'], 'required'],
            [['id_user', 'id_pos', 'invoice_timestamp', 'expiration_timestamp'], 'integer'],
            [['price', 'received'], 'number'],
            [['status'], 'string', 'max' => 20],
            [['from_address', 'to_address'], 'string', 'max' => 100],
            [['txhash'], 'string', 'max' => 250],
            [['message'], 'string', 'max' => 1000],
            [['id_user'], 'exist', 'skipOnError' => true, 'targetClass' => Users::className(), 'targetAttribute' => ['id_user' => 'id']],
            [['id_pos'], 'exist', 'skipOnError' => true, 'targetClass' => Pos::className(), 'targetAttribute' => ['id_pos' => 'id']],
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
            'status' => Yii::t('app', 'Status'),
            'price' => Yii::t('app', 'Price'),
            'received' => Yii::t('app', 'Received'),
            'id_pos' => Yii::t('app', 'Id Pos'),
            'invoice_timestamp' => Yii::t('app', 'Invoice Timestamp'),
            'expiration_timestamp' => Yii::t('app', 'Expiration Timestamp'),
            'from_address' => Yii::t('app', 'From Address'),
            'to_address' => Yii::t('app', 'To Address'),
            'txhash' => Yii::t('app', 'Txhash'),
            'message' => Yii::t('app', 'Message'),
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
     * Gets query for [[Pos]].
     *
     * @return \yii\db\ActiveQuery|\app\models\query\PosQuery
     */
    public function getPos()
    {
        return $this->hasOne(Pos::className(), ['id' => 'id_pos']);
    }

    /**
     * {@inheritdoc}
     * @return \app\models\query\InvoicesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\query\InvoicesQuery(get_called_class());
    }

    public static function getTotal($provider, $columnName)
    {
        $total = 0;
        foreach ($provider->getModels() as $item) {
            $total += $item[$columnName];
        }
      return $total;
    }
}
