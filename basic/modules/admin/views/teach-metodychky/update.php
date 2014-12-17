<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\TeachMetodychky */

$this->title = 'Вказати, хто автор методичних вказівок: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Викладач-Методичні вказівки', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Оновити';
?>
<div class="teach-metodychky-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
