<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Teacher */

$this->title                   = $model->last_name . ' ' . $model->name . ' ' . $model->second_name;
$this->params['breadcrumbs'][] = [ 'label' => 'Майстри та лаборанти', 'url' => [ 'index' ] ];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="teacher-view">

    <h2><?= Html::encode( $this->title ) ?> </h2>

    <p><?= $model->image ? Html::img( '@web/uploads/teacher/' . $model->image ) : '' ?></p>

    <p><?= 'Посада: ' . Html::encode( $model->job ) ?></p>

    <p><?= $model->description ?></p>

</div>
