<?php
use app\modules\customer\assets\CustomerAsset;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Breadcrumbs;

/* @var $this \yii\web\View */
/* @var $content string */

CustomerAsset::register( $this );
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
        <?php
        NavBar::begin( [
            'brandLabel' => 'Покупатели и заказы',
            'brandUrl'   => Url::to( [ '/customer' ] ),
            'options'    => [
                'class' => 'navbar',
            ],
        ] );
        echo Nav::widget( [
            'options' => [ 'class' => 'navbar-nav navbar-right' ],
            'items'   => [
                [ 'label' => 'Покупатели', 'url' => [ '/customer' ] ],
                [ 'label' => 'Заказы', 'url' => [ '/customer/customer-order' ] ],
            ],
        ] );

        NavBar::end();
        ?>
        <div class="container">
            <?= Breadcrumbs::widget( [
                'links'    => isset( $this->params['breadcrumbs'] ) ? $this->params['breadcrumbs'] : [ ],
                'homeLink' => [ 'label' => 'Головна', 'url' => [ '/site/index' ] ],
            ] ) ?>
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