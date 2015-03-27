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
    <div class="panel-group" id="accordion">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">
                    <a class="accordion-toggle" href="#collapseOne" data-toggle="collapse" data-parent="#accordion">
                        Пошук серед предметів
                    </a>
                </h4>
            </div>
            <div class="panel-collapse collapse" id="collapseOne">
                <div class="panel-body">
                    <div class="row">
                        <?php echo $this->render( '_search', [ 'model' => $searchModel ] ); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?= ListView::widget( [
        'dataProvider' => $dataProvider,
        'itemOptions'  => [ 'class' => 'item well' ],
        'itemView'     => function ( $model, $key, $index, $widget ) {
            foreach ($model->teachers as $teacher) {
                $prepods = '';
                $prepods .= $teacher->last_name . ' ' . $teacher->name . ', ';
            }
            return Html::a( Html::encode( $model->title ), [ 'view', 'id' => $model->id ] ) . '<br />';
            //'Предмет викладають: ' . $prepods . '</p>';
        },
    ] ) ?>

</div>
