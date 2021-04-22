<?php
namespace app\models;

use yii\base\Model;
use Yii;
use app\models\Users;

/**
 * Model representing Signup Form.
 */
class SignupForm extends \yii\db\ActiveRecord
{
    public $username;
    public $password;

    //
    public $first_name;
    public $last_name;
    public $denomination;
    public $tax_code;
    public $address;
    public $cap;
    public $city;
    public $country;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'users';
    }


    /**
     * Returns the validation rules for attributes.
     *
     * @return array
     */
    public function rules()
    {
        return [
            ['username', 'filter', 'filter' => 'trim'],
            ['username', 'required'],
            ['username', 'string', 'min' => 6, 'max' => 255],
            ['username', 'match',  'not' => true,
                // we do not want to allow users to pick one of spam/bad usernames
                'pattern' => '/\b('.Yii::$app->params['user.spamNames'].')\b/i',
                'message' => Yii::t('app', 'It\'s impossible to have that username.')],
            ['username', 'unique', 'targetClass' => '\app\models\Users',
                 'message' => Yii::t('app', 'This username has already been taken.')],

            ['username', 'email'],
            [['password', 'first_name', 'last_name', 'denomination', 'tax_code',
            'address', 'cap', 'city', 'country'], 'required'],

            // use passwordStrengthRule() method to determine password strength
            // $this->passwordStrengthRule(),

            // // on default scenario, user status is set to active
            // ['status', 'default', 'value' => User::STATUS_ACTIVE, 'on' => 'default'],
            // // status is set to not active on rna (registration needs activation) scenario
            // ['status', 'default', 'value' => User::STATUS_INACTIVE, 'on' => 'rna'],
            // // status has to be integer value in the given range. Check User model.
            // ['status', 'in', 'range' => [User::STATUS_INACTIVE, User::STATUS_ACTIVE]]
        ];
    }


    /**
     * Returns the attribute labels.
     *
     * @return array
     */
    public function attributeLabels()
    {
        return [
            'username' => Yii::t('app', 'Email'),
            'password' => Yii::t('app', 'Password'),
            'first_name' => Yii::t('app', 'First Name'),
            'last_name' => Yii::t('app', 'Last Name'),
            'denomination' => Yii::t('app', 'Denomination'),
            'tax_code' => Yii::t('app', 'Tax Code'),
            'address' => Yii::t('app', 'Address'),
            'cap' => Yii::t('app', 'Cap'),
            'city' => Yii::t('app', 'City'),
            'country' => Yii::t('app', 'Country'),
        ];
    }

    /**
     * Signs up the user.
     * If scenario is set to "rna" (registration needs activation), this means
     * that user need to activate his account using email confirmation method.
     *
     * @return User|null The saved model or null if saving fails.
     */
    public function signup()
    {
        // echo "<pre>".print_r($_POST,true)."</pre>";
		// exit;

        if ($this->validate()) {
            // set the nonce (it will last 24 h)
            $microtime = explode(' ', microtime());
            $nonce = $microtime[1] . str_pad(substr($microtime[0], 2, 6), 6, '0');

            $randomkey = \Yii::$app->security->generateRandomString();
            $secretkey = \Yii::$app->security->generateRandomString();

            $user = new Users();
            $user->username = $this->username;
            // $user->password = $this->password;
            $user->password = \Yii::$app->getSecurity()->generatePasswordHash($this->password);
            $user->activation_code = $nonce;
            $user->status_activation_code = 0;
            $user->authKey = $secretkey;
            $user->accessToken = $randomkey;
            $user->first_name = $this->first_name;
            $user->last_name = $this->last_name;
            $user->email = $this->username;
            $user->is_merchant = 0;
            $user->denomination = $this->denomination;
            $user->tax_code = $this->tax_code;
            $user->address = $this->address;
            $user->cap = $this->cap;
            $user->city = $this->city;
            $user->country = $this->country;

            if ($user->save()){
                $this->sendAccountActivationEmail($user);
                return $user;
            } else {
                return null;
            }

            // if user is saved and role is assigned return user object
            // return $user->save() ? $user : null;
        }
        return false;


    }

    /**
     * Sends email to registered user with account activation link.
     *
     * @param  object $user Registered user.
     * @return bool         Whether the message has been sent successfully.
     */
    public function sendAccountActivationEmail($user)
    {
        return Yii::$app->mailer->compose('accountActivationToken', ['user' => $user])
            ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->name . ' robot'])
            ->setTo($user->email)
            ->setSubject(Yii::t('app','Account activation for ') . Yii::$app->name)
            ->send();
    }
}
