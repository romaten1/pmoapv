<?php

use app\models\Student;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\BestStudent */

$this->title = Student::getFullName($model->student_id);
$this->params['breadcrumbs'][] = ['label' => 'Best Students', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="best-student-view">

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
            [
                'attribute' => 'student_id',
                'value'     => $this->title,
            ],
            'description:ntext',
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
