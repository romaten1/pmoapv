<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\TeachMetodychky */

$this->title = 'Вказати, хто автор методичних вказівок';
$this->params['breadcrumbs'][] = ['label' => 'Викладач-Методичні вказівки', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="teach-metodychky-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
