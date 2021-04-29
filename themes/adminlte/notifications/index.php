<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use app\components\WebApp;
use app\models\Users;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\NotificationsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Notifications');
$this->params['breadcrumbs'][] = $this->title;

$deleteUrl = Url::to(['/notifications/delete']);
$deleteMessage = Yii::t('app','Are you sure you want to delete selected items?');

$deleting = <<<JS


    $(function(){
        // intercetta il pulsante Remove PIN e mostra la schermata di inserimento pin
        if ($('.btn-delete').length){
            var deleteNotificationButton = document.querySelector('.btn-delete');
            deleteNotificationButton.addEventListener('click', function(){
                if (confirm('{$deleteMessage}')) {
                    var keys = $('#notifications-form').yiiGridView('getSelectedRows');
                    console.log('[delete] valori selezionati:',keys);
                    $.ajax({
                        url: '{$deleteUrl}',
                        data: {
                            keys: JSON.stringify(keys),
                        },
                        type: "POST",
                        success: function(result) {
                            // reload page from redirect
                        }
                    });
                }
            });
        }
    });
JS;

$this->registerJs(
    $deleting,
    yii\web\View::POS_READY, //POS_END
    'deleting'
);
?>

<div class="row">
    <div class="col-md-12">
        <div class="card card-primary px-3">

            <div class="card-header border-transparent ">
                <h3 class="card-title "><?= $this->title ?></h3>
                <?php  if ($dataProvider->totalCount >0) { ?>
                    <?= Html::button('<i class="fas fa-times"></i> '. Yii::t('app', 'Delete'), [
                    'class' => 'btn btn-danger btn-delete float-right',
                    ]) ?>
                <?php } ?>
            </div>
            <!-- /.card-header -->
            <div class="card-body p-0">
                <div class="table-responsive">
                    

                    <?= GridView::widget([
                        'id' => 'notifications-form',
                        'dataProvider' => $dataProvider,
                        'layout' => "{summary}\n{items}\n{pager}",
                        'tableOptions' => ['class' => 'table m-0 table-striped'],
                            'columns' => [
                                [
                                    'class' => 'yii\grid\CheckboxColumn',
                                    'name' => 'id',
                                ],
                                // ['class' => 'yii\grid\SerialColumn'],

                                // 'id',
                                // 'id_user',
                                [
                                    'attribute' => 'id_user',
                                    'format' => 'raw',
                                    'value' => function ($data) {
                                        $id = WebApp::encrypt($data->id_user);
                                        $user = Users::findOne($data->id_user);
                                        return Html::a($user->username, Url::toRoute(['/users/view', 'id' => $id]),
                                                [
                                                    'class' => 'badge badge-success center-block text-truncate',
                                                    'style' => 'max-width: 250px;'
                                                ]
                                            );
                                    },
                                    'visible' => (Yii::$app->user->id == 1) ? true : false,
                                ],
                                'notification.timestamp:datetime',
                                'notification.type',
                                'notification.status',
                                'notification.description:ntext',
                                //'url:ntext',
                                //'price',

                                // ['class' => 'yii\grid\ActionColumn'],
                            ],
                        ]); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
