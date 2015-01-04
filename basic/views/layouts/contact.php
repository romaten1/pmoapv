<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use app\components\widgets\allteachers\AllteacherWidget;
use app\components\widgets\allnews\AllnewsWidget;
use nirvana\prettyphoto\PrettyPhoto;
/* @var $this \yii\web\View */
/* @var $content string */

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>

    <?php $this->beginBody() ?>
<div class="wrap">
    <?= $this->render('_header') ?>    

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            'homeLink' => ['label' => 'Головна','url' => ['/site/index']],
            ]) ?>
            <?= $content ?>
    </div>
</div>


<?= $this->render('_footer') ?>

<?php 
        PrettyPhoto::widget([
            'target' => "a[rel^='prettyPhoto']",
            'pluginOptions' => [
                'opacity' => 0.60,
                'theme' => PrettyPhoto::THEME_LIGHT_ROUNDED,
                'social_tools' => false,
                'autoplay_slideshow' => false,
                'modal' => true
            ],
        ]);        
     ?>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
