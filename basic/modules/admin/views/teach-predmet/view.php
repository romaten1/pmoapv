<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\Teacher;
use app\models\Predmet;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\TeachPredmet */


$predmet                       = Predmet::findOne( $model->predmet_id )->title;
$teacher                       = Teacher::findOne( $model->teach_id )->last_name . ' ' .
                                 Teacher::findOne( $model->teach_id )->name . ' ' .
                                 Teacher::findOne( $model->teach_id )->second_name;
$this->title                   = $predmet . ': ' . $teacher;
$this->params['breadcrumbs'][] = [ 'label' => 'Викладач-Предмет', 'url' => [ 'index' ] ];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="teach-predmet-view">

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
                'attribute' => 'teach_id',
                'value'     => $teacher,

            ],
            [
                'attribute' => 'predmet_id',
                'value'     => $predmet,
            ],

        ],
    ] ) ?>

</div>
