<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\web\HttpException;
use yii\filters\VerbFilter;
use app\components\languageSwitcher;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use yii\db\ActiveRecord;

use app\models\Notifications;
use app\models\NotificationsReaders;

use yii\helpers\Json;
use yii\helpers\Url;
use yii\helpers\Html;

use app\components\WebApp;


class BackendController extends \yii\web\Controller
{
	public function beforeAction($action)
	{
    	languageSwitcher::init();
        return parent::beforeAction($action);
	}

	public function actionNotifications()
	{

		// echo "<pre>".print_r($_POST,true)."</pre>";
		// exit;

		$news = NotificationsReaders::find()
 	     		->andWhere(['id_user'=>Yii::$app->user->id])
				->latest()
 	    		->all();

				// echo "<pre>".print_r($news,true)."</pre>";
				// exit;

	   $response['countedRead'] = 0;
	   $response['countedUnread'] = 0;
	   $response['htmlTitle'] = '';
	   $response['htmlContent'] = ''; // ex content
	   $response['playSound'] = false;
	   $response['playAlarm'] = false;

	   foreach ($news as $key => $item) {
		   ($item->alreadyread == 0 ? $response['countedUnread'] ++ : $response['countedRead'] ++);
	   }

	   $x=1;
	   foreach ($news as $key => $item) {
		   // echo "<pre>".print_r($item,true)."</pre>";
		   // exit;

		    if ($x == 1){
			    $response['htmlTitle'] .= '
			   		<span class="dropdown-header">'
					.Html::encode(\Yii::t('app',
						'You have {n,plural,=0{read all messages.} =1{one unread message.} other{# unread messages.}}', ['n' => $response['countedUnread']]
					)).
					'</span>
			   		<div class="dropdown-divider"></div>';


			   // <li>
		 		// 	 <div class="d-flex align-items-center justify-content-between">
		 		// 		 <div class="d-flex align-items-center">
		 		// 		   <div class="coin-name notify-htmlTitle">'
				// 	   . Html::encode(\Yii::t('app',
				// 		   'You have {n,plural,=0{read all messages.} =1{one unread message.} other{# unread messages.}}', ['n' => $response['countedUnread']]
				// 	   ))
				// 	   .'</div>
		 		// 		 </div>
		 		// 		 <div class="notify-readAll">
		 		// 		   <a href="#" onclick="notify.openAllEnvelopes();"><small class="text-muted d-block">'. Yii::t('app','Mark all as read') .'</small></a>
		 		// 		 </div>
		 		// 	   </div>
		 		//  </li>';
		   }
		   // Leggo la notifica tramite key
		   $notify = Notifications::find()
 		  			->andWhere(['id'=>$item->id_notification])
 		  			->one();

		   //$notify = Notifications::model()->findByPk($item->id_notification);
		   $notifi__icon = WebApp::Icon($notify->type);
		   $notifi__color = WebApp::Color($notify->status);

		   // verifico che sia un allarme
		   if ($notify->type == 'alarm' && $item->alreadyread == 0)
			   $response['playAlarm'] = true;


			$parsedurl = parse_url($notify->url);
			// echo "<pre>".print_r($parsedurl,true)."</pre>";exit;
			$query = '';
			if (isset($parsedurl['query']))
				$query = $parsedurl['query'];

			$classUnread = 'font-weight-light';
			if ($item->alreadyread == 0) {
				$classUnread = 'font-weight-normal';
			}

			// $response['htmlContent'] .= '
				// <a 	onclick="notify.openEnvelope('.$notify->id.');"
				// 	href="'.htmlentities('index.php?'. $query) .'"
				// 	id="news_'.$notify->id.'"
				// 	class="dropdown-item '.$classUnread.'">
				// 	<i class="'.$notifi__icon.' mr-2"></i> '
				// 	.Yii::t('app',$notify->description).'
				// 	<span class="float-right text-muted text-sm">'
				// 	.Yii::$app->formatter->asRelativeTime($notify->timestamp).'
				// 	</span>
				// </a>
			// 	<div class="dropdown-divider"></div>';

			$response['htmlContent'] .= '
			<div class="media">
				<a 	onclick="notify.openEnvelope('.$notify->id.');"
					href="'.htmlentities('index.php?'. $query) .'"
					id="news_'.$notify->id.'"
					class="dropdown-item ">


			  		<div class="media-body">
						<h3 class="dropdown-item-title">
				  			<!-- New message -->
				  			<span class="float-right text-sm '.$notifi__color.'">
								<i class="'.$notifi__icon.'"></i>
							</span>
						</h3>
						<p class="text-sm '.$classUnread.'">'.Yii::t('app',$notify->description).'</p>
						<p class="text-sm text-muted">
							<i class="far fa-clock mr-1"></i>'
						 	.Yii::$app->formatter->asRelativeTime($notify->timestamp).'
						</p>
			  		</div>
				</a>
			</div>
			<div class="dropdown-divider"></div>';



			// <li class='.$classUnread.'>
			// <a onclick="notify.openEnvelope('.$notify->id.');"
			// 	href="'.htmlentities('index.php?'. $query) .'"
			// 	id="news_'.$notify->id.'">
	   		// 	<div class="d-flex align-items-center justify-content-between">
	        //            <div class="d-flex align-items-center">
	        //                <div class="notice-icon available" style="min-width:30px;">
	        //                    <i class="'.$notifi__icon.'"></i>
	        //                </div>
	        //                <div class="ml-10">
	        //                  <p class="coin-name">'.Yii::t('app',$notify->description).'</p>
			//
			// 				 <div class="text-right">';
			// 				 // se il tipo notifica è help o contact ovviamente non mostro il prezzo della transazione
			// 				 if ($notify->type <> 'help'
			// 						 && $notify->type <> 'contact'
			// 						 && $notify->type <> 'alarm'
			// 				 ){
			// 					 $response['htmlContent'] .= '<b class="d-block mb-0 float-left txt-dark">'.$notify->price.'</b>';
			// 					 //VERIFICO QUESTE ULTIME 3 TRANSAZIONI PER AGGIORNARE IN REAL-TIME LO STATO (IN CASO CI SI TROVA SULLA PAGINA TRANSACTIONS)
			// 					 //$response['status'][$notify->id_tocheck] = $notify->status;
			// 				 }
			// 				 $response['htmlContent'] .= '
			// 					 <small class="text-muted">'.Yii::$app->formatter->asRelativeTime($notify->timestamp).'</small>
			// 				 </div>
			//
			//
	        //                </div>
	        //            </div>
	        //        </div>
			//    </a>
	   		// </li>';


		    $x++;
		   	if ($x>3) break;
	    }
	    if ($response['countedRead'] == 0 && $response['countedUnread'] == 0){
			$response['htmlContent'] .= '
				<span class="dropdown-header">'
					. Yii::t('app','You have no messages to read.') . '
				</span>
				<div class="dropdown-divider"></div>';
	    }else{
		    $response['htmlContent'] .= '
			<a 	href="'.htmlentities(Url::to(['notifications/index'])).'"
				onclick="notify.openAllEnvelopes();"
				class="notify-readAll dropdown-item dropdown-footer text-muted">'
				.Yii::t('app','See and mark all as read').
			'</a>';
	   }

	   Yii::$app->response->format = Response::FORMAT_JSON;
	   return $response;

	}

	// aggiorna solo la notifica in "letta"
	// update one row
	public function actionUpdateSingleNews(){
		$update = NotificationsReaders::updateAll(
			[
				'alreadyread' => NotificationsReaders::STATUS_READ
			],
			[
				'like', 'id_notification', $_POST['id_notification'],
			]
		);

		Yii::$app->response->format = Response::FORMAT_JSON;
		return ['success'=>true,'response'=>$update];
	}

	// aggiorna tutte le notifiche in "letta"
	// update all rows
	public function actionUpdateAllNews(){
		// UPDATE `customer` SET `status` = 1 WHERE `email` LIKE `%@example.com%`
		$update = NotificationsReaders::updateAll(
			[
				'alreadyread' => NotificationsReaders::STATUS_READ
			],
			[
				'like', 'id_user', Yii::$app->user->id
			]
		);

		Yii::$app->response->format = Response::FORMAT_JSON;
		return ['success'=>true,'response'=>$update];
	}






}
