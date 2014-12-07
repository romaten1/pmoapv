<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\TeachPredmet */

$this->title = 'Create Teach Predmet';
$this->params['breadcrumbs'][] = ['label' => 'Teach Predmets', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="teach-predmet-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
