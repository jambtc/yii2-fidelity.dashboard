<?php

/* @var $this yii\web\View */

$this->title = Yii::$app->name;

if (Yii::$app->user->isGuest){
    echo $this->render('home');
} else {
    echo $this->render('dashboard', [
        'dataProvider'=>$dataProvider,
        'userRequestsProvider' => $userRequestsProvider,
    ]);
}
?>
