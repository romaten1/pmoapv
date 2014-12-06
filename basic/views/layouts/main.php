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
                    'class' => 'navbar navbar-fixed-top',
                ],
            ]);
            echo Nav::widget([
                'options' => ['class' => 'navbar-nav navbar-right'],
                'items' => [
                    ['label' => 'Про кафедру',
                        'items' => [
                            ['label' => 'Про кафедру', 'url' => ['/kafedra/page', 'view'=>'about']],
                            ['label' => 'Історія кафедри', 'url' => ['/kafedra/page', 'view'=>'history']],
                            ['label' => 'Викладацький склад', 'url' => ['/teachers']],
                            ['label' => 'Методична робота', 'url' => ['/kafedra/page', 'view'=>'metod_work']],
                            ['label' => 'Організацйна робота', 'url' => ['/kafedra/page', 'view'=>'org_work']],
                            ['label' => 'Практична підготовка студентів', 'url' => ['/kafedra/page', 'view'=>'praktika']],
                            ['label' => 'Навчальні лабораторії', 'url' => ['/kafedra/page', 'view'=>'laboratory']],
                            ['label' => 'Матеріально-технічна база', 'url' => ['/kafedra/page', 'view'=>'mattehbaza']],
                            ['label' => 'Контакти', 'url' => ['/kafedra/contact']],
                        ],
                    ],
                    ['label' => 'Новини', 'url' => ['/site/about']],
                    ['label' => 'Абітурієнту',
                        'items' => [
                            ['label' => 'Звернення до наших абітурієнтів', 'url' => ['/abiturient/about']],
                            ['label' => 'Напрям підготовки 6.100202 Процеси, машини та обладнання агропромислового виробництва ', 'url' => ['/abiturient/napryam']],
                            ['label' => 'Спеціальність 7.10010201  Процеси, машини та обладнання агропромислових підприємств', 'url' => ['/abiturient/spec7']],
                            ['label' => 'Спеціальність 8.10010201  Процеси, машини та обладнання агропромислових підприємств', 'url' => ['/abiturient/spec8']],
                            ['label' => 'Заочна форма навчання', 'url' => ['/abiturient/zaochna']],
                        ],
                    ],
                    ['label' => 'Студенту',
                        'items' => [
                            ['label' => 'Предмети', 'url' => ['/predmet']],
                            ['label' => 'Навчальні плани', 'url' => ['/student/plany']],
                            ['label' => 'Робочі програми', 'url' => ['/student/teachers']],
                            ['label' => 'Навчально-методичне забезпечення', 'url' => ['/metodychky']],
                            ['label' => 'Дипломнику', 'url' => ['/student/dyplomnik']],
                            ['label' => 'Корисні посилання', 'url' => ['/student/links']],
                            ['label' => 'Програми практики', 'url' => ['/student/praktikprogramy']],
                        ],
                    ],
                    ['label' => 'Наукова робота',
                        'items' => [
                            ['label' => 'Напрямки наукових досліджень викладачів кафедри', 'url' => ['/nauka/napryamy']],
                            ['label' => 'Наукова робота студентів', 'url' => ['/nauka/student_work']],
                            ['label' => 'Наукові заходи', 'url' => ['/nauka/zahody']],
                            ['label' => 'Пропозиціії виробникам', 'url' => ['/nauka/proposal']],
                            ['label' => 'Аспіранти кафедри', 'url' => ['/nauka/aspirant']],
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
            ]) ?>
            <?= $content ?>
        </div>
    </div>

    <footer class="footer">
        <div class="container">
            <p class="pull-left">&copy; ПМОАПВ <?= date('Y') ?></p>
            <p class="pull-right"><?= Yii::powered() ?></p>
        </div>
    </footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
