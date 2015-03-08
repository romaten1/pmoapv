<?php
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use app\assets\AccordeonAsset;

/* @var $this \yii\web\View */
/* @var $content string */

AppAsset::register( $this );
AccordeonAsset::register( $this );
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode( $this->title ) ?></title>
    <?php $this->head() ?>
</head>
<body>

<?php $this->beginBody() ?>
<div class="wrap">
    <?= $this->render( '_header' ) ?>

    <div class="container">
        <?= Breadcrumbs::widget( [
            'links'    => isset( $this->params['breadcrumbs'] ) ? $this->params['breadcrumbs'] : [ ],
            'homeLink' => [ 'label' => 'Головна', 'url' => [ '/site/index' ] ],
        ] ) ?>

        <?= $content ?>


    </div>
</div>

<?= $this->render( '_footer' ) ?>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
