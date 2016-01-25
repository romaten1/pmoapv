<?php
use app\modules\books\assets\BookAsset;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;

/* @var $this \yii\web\View */
/* @var $content string */

BookAsset::register( $this );
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
        <div class="container">
            <div class="content" id="main-content">
                <?= $content ?>
            </div>
        </div>
    </div>

    <footer class="footer">
        <div class="container">
            <p class="pull-left">&copy; romaten1 <?= date( 'Y' ) ?></p>

            <p class="pull-right"><?= Yii::powered() ?></p>
        </div>
    </footer>
    <?php
    yii\bootstrap\Modal::begin( [
        'headerOptions' => [ 'id' => 'modalHeader' ],
        'id'            => 'modal',
        'size'          => 'modal-lg',
        //keeps from closing modal with esc key or by clicking out of the modal.
        // user must click cancel or X to close
        'clientOptions' => [ 'backdrop' => 'static', 'keyboard' => false ]
    ] );
    echo "<div id='modalContent'></div>";
    yii\bootstrap\Modal::end();
    ?>
    <?php $this->endBody() ?>
    </body>
    </html>
<?php $this->endPage() ?>