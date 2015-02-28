
<?php
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

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
    <div class="container-fluid">
        <?php
            NavBar::begin([
                'brandLabel' => 'ПМОАПВ',
                'brandUrl' => Yii::$app->homeUrl,
                'innerContainerOptions' => [
                    'class' => 'container-fluid',
                ],
                'options' => [
                    'class' => 'navbar',
                ],
            ]);
            echo '<div class="container-fluid">';
            echo Nav::widget([
                'options' => ['class' => 'navbar-nav navbar-right'],
                'items' => [
	                ['label' => 'RBAC', 'url' => ['/rbac/auth-assignment']],
	                ['label' => 'Admin', 'url' => ['/admin']],
                    ['label' => 'Профіль', 'url' => ['/user/settings/profile']],
                    ['label' => 'Вийти (' . Yii::$app->user->identity->username . ')',
                        'url' => ['/site/logout'],
                        'linkOptions' => ['data-method' => 'post']],
                ],
            ]);
             echo '</div>';
            NavBar::end();
        ?>

        <div class="container-fluid">
            
	        <div class="row">    
	            
                <div class="col-xs-2">
                    <br />
                    <div class="panel panel-primary">
                        <div class="panel-heading"><h3 class="panel-title">Повідомлення</h3></div>                        
                        <div class="panel-body">
                            <?= Html::a('Повідомлення гостей', ['/admin/contacts']) ?><br />
                            <?= Html::a('Повідомлення юзерів', ['/admin/message']) ?>
                        </div>
                    </div>                    
                    <div class="panel panel-primary">
                        <div class="panel-heading"><h3 class="panel-title"><?= Html::a('Новини', ['/admin/news']) ?></h3></div>
                        <div class="panel-body">
                            <?= Html::a('Створити', ['/admin/news/create']) ?><br />
                            <?= Html::a('Новини викладачів', ['/admin/teacher-news']) ?>
                        </div>
                    </div>
	            	<div class="panel panel-primary">
                        <div class="panel-heading"><h3 class="panel-title"><?= Html::a('Статичні сторінки', ['/admin/static-page']) ?></h3></div>
                        <div class="panel-body">
                            <?= Html::a('Створити', ['/admin/static-page/create']) ?><br />
                            <?= Html::a('Категорії', ['/admin/parent-group']) ?>
                        </div>
                    </div>
                    <div class="panel panel-primary">
                        <div class="panel-heading"><h3 class="panel-title"><?= Html::a('Викладачі', ['/admin/teacher']) ?></h3></div>
                        <div class="panel-body">
                            <?= Html::a('Створити', ['/admin/teacher/create']) ?><br />
                            <?= Html::a('Викладач::Предмет', ['/admin/teach-predmet']) ?><br />
                            <?= Html::a('Викладач::Методичка', ['/admin/teach-metodychky']) ?><br />
                            <?= Html::a('Предмет::Методичка', ['/admin/predmet-metodychky']) ?>
                        </div>
                    </div>
                    <div class="panel panel-primary">
                        <div class="panel-heading"><h3 class="panel-title"><?= Html::a('Предмети', ['/admin/predmet']) ?></h3></div>
                        <div class="panel-body">
                            <?= Html::a('Створити', ['/admin/predmet/create']) ?>
                        </div>
                    </div>
                    <div class="panel panel-primary">
                        <div class="panel-heading"><h3 class="panel-title"><?= Html::a('Методичні вказівки', ['/admin/metodychky']) ?></h3></div>
                        <div class="panel-body">
                            <?= Html::a('Створити', ['/admin/metodychky/create']) ?>
                        </div>
                    </div>
                    <div class="panel panel-primary">
                        <div class="panel-heading"><h3 class="panel-title">Користувачі</h3></div>
                        <div class="panel-body">
                            <?= Html::a('Список користувачів', ['/user/admin/index']) ?>
                        </div>
                    </div>
                                          
	            </div>
                
	            <div class="col-xs-9">
                    
                        <?= Breadcrumbs::widget([
                            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                            'homeLink' => ['label' => 'Головна','url' => ['/site/index']],
                            ]) ?>
                            <?= $content ?>
                            	
	            </div>
	        </div>    
        </div>
    </div>

    

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
