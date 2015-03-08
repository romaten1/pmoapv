<?php

use yii\helpers\Html;
use yii\grid\GridView;
use kartik\icons\Icon;
use app\models\Teacher;

/* @var $this yii\web\View */
/* @var $searchModel app\models\TeacherSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title                   = 'Викладачі';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="teacher-index">

    <h1><?= Icon::show( 'user', [ ], Icon::BSG ) . Html::encode( $this->title ) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a( 'Створити викладача', [ 'create' ], [ 'class' => 'btn btn-success' ] ) ?>
    </p>

    <?= GridView::widget( [
        'dataProvider' => $dataProvider,
        'filterModel'  => $searchModel,
        'columns'      => [
            [ 'class' => 'yii\grid\SerialColumn' ],
            [
                'attribute'      => 'image',
                'format'         => 'image',
                'value'          => function ( $model ) {
                    return 'uploads/teacher/thumbs/thumb_' . $model->image;
                },
                'contentOptions' => [ 'class' => 'img-thumbnail' ]
            ],
            [
                'attribute' => 'last_name',
                'format'    => 'html',
                'value'     => function ( $model ) {
                    return Html::a( $model->last_name, [ '/admin/teacher/view/', 'id' => $model->id ] );
                },
                //'filter' => ['0' => 'Неактивна', '1' => 'Активна']
            ],
            'name',
            'second_name',
            'job',
            [
                'attribute' => 'active',
                'format'    => 'html',
                'value'     => function ( $model ) {
                    return $model->getStatusLabel();
                },
                'filter'    => Teacher::getStatusArray()
            ],
            //'science_status',
            //'org_status',


            [ 'class' => 'yii\grid\ActionColumn' ],
        ],
    ] ); ?>

</div>
