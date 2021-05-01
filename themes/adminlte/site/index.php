<div class="container-fluid">
    <div class="row">
        <?php if (Yii::$app->user->isGuest) : ?>
            <?= $this->render('landing-home') ?>
        <?php else: ?>
            <div class="col-lg-12">
                <?= $this->render('dashboard', [
                    'dataProvider'=>$dataProvider,
                    'userRequestsProvider' => $userRequestsProvider,
                ]); ?>
            </div>
        <?php endif; ?>

            <!-- <?= \hail812\adminlte3\widgets\Alert::widget([
                'type' => 'success',
                'body' => '<h3>Congratulations!</h3>',
            ]) ?>
            -->
            <!-- <?= \hail812\adminlte3\widgets\Callout::widget([
                'type' => 'danger',
                'head' => 'I am a danger callout!',
                'body' => 'There is a problem that we need to fix. A wonderful serenity has taken possession of my entire soul, like these sweet mornings of spring which I enjoy with my whole heart.'
            ]) ?> -->
    </div>
</div>
