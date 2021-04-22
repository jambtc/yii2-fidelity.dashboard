<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "users".
 *
 * @property int $id
 * @property string $username
 * @property string $password
 * @property string|null $activation_code
 * @property int|null $status_activation_code
 * @property string|null $authKey
 * @property string|null $accessToken
 * @property string|null $first_name
 * @property string|null $last_name
 * @property string|null $email
 * @property int|null $is_merchant
 * @property string|null $denomination
 * @property string|null $tax_code
 * @property string|null $address
 * @property string|null $cap
 * @property string|null $city
 * @property string|null $country
 *
 * @property PushSubscriptions[] $pushSubscriptions
 */
class Users extends \yii\db\ActiveRecord
{
    const STATUS_INSERTED = 0;
    const STATUS_ACTIVE = 1;
    const STATUS_BLOCKED = 2;


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'users';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['username', 'password'], 'required'],
            [['status_activation_code', 'is_merchant'], 'integer'],
            [['username', 'password', 'authKey', 'accessToken', 'first_name', 'last_name', 'email', 'denomination', 'address', 'city', 'country'], 'string', 'max' => 255],
            [['activation_code'], 'string', 'max' => 50],
            [['tax_code'], 'string', 'max' => 20],
            [['cap'], 'string', 'max' => 10],
            [['username'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'username' => Yii::t('app', 'Username'),
            'password' => Yii::t('app', 'Password'),
            'activation_code' => Yii::t('app', 'Activation Code'),
            'status_activation_code' => Yii::t('app', 'Status Activation Code'),
            'authKey' => Yii::t('app', 'Auth Key'),
            'accessToken' => Yii::t('app', 'Access Token'),
            'first_name' => Yii::t('app', 'First Name'),
            'last_name' => Yii::t('app', 'Last Name'),
            'email' => Yii::t('app', 'Email'),
            'is_merchant' => Yii::t('app', 'Is Merchant'),
            'denomination' => Yii::t('app', 'Denomination'),
            'tax_code' => Yii::t('app', 'Tax Code'),
            'address' => Yii::t('app', 'Address'),
            'cap' => Yii::t('app', 'Cap'),
            'city' => Yii::t('app', 'City'),
            'country' => Yii::t('app', 'Country'),
        ];
    }

    /**
     * Gets query for [[PushSubscriptions]].
     *
     * @return \yii\db\ActiveQuery|\app\models\query\PushSubscriptionsQuery
     */
    public function getPushSubscriptions()
    {
        return $this->hasMany(PushSubscriptions::className(), ['id_user' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return \app\models\query\UsersQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\query\UsersQuery(get_called_class());
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return self::findOne(['username'=>$username]);
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return Yii::$app->getSecurity()->validatePassword($password, $this->password);
    }

    // public function beforeSave($insert) {
    //     if($this->isNewRecord)
    //         $this->password = \Yii::$app->getSecurity()->generatePasswordHash($this->password);
    //
    //     return parent::beforeSave($insert);
    // }

    /**
     * Finds out if password reset token is valid
     *
     * @param string $token password reset token
     * @return bool
     */
    public static function isPasswordResetTokenValid($token)
    {
        if (empty($token)) {
            return false;
        }

        $timestamp = (int) substr($token, strrpos($token, '_') + 1);
        $expire = Yii::$app->params['user.passwordResetTokenExpire'];
        return $timestamp + $expire >= time();
    }
    /**
     * Generates new password reset token
     */
    public function generatePasswordResetToken()
    {
        $this->activation_code = Yii::$app->security->generateRandomString() . '_' . time();
    }

    /**
     * Finds user by password reset token
     *
     * @param string $token password reset token
     * @return static|null
     */
    public static function findByPasswordResetToken($token)
    {
        if (!static::isPasswordResetTokenValid($token)) {
            return null;
        }

        return static::findOne([
            'activation_code' => $token,
            'status_activation_code' => self::STATUS_ACTIVE,
        ]);
    }

    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     */
    public function setPassword($password)
    {
        //$this->password = $password; // l'hash viene generato befor-save
        $this->password = \Yii::$app->getSecurity()->generatePasswordHash($password);
    }
    /**
     * Removes password reset token
     */
    public function removePasswordResetToken()
    {
        $this->activation_code = 0;
    }
    /**
     * Generates "remember me" authentication key
     */
    public function generateAuthKey()
    {
        $this->authKey = Yii::$app->security->generateRandomString();
    }
}
