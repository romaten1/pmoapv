
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
    <div class="wrap">
        <?php
            NavBar::begin([
                'brandLabel' => 'ПМОАПВ',
                'brandUrl' => Yii::$app->homeUrl,
                'options' => [
                    'class' => 'navbar',
                ],
            ]);
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
                            ['label' => 'Напрямки наукових досліджень викладачів кафедри', 'url' => ['/static-page/view', 'alias'=>'napryamy-nauki']],
                            ['label' => 'Наукова робота студентів', 'url' => ['/static-page/view-alias', 'alias'=>'student_work']],
                            ['label' => 'Наукові заходи', 'url' => ['/static-page/view-alias', 'alias'=>'zahody']],
                            ['label' => 'Пропозиції виробникам', 'url' => ['/static-page/view-alias', 'alias'=>'proposal']],
                            ['label' => 'Аспіранти кафедри', 'url' => ['/static-page/view-alias', 'alias'=>'aspirant']],
                        ],
                    ],
                    Yii::$app->user->isGuest ?
                        ['label' => 'Вхід на сайт', 'url' => ['/site/login']] :
                        ['label' => 'Вийти (' . Yii::$app->user->identity->username . ')',
                            'url' => ['/site/logout'],
                            'linkOptions' => ['data-method' => 'post']],
                ],
            ]);
            NavBar::end();
        ?>

        <div class="container">
            
	        <div class="row">    
	            <div class="col-xs-2">
	            	<ul class="nav nav-list">
                      <li class="nav-header btn btn-primary">Новини</li>
                      <li><a href="<?= Url::to(['/admin/news'])?>">Журнал</a></li>
                      <li><a href="<?= Url::to(['/admin/news/create'])?>">Створити</a></li>
                      <li class="nav-header btn btn-success">Статичні сторінки</li>
                      <li><a href="<?= Url::to(['/admin/static-page'])?>">Журнал</a></li>
                      <li><a href="<?= Url::to(['/admin/static-page/create'])?>">Створити</a></li>
                      <li class="nav-header btn btn-danger">Викладачі</li>
                      <li><a href="<?= Url::to(['/admin/teacher'])?>">Журнал</a></li>
                      <li><a href="<?= Url::to(['/admin/teacher/create'])?>">Створити</a></li>
                      <li class="nav-header btn btn-warning">Предмети</li>
                      <li><a href="<?= Url::to(['/admin/predmet'])?>">Журнал</a></li>
                      <li><a href="<?= Url::to(['/admin/predmet/create'])?>">Створити</a></li>
                      <li class="nav-header btn btn-info">Методичні вказівки</li>
                      <li><a href="<?= Url::to(['/admin/metodychky'])?>">Журнал</a></li>
                      <li><a href="<?= Url::to(['/admin/metodychky/create'])?>">Створити</a></li>
                    </ul>
	            </div>
	            <div class="col-xs-10">
	            	<?= $content ?>
	            </div>
	        </div>    
        </div>
    </div>

    <footer class="footer">
        <div class="container">
            <div class="col-md-7">
                <address>
                  <strong>&copy; ПМОАПВ <?= date('Y') ?></strong><br>
                  м. Умань, пров. Інтернаціональний, 1<br>
                  <abbr title="Phone">Тел:</abbr> (04744) 3-98-37, 3-98-93
                  <abbr title="Mail">E-mail:</abbr> pmoapv@meta.ua, kafedra.pmo@gmail.com
                </address>
            </div>
            <p class="pull-right"><?= Yii::powered() ?></p>
        </div>
    </footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
