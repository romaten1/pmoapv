<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\TeachPredmet */

$this->title = 'Оновити Викладач-Предмет: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Викладач-Предмет', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Оновити';
?>
<div class="teach-predmet-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
