<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\modules\conference\models\Conference;

/* @var $this yii\web\View */
/* @var $model app\modules\conference\models\Conference */

$this->title                   = $model->title;
$this->params['breadcrumbs'][] = [ 'label' => 'Наукові заходи', 'url' => [ 'index' ] ];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="conference-view">

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
            [
                'attribute' => 'title',
                'format'    => 'html'
            ],
            [
                'attribute' => 'description',
                'format'    => 'html'
            ],
            [
                'attribute' => 'active',
                'value'     => Conference::getStatus( $model->active ),
            ],
            'conference_date',
        ],
    ] ) ?>

</div>
