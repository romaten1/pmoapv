<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

$this->title = $name;
?>
<div class="site-error">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="alert alert-danger">
        <?= nl2br(Html::encode($message)) ?>
    </div>
	<h1>403</h1>
    <p>
        Ой... Ця помилка трапилася при обробці сервером Вашого запиту.
    </p>
    <p>
        Будь-ласка, зв'яжіться з нами, якщо Ви вважаєте, що помилка трапилася з вини сервера.
    </p>

</div>
