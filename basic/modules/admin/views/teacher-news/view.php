<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\Teacher;

/* @var $this yii\web\View */
/* @var $model app\models\TeacherNews */

$this->title                   = $model->title;
$this->params['breadcrumbs'][] = [ 'label' => 'Teacher News', 'url' => [ 'index' ] ];
$this->params['breadcrumbs'][] = $this->title;

$teacher      = Teacher::getTeacherByUserId( $model->teacher_id );
$teacher_name = $teacher->last_name . ' ' . $teacher->name . ' ' . $teacher->second_name;
?>
<div class="teacher-news-view">

    <h1><?= Html::encode( $this->title ) ?></h1>

    <p>
        <?= Html::a( 'Оновити', [ 'update', 'id' => $model->id ], [ 'class' => 'btn btn-primary' ] ) ?>
        <?= Html::a( 'Видалити', [ 'delete', 'id' => $model->id ], [
            'class' => 'btn btn-danger',
            'data'  => [
                'confirm' => 'Ви впевнені, що хочете видалити цей запис?',
                'method'  => 'post',
            ],
        ] ) ?>
    </p>

    <?= DetailView::widget( [
        'model'      => $model,
        'attributes' => [

            [
                'attribute' => 'teacher_id',
                'value'     => $teacher_name,
            ],
            'title',
            'text:ntext',
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
    ] ) ?>

</div>
