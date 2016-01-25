<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\News;

/* @var $this yii\web\View */
/* @var $model app\models\News */

$this->title                   = $model->title;
$this->params['breadcrumbs'][] = [ 'label' => 'Новини', 'url' => [ 'index' ] ];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="news-view">

    <h1><?= Html::encode( $this->title ) ?></h1>

    <p>
        <?= Html::a( 'Оновити', [ 'update', 'id' => $model->id ], [ 'class' => 'btn btn-primary' ] ) ?>
        <?= Html::a( 'Видалити', [ 'delete', 'id' => $model->id ], [
            'class' => 'btn btn-danger',
            'data'  => [
                'confirm' => 'Ви впевнені, що хочете видалити цей запис?',
                'method'  => 'post',
            ],
        ] ) ?>
    </p>

    <?= DetailView::widget( [
        'model'      => $model,
        'attributes' => [
            'id',
            'title',
            [
                'attribute' => 'image',
                'value'     => $model->image ? Html::img( '@web/uploads/news/' . $model->image ) : 'Малюнок на сайті відсутній',
                'format'    => 'html'
            ],
            [
                'attribute' => 'description',
                'format'    => 'html'
            ],
            [
                'attribute' => 'text',
                'format'    => 'html'
            ],
            [
                'attribute' => 'active',
                'value'     => News::getStatus( $model->active ),
            ],
            [
                'attribute' => 'unus_public',
                'value'     => News::getPublicUnus( $model->unus_public ),
            ],
            [
                'attribute' => 'created_at',
                'format'    => 'date'
            ],
            [
                'attribute' => 'updated_at',
                'format'    => 'date'
            ],

        ],
    ] ) ?>

</div>
