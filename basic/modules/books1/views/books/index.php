<?php

use app\modules\books\models\Authors;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\books\models\BooksSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Книги';
?>
<div class="books-index">

    <h1><?= Html::encode( $this->title ) ?></h1>
    <?php echo $this->render( '_search', [ 'model' => $searchModel ] ); ?>

    <?= GridView::widget( [
        'dataProvider' => $dataProvider,
        'columns'      => [

            'id',
            'name',
            [
                'attribute' => 'preview',
                'format'    => 'raw',
                'value'     => function ( $model ) {
                    return Html::a( Html::img( "img/books/thumbs/thumb_" . $model->preview, [ 'width' => '100px' ] ),
                        '/img/books/' . $model->preview,
                        [
                            'class'         => 'thumbnail',
                            'data-lightbox' => 'image-1',
                            'data-title'    => $model->name,
                        ] );
                }
            ],
            [
                'attribute' => 'author_id',
                'value'     => function ( $model ) {
                    return Authors::getAuthorById( $model->author_id );
                }
            ],
            [
                'attribute' => 'date',
                'format'    => [ 'date', 'php:jS F Y' ]
            ],
            [
                'attribute' => 'date_create',
                'format'    => [ 'date', 'php:jS F Y' ]
            ],
            [
                'class'          => 'yii\grid\ActionColumn',
                'template'       => '{update} {view} {delete}',
                'buttons'        => [
                    'view'   => function ( $url, $model ) {
                        return Html::button( '<span class="glyphicon glyphicon-eye-open"</span>',
                            [
                                'value' => Url::to( [ 'view', 'id' => $model->id ] ),
                                'title' => 'Updating Company',
                                'class' => 'showModalButton btn btn-sm btn-success'
                            ] );
                    },
                    'update' => function ( $url, $model ) {
                        return Html::a( '<span class="glyphicon glyphicon-pencil"</span>',
                            [ 'update', 'id' => $model->id ],
                            [
                                'title' => 'Редактировать',
                                'class' => 'btn btn-sm btn-success'
                            ] );
                    },
                    'delete' => function ( $url, $model ) {
                        return Html::a( '<span class="glyphicon glyphicon-trash"</span>',
                            [ 'delete', 'id' => $model->id ],
                            [
                                'title' => 'Удалить',
                                'class' => 'btn btn-sm btn-success',
                                'data'  => [
                                    'confirm' => 'Вы уверенны, что хотите удалить эту запись?',
                                    'method'  => 'post',
                                ],
                            ] );
                    },
                ],
                'contentOptions' => [ 'style' => 'width: 140px; max-width: 140px;' ],
            ],
        ],
    ] ); ?>

</div>
