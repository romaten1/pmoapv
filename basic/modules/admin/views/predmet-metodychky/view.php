<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\Metodychky;
use app\models\Predmet;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\TeachMetodychky */
$metodychky  = Metodychky::findOne( $model->metodychky_id )->title;
$predmet     = Predmet::findOne( $model->predmet_id )->title;
$this->title = $metodychky . ': ' . $teacher;

$this->params['breadcrumbs'][] = [ 'label' => 'Предмет-Методичні вказівки', 'url' => [ 'index' ] ];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="predmet-metodychky-view">

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
                'attribute' => 'predmet_id',
                'value'     => $predmet,

            ],
            [
                'attribute' => 'metodychky_id',
                'value'     => $metodychky,
            ],
        ],
    ] ) ?>

</div>
