<?php
use app\assets\MainPageAsset;
use yii\helpers\Html;
use app\assets\AppAsset;

//use app\assets\MainPageAsset;

/**
 * Layout for index page - main page of site
 */
/* @var $this \yii\web\View */
/* @var $content string */

MainPageAsset::register($this);
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
<?= ''; //$this->render('_newyear')  ?>
<?php $this->beginBody() ?>
<div class="header">
    <?= $this->render( '_header' ) ?>

    <div class="container">
        <?= $content ?>
    </div>
</div>
<?= $this->render( '_footer' ) ?>
<script>
    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
        (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
        m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
    })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

    ga('create', 'UA-64512529-1', 'auto');
    ga('send', 'pageview');

</script>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
