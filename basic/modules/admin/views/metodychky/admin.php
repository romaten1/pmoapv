<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use kartik\icons\Icon;

/* @var $this yii\web\View */
/* @var $searchModel app\models\MetodychkySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Навчально-методичне забезпечення кафедри - журнал';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="metodychky-index">

    <h1><?= Icon::show('book', [], Icon::BSG).Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Створити методичні вказівки', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            //'id',            
            [
                'attribute' => 'title',
                'format' => 'html',
                'value' => function ($model) {
                    return Html::a($model->title, ['/metodychky/view/', 'id'=>$model->id]);},
                //'filter' => ['0' => 'Неактивна', '1' => 'Активна']
            ],
            //'description:ntext',            
            [
                'attribute' => 'file',
                'format' => 'html',
                'value' => function ($model) {
					
                    return $model->file ? 
                    	'<a href=' . Url::to('/basic/web/uploads/metodychky/'. $model->file, true).'> Файл на сайті </a>' 
                    	: 'Файл відсутній на сайті';},
            ],
            [
                'attribute' => 'active',
                'format' => 'html',
                'value' => function ($model) {
                    return $model->active == '1' ? 'Активна' : 'Неактивна';},
                'filter' => ['0' => 'Неактивна', '1' => 'Активна']
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
