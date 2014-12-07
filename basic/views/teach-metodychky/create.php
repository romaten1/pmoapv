<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\TeachMetodychky */

$this->title = 'Create Teach Metodychky';
$this->params['breadcrumbs'][] = ['label' => 'Teach Metodychkies', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="teach-metodychky-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
