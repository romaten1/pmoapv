<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PredmetSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Предмети';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="predmet-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Створити предмет', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'title',
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