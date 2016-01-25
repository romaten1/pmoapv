<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\admin\modules\vk\models\search\VkUserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Vk Users';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="vk-user-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Vk User', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'user_id',
            'first_name',
            'last_name',
            'sex',
            // 'bdate',
            // 'city_id',
            // 'city_title',
            // 'country',
            // 'photo_200_orig',
            // 'domain',
            // 'school_id',
            // 'school_city_id',
            // 'school_name',
            // 'school_year_to',
            // 'last_seen',
            // 'can_post',
            // 'can_write_private_message',
            // 'description:ntext',
            // 'active',
            // 'created_at',
            // 'updated_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
