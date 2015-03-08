<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\icons\Icon;

/* @var $this yii\web\View */
/* @var $model app\models\Metodychky */

$this->title                   = $model->title;
$this->params['breadcrumbs'][] = [ 'label' => 'Методичні вказівки', 'url' => [ 'index' ] ];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="metodychky-view">

    <h1><?= Icon::show( 'book', [ ], Icon::BSG ) . Html::encode( $this->title ) ?></h1>

    <?= DetailView::widget( [
        'model'      => $model,
        'attributes' => [
            'description:ntext',
            [
                'attribute' => 'file',
                'value'     => $model->file ? Html::a( $model->file,
                    [ 'metodychky/view', 'id' => $model->id ] ) : 'Файл на сайті відсутній',
                'format'    => 'html'
            ],
        ],
    ] ) ?>

</div>
