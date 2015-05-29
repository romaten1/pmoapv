<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Diploma */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Diplomas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="diploma-view">

    <h1><?= Html::encode($this->title) ?></h1>



    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'title',
            'image',
            'rating',
            'created_at',
            'updated_at',
            'active',
        ],
    ]) ?>

</div>
