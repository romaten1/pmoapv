<?php

use app\models\Student;
use app\models\StudentGroup;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Student */

$this->title = Student::getFullName($model->id);
$this->params['breadcrumbs'][] = ['label' => 'Students', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="student-view">

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
            'first_name',
            'second_name',
            [
                'attribute' => 'image',
                'value'     => $model->image ? Html::img( '@web/uploads/student/' . $model->image ) : 'Малюнок на сайті відсутній',
                'format'    => 'html'
            ],

            [
                'attribute' => 'group_id',
                'value'     => StudentGroup::find()->where(['id' => $model->group_id ])->one()->title,
            ],
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
