<?php
use \app\assets\AppAsset;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\helpers\Url;

/* @var $this \yii\web\View */
/* @var $content string */

AppAsset::register($this);
?>

<header class="header">

<?= Html::a(Yii::$app->name, Yii::$app->homeUrl, ['class' => 'logo']) ?>

<nav class="navbar navbar-static-top" role="navigation">

<a href="#" class="navbar-btn sidebar-toggle" data-toggle="offcanvas" role="button">
    <span class="sr-only">Згорнути / Розгорнути</span>
    <span class="icon-bar"></span>
    <span class="icon-bar"></span>
    <span class="icon-bar"></span>
</a>

<div class="navbar-right">

<ul class="nav navbar-nav">

    <li>
        <a href="<?= Url::toRoute('/admin/log')?>">
            <i class="glyphicon glyphicon-inbox"></i>
            <span>Logs</span>
        </a>
    </li>
    <li>
        <a href="<?= Url::toRoute('/rbac/auth-assignment')?>">
            <i class="glyphicon glyphicon-group"></i>
            <span>RBAC</span>
        </a>
    </li>
    <li>
        <a href="<?= Url::toRoute('/admin')?>">
            <i class="glyphicon glyphicon-pencil"></i>
            <span>Admin</span>
        </a>
    </li>
<?php
if (Yii::$app->user->isGuest) {
    ?>
    <li class="footer">
        <?= Html::a('Login', ['/user/security/login']) ?>
    </li>
<?php
} else {
    ?>
    <li class="dropdown user user-menu">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <i class="glyphicon glyphicon-user"></i>
            <span><?= @Yii::$app->user->identity->username ?> <i class="caret"></i></span>
        </a>
        <ul class="dropdown-menu">
            <!-- User image -->
            <li class="user-header bg-light-blue">
                <img src="<?= $directoryAsset ?>/img/avatar5.png" class="img-circle" alt="User Image"/>

                <p>
                    <?= @Yii::$app->user->identity->username ?> - Адміністратор
                    <small>Самий головний на сайті ))</small>
                </p>
            </li>
            <!-- Menu Footer-->
            <li class="user-footer">
                <div class="pull-left">
                    <?= Html::a('Профіль', ['/user/settings/profile'], ['class' => 'btn btn-default btn-flat']); ?>
                </div>
                <div class="pull-right">
                    <?= Html::a(
                            'Вихід',
                            ['/user/security/logout'],
                            ['data-method' => 'post','class'=>'btn btn-default btn-flat']
                        ) ?>
                </div>
            </li>
        </ul>
    </li><?php
}
?>
<!-- User Account: style can be found in dropdown.less -->

</ul>
</div>
</nav>
</header>
