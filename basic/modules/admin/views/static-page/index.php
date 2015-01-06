<?php

use yii\helpers\Html;
use yii\helpers\StringHelper;
use yii\grid\GridView;
use app\modules\admin\models\StaticPage;
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
                    return $model->getStatusLabel();},
                'filter' => StaticPage::getStatusArray()
            ],
            [
                'attribute' => 'parent_group_id',
                'format' => 'html',
                'value' => function ($model) {
                    return $model->getParentLabel();},
                'filter' => StaticPage::getParentArray()
            ],
            
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
