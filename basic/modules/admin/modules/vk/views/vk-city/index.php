<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\admin\modules\vk\models\search\VkCitySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Vk Cities';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="vk-city-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Vk City', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'city_id',
            'title',
            'area',
            'region',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
