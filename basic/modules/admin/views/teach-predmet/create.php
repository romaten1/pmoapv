<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\TeachPredmet */

$this->title = 'Вказати, хто веде предмет';
$this->params['breadcrumbs'][] = ['label' => 'Викладач-Предмет', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="teach-predmet-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
