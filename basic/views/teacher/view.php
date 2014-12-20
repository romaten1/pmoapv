<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\icons\Icon;

/* @var $this yii\web\View */
/* @var $model app\models\Teacher */

$this->title = $model->last_name . ' ' . $model->name . ' ' . $model->second_name;
$this->params['breadcrumbs'][] = ['label' => 'Викладачі', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="teacher-view">

    <h1><?= Html::encode($this->title) ?></h1>

    
    <p><?= $model->image ? Html::img('@web/uploads/teacher/'.$model->image) : '' ?></p>

    <p><?= 'Посада: '.Html::encode($model->job) ?></p>

    <p><?= 'Науковий ступінь: '.Html::encode($model->science_status) ?></p>

    <p><?= 'Організаційна посада: '.Html::encode($model->org_status) ?></p>

    <p><?= Html::encode($model->description) ?></p>

    

</div>
