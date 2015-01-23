<?php
use yii\helpers\Html;
use app\assets\AppAsset;
//use app\assets\MainPageAsset;

/**
 * Layout for index page - main page of site
 */
/* @var $this \yii\web\View */
/* @var $content string */

//MainPageAsset::register($this);
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
<?= ''; //$this->render('_newyear') ?>
    <?php $this->beginBody() ?>
<div class="header">
    <?= $this->render('_header') ?>    
    
    <div class="container">
        <?= $content ?>
    </div> 
</div>
<?= $this->render('_footer') ?>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
