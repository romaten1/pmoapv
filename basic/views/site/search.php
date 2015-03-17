<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
$this->title                   = 'Пошук на сайті';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-search">
    <h1><?= Html::encode( $this->title ) ?></h1>
    <p>
        Нажаль, для повноцінного пошуку посайту необхідна його повна індексація в Google. Тому якщо ви не знайшли потрібної інформації з допомогою поля пошуку,
        спробуйте знайти її вручну в методичних вказівках, предметах, новинах, статтях конференцій на сайті.
    </p>
    <div>
        <script>
            (function () {
                var cx = '012701224349783413853:6wzzz7wz3bs';
                var gcse = document.createElement('script');
                gcse.type = 'text/javascript';
                gcse.async = true;
                gcse.src = (document.location.protocol == 'https:' ? 'https:' : 'http:') +
                '//www.google.com/cse/cse.js?cx=' + cx;
                var s = document.getElementsByTagName('script')[0];
                s.parentNode.insertBefore(gcse, s);
            })();
        </script>
        <gcse:search></gcse:search>
    </div>

</div>

