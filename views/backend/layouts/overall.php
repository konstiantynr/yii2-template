<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\assets\BackendAsset;
use yii\helpers\Html;
use yii\widgets\Breadcrumbs;
use yii2tech\admin\widgets\Alert;

BackendAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/x-icon" href="<?= Yii::$app->urlManager->baseUrl; ?>/css/backend/images/favicon.ico">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?= $this->render('/layouts/mainMenu'); ?>

    <div class="container-fluid">
        <?php if (!Yii::$app->user->isGuest) : ?>
            <?= Breadcrumbs::widget([
                'homeLink' => [
                    'label' => Yii::t('admin', 'Administration'),
                    'url' => Yii::$app->homeUrl,
                ],
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            ]) ?>
            <?= Alert::widget() ?>
        <?php endif; ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p>&copy; <?= Yii::$app->name ?> <?= date('Y') ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
