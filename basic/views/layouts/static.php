<?php
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use app\components\widgets\news\NewsWidget;
use app\components\widgets\metodychky\MetodychkyWidget;
use app\components\widgets\teachers\TeacherWidget;

/* @var $this \yii\web\View */
/* @var $content string */

AppAsset::register( $this );
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
        <div class="row">
            <div class="col-md-9"><?= $content ?></div>

            <div class="col-md-3">
                <?php echo NewsWidget::widget(); ?>
                <?php echo MetodychkyWidget::widget(); ?>
                <?php echo TeacherWidget::widget(); ?>
            </div>
        </div>

    </div>
</div>

<?= $this->render( '_footer' ) ?>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
