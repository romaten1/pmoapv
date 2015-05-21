<?php

use app\models\StudentGroup;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\StudentGroupSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Student Groups';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="student-group-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Student Group', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],


            [
                'attribute' => 'title',
                'format'    => 'html',
                'value'     => function ( $model ) {
                    return Html::a( $model->title, [ '/admin/student-group/view/', 'id' => $model->id ] );
                },
            ],
            [
                'attribute' => 'specialnost',
                'format'    => 'html',
                'value'     => function ( $model ) {
                    return $model->getSpecialnostLabel();
                },
                'filter'    => StudentGroup::getSpecialnostArray()
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
                'format'    => 'html',
                'value'     => function ( $model ) {
                    return $model->getStatusLabel();
                },
                'filter'    => StudentGroup::getStatusArray()
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
