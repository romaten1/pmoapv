<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\TeachPredmet */

$this->title = 'Update Teach Predmet: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Teach Predmets', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="teach-predmet-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
