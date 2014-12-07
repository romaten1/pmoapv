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
                            ['label' => 'Про кафедру', 'url' => ['/kafedra/page', 'view'=>'about']],
                            ['label' => 'Історія кафедри', 'url' => ['/kafedra/page', 'view'=>'history']],
                            ['label' => 'Викладацький склад', 'url' => ['/teacher']],
                            ['label' => 'Методична робота', 'url' => ['/kafedra/page', 'view'=>'metod_work']],
                            ['label' => 'Організацйна робота', 'url' => ['/kafedra/page', 'view'=>'org_work']],
                            ['label' => 'Практична підготовка студентів', 'url' => ['/kafedra/page', 'view'=>'praktika']],
                            ['label' => 'Навчальні лабораторії', 'url' => ['/kafedra/page', 'view'=>'laboratory']],
                            ['label' => 'Матеріально-технічна база', 'url' => ['/kafedra/page', 'view'=>'mattehbaza']],
                            ['label' => 'Контакти', 'url' => ['/kafedra/contact']],
                        ],
                    ],
                    ['label' => 'Новини', 'url' => ['/news']],
                    ['label' => 'Абітурієнту',
                        'items' => [
                            ['label' => 'Звернення до наших абітурієнтів', 'url' => ['/abiturient/page', 'view'=>'about']],
                            ['label' => 'Напрям підготовки 6.100202 Процеси, машини та обладнання агропромислового виробництва', 'url' => ['/abiturient/page', 'view'=>'napryam']],
                            ['label' => 'Спеціальність 7.10010201  Процеси, машини та обладнання агропромислових підприємств', 'url' => ['/abiturient/page', 'view'=>'spec7']],
                            ['label' => 'Спеціальність 8.10010201  Процеси, машини та обладнання агропромислових підприємств', 'url' => ['/abiturient/page', 'view'=>'spec8']],
                            ['label' => 'Заочна форма навчання', 'url' => ['/abiturient/page', 'view'=>'zaochna']],
                        ],
                    ],
                    ['label' => 'Студенту',
                        'items' => [
                            ['label' => 'Предмети', 'url' => ['/predmet']],
                            ['label' => 'Навчальні плани', 'url' => ['/student/page', 'view'=>'plany']],
                            ['label' => 'Робочі програми', 'url' => ['/student/page', 'view'=>'programy']],
                            ['label' => 'Навчально-методичне забезпечення', 'url' => ['/metodychky']],
                            ['label' => 'Дипломнику', 'url' => ['/student/page', 'view'=>'dyplomnik']],
                            ['label' => 'Корисні посилання', 'url' => ['/student/page', 'view'=>'links']],
                            ['label' => 'Програми практики', 'url' => ['/student/page', 'view'=>'praktikprogramy']],
                        ],
                    ],
                    ['label' => 'Наукова робота',
                        'items' => [
                            ['label' => 'Напрямки наукових досліджень викладачів кафедри', 'url' => ['/nauka/page', 'view'=>'napryamy']],
                            ['label' => 'Наукова робота студентів', 'url' => ['/nauka/page', 'view'=>'student_work']],
                            ['label' => 'Наукові заходи', 'url' => ['/nauka/page', 'view'=>'zahody']],
                            ['label' => 'Пропозиції виробникам', 'url' => ['/nauka/page', 'view'=>'proposal']],
                            ['label' => 'Аспіранти кафедри', 'url' => ['/nauka/page', 'view'=>'aspirant']],
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
            <?= Breadcrumbs::widget([
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                'homeLink' => ['label' => 'Головна','url' => ['/site/index']],
            ]) ?>
            <?= $content ?>
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
