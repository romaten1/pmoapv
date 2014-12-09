<?php

use yii\helpers\Html;
use yii\helpers\StringHelper;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\SearchStaticPage */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Статичні сторінки';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="static-page-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Створити статичну сторінку', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'alias',
            'title',
            [
                'attribute' => 'text',
                'format' => 'html',
                'value' => function ($model) {
                    return StringHelper::truncateWords($model->text, 50);},
            ],
            [
                'attribute' => 'active',
                'format' => 'html',
                'value' => function ($model) {
                    return $model->active == '1' ? 'Активна' : 'Неактивна';},
                'filter' => ['0' => 'Неактивна', '1' => 'Активна']
            ],
            [
                'attribute' => 'parent_group_id',
                'format' => 'html',
                'value' => function ($model) {
                    switch ($model->parent_group_id) {
                        case '0':
                            return 'Про кафедру';
                            break;

                        case '1':
                            return 'Абітурієнту';
                            break;
                        
                        case '2':
                            return 'Студенту';
                            break;

                        case '3':
                            return 'Наукова робота';
                            break;
                        default:
                            return 'Про кафедру';
                            break;
                    }
                },
                'filter' => ['0' => 'Про кафедру', '1' => 'Абітурієнту', '2' => 'Студенту', '3' => 'Наукова робота']
            ],
            
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
