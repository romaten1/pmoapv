<?php
use yii\helpers\Html;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use app\assets\MainPageAsset;
use nirvana\prettyphoto\PrettyPhoto;
/* @var $this \yii\web\View */
/* @var $content string */

MainPageAsset::register($this);
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
<?= $this->render('_newyear') ?>    
    <?php $this->beginBody() ?>
<div class="">
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
