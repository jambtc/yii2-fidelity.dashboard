<?php
use app\models\Users;
use kartik\icons\Icon;
use yii\data\ActiveDataProvider;
use yii\helpers\Url;

Icon::map($this);

$query = Users::find()
    ->andWhere(['!=', 'id', 1]);

$dataProvider = new ActiveDataProvider([
    'query' => $query,
]);

?>
<!-- small box -->
<div class="small-box bg-warning">
    <div class="inner">
        <h3><?= $dataProvider->totalCount ?></h3>
        <p><?= Yii::t('app','User registrations') ?></p>
    </div>
    <div class="icon">
        <?= Icon::show('user-check') ?>
    </div>
    <a href="<?= Url::to(['users/index']) ?>" class="small-box-footer"><?= Yii::t('app','More info') ?> <i class="fas fa-arrow-circle-right"></i></a>
</div>
