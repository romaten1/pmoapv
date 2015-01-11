<?php

use yii\helpers\Html;
use yii\grid\GridView;
use kartik\icons\Icon;
use app\modules\admin\models\News;

/* @var $this yii\web\View */
/* @var $searchModel app\models\NewsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Новини';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="news-index">

    <h1><?= Icon::show('folder-open', [], Icon::BSG).Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Створити новину', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'image',
                'format' => 'image',
                'value' => function($model) { return 'uploads/news/thumbs/thumb_'.$model->image; },
                'contentOptions' => ['class' => 'img-thumbnail']
            ],
            //'id',
            [
                'attribute' => 'title',
                'format' => 'html',
                'value' => function ($model) {
                    return Html::a($model->title, ['/news/view/', 'id'=>$model->id]);},                
            ],
            [
                'attribute' => 'description',
                'format' => 'html',                
            ],
            [
                'attribute' => 'updated_at',
                'format' => 'date',                
            ],
            [
                'attribute' => 'active',
                'format' => 'html',
                'value' => function ($model) {
                    return $model->getStatusLabel();},
                'filter' => News::getStatusArray()
            ],
            //'text:ntext',
            //'image',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
