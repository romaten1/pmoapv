<?php

use app\modules\conference\models\ConferenceArticle;
use yii\helpers\Html;
use yii\grid\GridView;
use app\modules\conference\models\Conference;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\conference\models\ConferenceArticleSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title                   = 'Статті конференцій';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="conference-article-index">

    <h1><?= Html::encode( $this->title ) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a( 'Створити статтю конференції', [ 'create' ], [ 'class' => 'btn btn-success' ] ) ?>
    </p>

    <?= GridView::widget( [
        'dataProvider' => $dataProvider,
        'filterModel'  => $searchModel,
        'columns'      => [
            [ 'class' => 'yii\grid\SerialColumn' ],
            [
                'attribute' => 'conference_id',
                'format'    => 'html',
                'value'     => function ( $model ) {
                    return Conference::getConferenceLabel( $model->conference_id );
                },
                'filter'    => Conference::getConferenceArray()
            ],
            'author',
            'title',
            'description:ntext',
            // 'created_at',
            [
                'attribute' => 'updated_at',
                'format'    => [ 'date', 'php:d - m - Y' ],
            ],
            [
                'attribute' => 'active',
                'format'    => 'html',
                'value'     => function ( $model ) {
                    return $model->getStatusLabel();
                },
                'filter'    => ConferenceArticle::getStatusArray()
            ],
            [ 'class' => 'yii\grid\ActionColumn' ],
        ],
    ] ); ?>

</div>
