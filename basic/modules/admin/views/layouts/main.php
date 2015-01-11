
<?php
use yii\helpers\Html;
use yii\helpers\Url;
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
                    ['label' => 'Про кафедру',
                        'items' => [
                            ['label' => 'Про кафедру', 'url' => ['/static-page/view-alias', 'alias'=>'about']],
                            ['label' => 'Історія кафедри', 'url' => ['/static-page/view-alias', 'alias'=>'history']],
                            ['label' => 'Викладацький склад', 'url' => ['/teacher']],
                            ['label' => 'Методична робота', 'url' => ['/static-page/view-alias', 'alias'=>'metod_work']],
                            ['label' => 'Організацйна робота', 'url' => ['/static-page/view-alias', 'alias'=>'org_work']],
                            ['label' => 'Практична підготовка студентів', 'url' => ['/static-page/view-alias', 'alias'=>'praktika']],
                            ['label' => 'Навчальні лабораторії', 'url' => ['/static-page/view-alias', 'alias'=>'laboratory']],
                            ['label' => 'Матеріально-технічна база', 'url' => ['/static-page/view-alias', 'alias'=>'mattehbaza']],
                            ['label' => 'Контакти', 'url' => ['/site/contact']],
                        ],
                    ],
                    ['label' => 'Новини', 'url' => ['/news']],
                    ['label' => 'Абітурієнту',
                        'items' => [
                            ['label' => 'Звернення до наших абітурієнтів', 'url' => ['/static-page/view-alias', 'alias'=>'zvernennya']],
                            ['label' => 'Напрям підготовки 6.100202 Процеси, машини та обладнання агропромислового виробництва', 'url' => ['/static-page/view-alias', 'alias'=>'napryam']],
                            ['label' => 'Спеціальність 7.10010201  Процеси, машини та обладнання агропромислових підприємств', 'url' => ['/static-page/view-alias', 'alias'=>'spec7']],
                            ['label' => 'Спеціальність 8.10010201  Процеси, машини та обладнання агропромислових підприємств', 'url' => ['/static-page/view-alias', 'alias'=>'spec8']],
                            ['label' => 'Заочна форма навчання', 'url' => ['/static-page/view-alias', 'alias'=>'zaochna']],
                        ],
                    ],
                    ['label' => 'Студенту',
                        'items' => [
                            ['label' => 'Предмети', 'url' => ['/predmet']],
                            ['label' => 'Навчальні плани', 'url' => ['/static-page/view-alias', 'alias'=>'plany']],
                            ['label' => 'Робочі програми', 'url' => ['/static-page/view-alias', 'alias'=>'programy']],
                            ['label' => 'Навчально-методичне забезпечення', 'url' => ['/metodychky']],
                            ['label' => 'Дипломнику', 'url' => ['/static-page/view-alias', 'alias'=>'dyplomnik']],
                            ['label' => 'Корисні посилання', 'url' => ['/static-page/view-alias', 'alias'=>'links']],
                            ['label' => 'Програми практики', 'url' => ['/static-page/view-alias', 'alias'=>'praktikprogramy']],
                        ],
                    ],
                    ['label' => 'Наукова робота',
                        'items' => [
                            ['label' => 'Напрямки наукових досліджень викладачів кафедри', 'url' => ['/static-page/view-alias', 'alias'=>'napryamy-nauki']],
                            ['label' => 'Наукова робота студентів', 'url' => ['/static-page/view-alias', 'alias'=>'student_work']],
                            ['label' => 'Наукові заходи', 'url' => ['/static-page/view-alias', 'alias'=>'zahody']],
                            ['label' => 'Пропозиції виробникам', 'url' => ['/static-page/view-alias', 'alias'=>'proposal']],
                            ['label' => 'Аспіранти кафедри', 'url' => ['/static-page/view-alias', 'alias'=>'aspirant']],
                        ],
                    ],
                    !Yii::$app->user->isGuest ?
                        ['label' => 'Admin', 'url' => ['/admin']] : '',
                    !Yii::$app->user->isGuest ?
                        ['label' => 'Профіль', 'url' => ['/user/settings/profile']] : '',
                    Yii::$app->user->isGuest ?
                        ['label' => 'Вхід на сайт', 'url' => ['/site/login']] :
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
                                          
	            </div>
	            <div class="col-xs-9">
	            	<?= $content ?>
	            </div>
	        </div>    
        </div>
    </div>

    

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
