<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Diploma */

$this->title = 'Update Diploma: ' . ' ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Diplomas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="diploma-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
