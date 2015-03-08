<?php

use yii\helpers\Html;
use yii\widgets\ListView;


/* @var $this yii\web\View */
/* @var $searchModel app\models\PredmetSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title                   = 'Предмети';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="predmet-index">

    <h1><?= Html::encode( $this->title ) ?></h1>
    <?php //echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= ListView::widget( [
        'dataProvider' => $dataProvider,
        'itemOptions'  => [ 'class' => 'item well' ],
        'itemView'     => function ( $model, $key, $index, $widget ) {
            foreach ($model->teachers as $teacher) {
                $prepods .= $teacher->last_name . ' ' . $teacher->name . ', ';
            }
            return Html::a( Html::encode( $model->title ), [ 'view', 'id' => $model->id ] ) . '<br />
            Предмет викладають: ' . $prepods . '</p>';
        },
    ] ) ?>

</div>
