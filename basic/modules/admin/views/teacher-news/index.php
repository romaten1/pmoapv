<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\models\Teacher;
use app\models\TeacherNews;

/* @var $this yii\web\View */
/* @var $searchModel app\models\TeacherNewsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title                   = 'Повідомлення викладачів';
$this->params['breadcrumbs'][] = $this->title;

$userIdArray = Teacher::getUserIdTeacherNameArray();
?>
<div class="teacher-news-index">

    <h1><?= Html::encode( $this->title ) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a( 'Створити повідомлення', [ 'create' ], [ 'class' => 'btn btn-success' ] ) ?>
    </p>

    <?= GridView::widget( [
        'dataProvider' => $dataProvider,
        'filterModel'  => $searchModel,
        'columns'      => [
            [ 'class' => 'yii\grid\SerialColumn' ],
            'id',
            [
                'attribute' => 'teacher_id',
                'format'    => 'html',
                'value'     => function ( $model ) {

                    return Teacher::getTeacherNameByUserId( $model->teacher_id );
                },
                'filter'    => $userIdArray,
            ],
            'title',
            'text:ntext',
            [
                'attribute' => 'created_at',
                'format'    => 'date'
            ],
            // 'updated_at',
            [
                'attribute' => 'active',
                'format'    => 'html',
                'value'     => function ( $model ) {
                    return $model->getStatusLabel();
                },
                'filter'    => TeacherNews::getStatusArray()
            ],
            [ 'class' => 'yii\grid\ActionColumn' ],
        ],
    ] ); ?>

</div>
