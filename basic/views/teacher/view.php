<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\icons\Icon;
use app\models\Metodychky;
use app\models\TeachPredmet;
use app\models\TeachMetodychky;
use app\models\Predmet;

/* @var $this yii\web\View */
/* @var $model app\models\Teacher */

$this->title = $model->last_name . ' ' . $model->name . ' ' . $model->second_name;
$this->params['breadcrumbs'][] = ['label' => 'Викладачі', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="teacher-view">

    <h2><?= Html::encode($this->title) ?></h2>

    
    <p><?= $model->image ? Html::img('@web/uploads/teacher/'.$model->image) : '' ?></p>

    <p><?= 'Посада: '.Html::encode($model->job) ?></p>

    <p><?= 'Науковий ступінь: '.Html::encode($model->science_status) ?></p>

    <p><?= 'Організаційна посада: '.Html::encode($model->org_status) ?></p>

    <p><?= $model->description?></p>
    <div class="row">
        <div class="col-md-6">
            <div class="well well-sm">Предмети, які веде викладач:</div>
             <p><?
                    foreach($model->predmet as $predmet) {               
                        echo 
                        Html::a($predmet->title, 
                            ['/predmet/view', 'id' => $predmet->id])
                        . '<br />'; 
                    } 
                ?></p>
        </div>
        <div class="col-md-6">
            <div class="well well-sm">Викладач є автором методичних вказівок:</div>
            <p><?php 
                    foreach($model->metodychky as $metodychky) {               
                        echo 
                        Html::a($metodychky->title, 
                            ['/metodychky/view', 'id' => $metodychky->id])
                        . '<br />'; 
                    }
                 ?></p>
        </div>
    </div>
    
    

</div>
