<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\icons\Icon;

/* @var $this yii\web\View */
/* @var $model app\models\Teacher */

$this->title                   = $model->last_name . ' ' . $model->name . ' ' . $model->second_name;
$this->params['breadcrumbs'][] = [ 'label' => 'Викладачі', 'url' => [ 'index' ] ];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="teacher-view">

    <h1><?= Icon::show( 'user', [ ], Icon::BSG ) . Html::encode( $this->title ) ?></h1>

    <?= DetailView::widget( [
        'model'      => $model,
        'attributes' => [
            'name',
            'second_name',
            'last_name',
            'image',
            'job',
            'science_status',
            'org_status',
            [
                'attribute' => 'description',
                'format'    => 'html'
            ],
        ],
    ] ) ?>

</div>
