<?php

use app\models\BestStudent;
use app\models\Student;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\BestStudentSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Best Students';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="best-student-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Best Student', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 'student_id',
                'format'    => 'html',
                'value'     => function ( $model ) {
                    return Student::getFullName($model->student_id);
                },
            ],
            [
                'attribute' => 'description',
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
                'format'    => 'html',
                'value'     => function ( $model ) {
                    return $model->getStatusLabel();
                },
                'filter'    => BestStudent::getStatusArray()
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
