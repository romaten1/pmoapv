<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\BestStudent */

$this->title = 'Create Best Student';
$this->params['breadcrumbs'][] = ['label' => 'Best Students', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="best-student-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
