<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\conference\models\Conference */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Наукові заходи', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="conference-view">

	<h2><?= Html::encode($this->title) ?> </h2>

	<p><?= 'Дата проведення: '.Html::encode($model->conference_date) ?></p>

	<p><?= $model->description?></p>

</div>
