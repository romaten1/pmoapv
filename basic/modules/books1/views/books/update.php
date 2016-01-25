<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\books\models\Books */

$this->title = 'Редактирование книги: ' . ' ' . $model->name;
?>
<div class="books-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
