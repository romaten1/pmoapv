<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Teacher */

$this->title                   = 'Перелік наукових праць';
$teacherName                   = $model->last_name . ' ' . $model->name . ' ' . $model->second_name ;
$this->params['breadcrumbs'][] = [ 'label' => 'Викладачі', 'url' => [ 'index' ] ];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="teacher-view">

    <h2><?= Html::encode( $teacherName  . ' - ' .$this->title  ) ?> </h2>

    <p><?= $model->science_works ?></p>

</div>
