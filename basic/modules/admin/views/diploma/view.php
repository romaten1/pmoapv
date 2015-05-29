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

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'title',
            [
                'attribute' => 'image',
                'value'     => $model->image ? Html::img( '@web/uploads/diploma/' . $model->image ) : 'Малюнок на сайті відсутній',
                'format'    => 'html'
            ],
            'rating',
            [
                'attribute' => 'created_at',
                'format'    => 'date'
            ],
            [
                'attribute' => 'updated_at',
                'format'    => 'date'
            ],
            [
                'attribute' => 'active',
                'value'     => $model->active == '1' ? 'Активно' : 'Неактивно',
            ],
        ],
    ]) ?>

</div>
