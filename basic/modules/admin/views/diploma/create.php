<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Diploma */

$this->title = 'Create Diploma';
$this->params['breadcrumbs'][] = ['label' => 'Diplomas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="diploma-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
