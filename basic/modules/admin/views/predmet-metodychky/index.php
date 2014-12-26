<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\models\Metodychky;
use app\models\Predmet;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\admin\models\PredmetMetodychkySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Предмет-Методичні вказівки';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="predmet-metodychky-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Вказати, до якого предмета відносяться методичні вказівки', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'metodychky_id',
                'format' => 'html',
                'value' => function ($model) {
                    $metodychky = Metodychky::findOne($model->metodychky_id);
                    return $metodychky->title;},
                'filter' => ArrayHelper::map(Metodychky::find()->all(), 'id', 'title'),
            ],
            [
                'attribute' => 'predmet_id',
                'format' => 'html',
                'value' => function ($model) {
                    $predmet = Predmet::findOne($model->predmet_id);
                    return $predmet->title;},
                 'filter' => ArrayHelper::map(Predmet::find()->all(), 'id', 'title'),                
            ],     
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
