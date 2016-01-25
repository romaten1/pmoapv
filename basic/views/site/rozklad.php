<?php
use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
$this->title                   = 'Розклад';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">
    <h1><?= Html::encode( $this->title ) ?></h1>

    <p>
        Тут ви можете скачати розклад на поточний тиждень: <br />
        <? echo ' <a href=' . Url::to( '@web/uploads/rozklad/rozklad_faculty.xls', true ) .
                ' > Розклад груп по факультету </a>';
        ?>
    </p>

    <p>
        Тут ви можете скачати розклад по викладачах кафедри на поточний тиждень: <br />
        <? echo ' <a href=' . Url::to( '@web/uploads/rozklad/rozklad_teachers.xls', true ) .
                ' > Розклад викладачiв кафедри </a>';
        ?>
    </p>
    <br>
    <h3>Розклад дзвінків </h3>

    <p>
        <? echo ' <a href="http://www.udau.edu.ua/ua/for-students/rozklad-dzvinkiv.html" > Розклад дзвінків на сайті університету  </a>';
        ?>
    </p>
</div>
