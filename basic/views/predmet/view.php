<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\icons\Icon;

/* @var $this yii\web\View */
/* @var $model app\models\Predmet */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Предмети', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="predmet-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p><?= Html::encode($model->description) ?></p>
    
</div>
