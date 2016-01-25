<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\admin\modules\vk\models\search\VkSchoolSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Vk Schools';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="vk-school-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Vk School', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'school_id',
            'title',
            'city_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
