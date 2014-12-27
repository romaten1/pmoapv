<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\modules\admin\models\Predmet;

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

            [
                'attribute' => 'title',
                'format' => 'html',
                'value' => function ($model) {
                    return Html::a($model->title, ['/predmet/view/', 'id'=>$model->id]);},
            ],
            [
                'attribute' => 'active',
                'format' => 'html',
                'value' => function ($model) {
                    return $model->getStatusLabel();},
                'filter' => Predmet::getStatusArray()
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
