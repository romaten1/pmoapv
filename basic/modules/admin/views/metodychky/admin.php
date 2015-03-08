<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use kartik\icons\Icon;
use app\models\Metodychky;
use app\helpers\FileHelper;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\MetodychkySearch */
/* @var $model app\models\Metodychky */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title                   = 'Навчально-методичне забезпечення кафедри - журнал';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="metodychky-index">

    <h1><?= Icon::show( 'book', [ ], Icon::BSG ) . Html::encode( $this->title ) ?></h1>
    <?php echo $this->render( '_search', [ 'model' => $searchModel ] ); ?>

    <p>
        <?= Html::a( 'Створити методичні вказівки', [ 'create' ], [ 'class' => 'btn btn-success' ] ) ?>
    </p>

    <?= GridView::widget( [
        'dataProvider' => $dataProvider,
        'filterModel'  => $searchModel,
        'columns'      => [
            [ 'class' => 'yii\grid\SerialColumn' ],
            //'id',            
            [
                'attribute' => 'title',
                'format'    => 'html',
                'value'     => function ( $model ) {
                    return Html::a( $model->title, [ '/admin/metodychky/view/', 'id' => $model->id ] );
                },
                //'filter' => ['0' => 'Неактивна', '1' => 'Активна']
            ],
            //'description:ntext',            
            [
                'attribute' => 'file',
                'format'    => 'html',
                'value'     => function ( $model ) {

                    return $model->file ?
                        '<a href=' . Url::to( '/basic/web/uploads/metodychky/' . $model->file,
                            true ) . '> Файл на сайті </a>'
                        : 'Файл відсутній на сайті';
                },
            ],
            [
                'attribute' => 'active',
                'format'    => 'html',
                'value'     => function ( $model ) {
                    return $model->getStatusLabel();
                },
                'filter'    => Metodychky::getStatusArray()
            ],
            [
                'attribute' => 'updated_at',
                'format'    => 'date',
            ],
            [
                'attribute' => 'size',
                'format'    => 'html',
                'value'     => function ( $model ) {
                    return FileHelper::Size2Str( $model->size );
                }
            ],
            [ 'class' => 'yii\grid\ActionColumn' ],
        ],
    ] ); ?>

</div>
