<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\SignupForm;
use app\models\Users;
use app\components\WebApp;
use app\models\PasswordResetRequestForm;
use app\models\ResetPasswordForm;

use app\models\Invoices;
use app\models\search\InvoicesSearch;
use yii\data\ActiveDataProvider;

use app\components\languageSwitcher;


define ('NONCE_TIMEOUT', 24 * 60 * 60); // 1 day

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    public function beforeAction($action)
	{
    	languageSwitcher::init();
        return parent::beforeAction($action);
	}

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
                'layout' => 'login-page',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new InvoicesSearch();
		$dataProvider = $searchModel->search(Yii::$app->request->queryParams);
		$dataProvider->setPagination(['pageSize' => 10]);
		$dataProvider->sort->defaultOrder = ['invoice_timestamp' => SORT_DESC];

        $userRequestsProvider = null;
        if (Yii::$app->user->id != 1){
            $dataProvider->query->andWhere(['=','id_user', Yii::$app->user->id]);
        } else {
            $query = Users::find()
                ->where(['is_merchant' => 0])
                ->andWhere(['!=', 'id', 1]);

            $userRequestsProvider = new ActiveDataProvider([
                'query' => $query,
                'pagination' => [
                    'pageSize' => 5,
                ],
                'sort' => [
                    'defaultOrder' => [
                        'id' => SORT_DESC,
                    ]
                ],
            ]);
        }

        if (Yii::$app->user->isGuest)
            $this->layout = 'landing-page';

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'userRequestsProvider' => $userRequestsProvider,
        ]);
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $this->layout = 'login-page';

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays register page.
     *
     * @return Response|string
     */
    public function actionRegister()
    {
        // echo "<pre>".print_r($_POST,true)."</pre>";
 		// exit;
        $this->layout = 'login-page';

        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post()) && $model->signup()) {
            Yii::$app->session->setFlash('registerFormSubmitted');
        }

        $model->password = '';
        return $this->render('register', [
            'model' => $model,
        ]);
     }

    public function actionActivate()
    {
        $this->layout = 'login-page';
        // echo "<pre>".print_r($_POST,true)."</pre>";
        // exit;
        $id = WebApp::decrypt($_GET['id']);
        // echo "<pre>".print_r($id,true)."</pre>";
        // exit;

        // check if the message is outdated
        $microtime = explode(' ', microtime());
        $nonce = $microtime[1] . str_pad(substr($microtime[0], 2, 6), 6, '0');
        $a = substr($nonce,1,9)*1;

        $user = $this->findModel($id);
        $b = substr($user->activation_code,1,9)*1;

        // echo "<pre>".print_r($a,true)."</pre>";
        // echo "<pre>".print_r($b,true)."</pre>";
        // echo "<pre>".print_r($a-$b,true)."</pre>";
        // echo "<pre>".print_r(NONCE_TIMEOUT,true)."</pre>";
        // exit;

        // if (($a - $b) > 1){
        if (($a - $b) > NONCE_TIMEOUT){
            // verifica che non sia attivo e lo cancella
            $delete = Users::find()
                ->andWhere(['id'=>$id])
                ->andWhere(['status_activation_code'=>0])
                ->one();
            if ($delete !== null) {
                $delete->delete();
                Yii::$app->session->setFlash('dataOutdated');
            } else {
                Yii::$app->session->setFlash('userActived');
            }
            // return $this->refresh();
        }
        // Now do the sign
        $sign = base64_encode(hash_hmac('sha512', hash('sha256', $user->activation_code . $user->accessToken, true), base64_decode($user->authKey), true));

        // echo "<pre>".print_r($sign,true)."</pre>";
        // echo "<pre>".print_r($_GET['sign'],true)."</pre>";
        // exit;

        // compare the two signatures
        if (strcmp($sign, $_GET['sign']) == 0){
            // echo "<pre>".print_r('sono uguali',true)."</pre>";
            $user->activation_code = '0';
            $user->accessToken = '0';
            $user->status_activation_code = 1;
            $user->save();
            // exit;
        }else{
            // echo "<pre>".print_r('sono diver',true)."</pre>";
            $delete = Users::find()
                ->andWhere(['id'=>$id])
                ->andWhere(['status_activation_code'=>0])
                ->one();
            if ($delete !== null) {
                $delete->delete();
                Yii::$app->session->setFlash('dataNotSigned');
            } else {
                Yii::$app->session->setFlash('dataOutdated');
            }
        }
        // exit;
        return $this->render('activate', [
            'model' => $user,
        ]);

    }

    /**
    * Requests password reset.
    *
    * @return mixed
    */
   public function actionRequestPasswordReset()
   {
       $this->layout = 'login-page';

       $model = new PasswordResetRequestForm();
       if ($model->load(Yii::$app->request->post()) && $model->validate()) {
           if ($model->sendEmail()) {
               Yii::$app->session->setFlash('success', 'Check your email for further instructions.');

               return $this->goHome();
           } else {
               Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for the provided email address.');
           }
       }

       return $this->render('requestPasswordResetToken', [
           'model' => $model,
       ]);
   }

   /**
    * Resets password.
    *
    * @param string $token
    * @return mixed
    * @throws BadRequestHttpException
    */
   public function actionResetPassword($token)
   {
       $this->layout = 'login-page';

       try {
           $model = new ResetPasswordForm($token);
       } catch (InvalidArgumentException $e) {
           throw new BadRequestHttpException($e->getMessage());
       }

       if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
           Yii::$app->session->setFlash('success', Yii::t('app','New password saved.'));

           return $this->goHome();
       }

       return $this->render('resetPassword', [
           'model' => $model,
       ]);
   }

    /**
     * Finds the Users model based on its user_id value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Users the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        // echo "<pre>".print_r($id,true)."</pre>";
		// exit;
        $model = Users::find()->andWhere(['id'=>$id])->one();
        if ( $model !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested user does not exist.'));
    }
}
