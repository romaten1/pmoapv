<?php
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use app\modules\admin\modules\rbac\models\AuthAssignment;
// Визначаємо роль користувача і отримуємо об'єкт моделі AuthAssignment
$assignment = AuthAssignment::find()->where(["user_id" => Yii::$app->user->id])->one();
?>

<?php
NavBar::begin([
    'brandLabel' => 'ПМОАПВ',
    'brandUrl' => Yii::$app->homeUrl,
    'options' => [
        'class' => 'navbar',
    ],
]);
?>

<?php
echo Nav::widget([
    'options' => ['class' => 'navbar-nav navbar-right'],
    'items' => [
        ['label' => 'Пошук на сайті', 'url' => ['/site/search']],
        Yii::$app->user->can('admin') ?
            ['label' => 'Admin', 'url' => ['/admin']] : '',
	    !Yii::$app->user->isGuest ?
		    ['label' => 'Тестування', 'url' => 'http://pmoapv.pp.ua/opentest'] : '',
	    !Yii::$app->user->isGuest ?
            ['label' => 'Профіль', 'url' => ['/user/settings/profile']] : '',
	    // Перевіряємо чи користувач - студент і тоді виводимо посилання на сторінку студента
	    ($assignment->item_name == 'student' ) ?
		    ['label' => 'Сторінка студента', 'url' => ['/student']] : '',
        Yii::$app->user->can('moderator') ?
            ['label' => 'Модерація', 'url' => ['/moderator']] : '',
        ['label' => 'Контакти', 'url' => ['/site/contact']],
        Yii::$app->user->isGuest ?
            ['label' => 'Реєстрація', 'url' => ['/user/registration/register']] : '',
        !Yii::$app->user->isGuest ?
            ['label' => 'Повідомлення', 'url' => ['/message']] : '',
        Yii::$app->user->isGuest ?
            ['label' => 'Вхід на сайт', 'url' => ['/user/security/login']] :
            ['label' => 'Вийти (' . Yii::$app->user->identity->username . ')',
                'url' => ['/user/security/logout'],
                'linkOptions' => ['data-method' => 'post']],
    ],
]);
NavBar::end();

NavBar::begin([
	'options' => [
        'class' => 'navbar  navbar-down',
    ],
]);
echo Nav::widget([
    'options' => ['class' => 'navbar-nav navbar-left'],
    'items' => [
        ['label' => 'Про кафедру',
            'items' => [
                ['label' => 'Про кафедру', 'url' => ['/static-page/view-alias', 'alias' => 'about']],
                ['label' => 'Історія кафедри', 'url' => ['/static-page/view-alias', 'alias' => 'history']],
                ['label' => 'Викладацький склад', 'url' => ['/teacher']],
	            ['label' => 'Майстри та лаборанти', 'url' => ['/teacher/master']],
                ['label' => 'Методична робота', 'url' => ['/static-page/view-alias', 'alias' => 'metod_work']],
                ['label' => 'Організаційна робота', 'url' => ['/static-page/view-alias', 'alias' => 'org_work']],
                ['label' => 'Практична підготовка студентів', 'url' => ['/static-page/view-alias', 'alias' => 'praktika']],
                ['label' => 'Навчальні лабораторії', 'url' => ['/static-page/view-alias', 'alias' => 'laboratory']],
                ['label' => 'Матеріально-технічна база', 'url' => ['/static-page/view-alias', 'alias' => 'mattehbaza']],
            ],
        ],
        ['label' => 'Новини',
            'items' => [
                ['label' => 'Новини кафедри', 'url' => ['/news']],
                ['label' => 'Новини викладачів', 'url' => ['/teacher-news']],
            ],
        ],
        ['label' => 'Абітурієнту',
            'items' => [
                ['label' => 'Абітурієнту', 'url' => ['/site/abiturient']],
                ['label' => 'Напрям підготовки 6.100202 Процеси, машини та обладнання агропромислового виробництва', 'url' => ['/static-page/view-alias', 'alias' => 'napryam']],
                ['label' => 'Спеціальність 7.10010201  Процеси, машини та обладнання агропромислових підприємств', 'url' => ['/static-page/view-alias', 'alias' => 'spec7']],
                ['label' => 'Спеціальність 8.10010201  Процеси, машини та обладнання агропромислових підприємств', 'url' => ['/static-page/view-alias', 'alias' => 'spec8']],
                ['label' => 'Заочна форма навчання', 'url' => ['/static-page/view-alias', 'alias' => 'zaochna']],
            ],
        ],
        ['label' => 'Студенту',
            'items' => [
                ['label' => 'Предмети', 'url' => ['/predmet']],
                ['label' => 'Навчальні плани', 'url' => ['/static-page/view-alias', 'alias' => 'plany']],
                ['label' => 'Робочі програми', 'url' => ['/static-page/view-alias', 'alias' => 'programy']],
                ['label' => 'Навчально-методичне забезпечення', 'url' => ['/metodychky']],
                ['label' => 'Дипломнику', 'url' => ['/static-page/view-alias', 'alias' => 'dyplomnik']],
                ['label' => 'Корисні посилання', 'url' => ['/static-page/view-alias', 'alias' => 'links']],
                ['label' => 'Програми практики', 'url' => ['/static-page/view-alias', 'alias' => 'praktikprogramy']],
            ],
        ],
        ['label' => 'Наукова робота',
            'items' => [
                ['label' => 'Напрямки наукових досліджень викладачів кафедри', 'url' => ['/static-page/view-alias', 'alias' => 'napryamy-nauki']],
                ['label' => 'Наукова робота студентів', 'url' => ['/static-page/view-alias', 'alias' => 'student_work']],
                ['label' => 'Наукові заходи', 'url' => ['/conference']],
	            ['label' => 'Статті наукових заходів', 'url' => ['/conference/conference-article']],
	            ['label' => 'Пропозиції виробникам', 'url' => ['/static-page/view-alias', 'alias' => 'proposal']],
                ['label' => 'Аспіранти кафедри', 'url' => ['/static-page/view-alias', 'alias' => 'aspirant']],
            ],
        ],
    ],
]);
NavBar::end();

?>