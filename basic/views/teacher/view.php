<?php

use yii\helpers\Html;
use app\models\Teacher;
use app\models\Metodychky;
use app\models\Predmet;
use kartik\icons\Icon;

Icon::map( $this );
/* @var $this yii\web\View */
/* @var $model app\models\Teacher */

$this->title                   = $model->last_name . ' ' . $model->name . ' ' . $model->second_name;
$this->params['breadcrumbs'][] = [ 'label' => 'Викладачі', 'url' => [ 'index' ] ];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="teacher-view">

    <h2><?= Html::encode( $this->title ) ?> </h2>

    <p><?= $model->image ? Html::img( '@web/uploads/teacher/' . $model->image ) : '' ?></p>
    <?php if ( ! Yii::$app->user->isGuest) {
        echo Html::a( "Звернутись до викладача",
            [ '/message/user-message', 'receiver_id' => Teacher::getUserByTeacherId( $model->id )->id ],
            [ 'class' => 'btn btn-success' ] );
    }?>
    <?php if ( !empty($model->science_works)) {
        echo Html::a( 'Перелік наукових праць викладача',
        [ '/teacher/science-works', 'id' => $model->id ], [ 'class' => 'btn btn-info' ] );
    }?>
    <p><?= 'Посада: ' . Html::encode( $model->job ) ?></p>

    <p><?= 'Науковий ступінь: ' . Html::encode( $model->science_status ) ?></p>

    <p><?= 'Організаційна посада: ' . Html::encode( $model->org_status ) ?></p>

    <p><?= $model->description ?></p>

    <div class="row">
        <div class="col-md-6">
            <div class="well well-sm">Предмети, які веде викладач:</div>
            <p><?
                foreach ($model->predmet as $predmet) {
                    if ($predmet->active == Predmet::STATUS_ACTIVE) {
                        echo
                            Icon::show( 'folder-open' ) . Html::a( $predmet->title,
                                [ '/predmet/view', 'id' => $predmet->id ] )
                            . '<br />';
                    }
                }
                ?></p>
        </div>
        <div class="col-md-6">
            <div class="well well-sm">Викладач є автором методичних вказівок:</div>
            <p><?php
                foreach ($model->metodychky as $metodychky) {
                    //Виводимо методички тільки тоді коли вони активні
                    if ($metodychky->active == Metodychky::STATUS_ACTIVE) {
                        echo Icon::show( 'book' ) . Html::a( $metodychky->title,
                                [ '/metodychky/view', 'id' => $metodychky->id ] )
                             . '<br />';
                    }
                }
                ?></p>
        </div>
    </div>


</div>
