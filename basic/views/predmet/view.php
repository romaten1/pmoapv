<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\icons\Icon;

/* @var $this yii\web\View */
/* @var $model app\models\Predmet */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Предмети', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$this->params['type'] = 'predmet';
$this->params['predmet_id'] = $model->id;
?>
<div class="predmet-view">

    <h2><?= Html::encode($this->title) ?></h2>

    <p><?= $model->description ?></p>

    <div class="row">
            <div class="col-md-6">
                <div class="well well-sm">Викладачі, що ведуть предмет:</div>  
                 <p><?php 
                        foreach($model->teachers as $teach) {               
                            echo 
                            Html::a($teach->last_name.' '
                                .$teach->name.' '
                                .$teach->second_name, 
                                ['/teacher/view', 'id' => $teach->id])
                            . '<br />'; 
                        }
                     ?></p>
            </div>
            <div class="col-md-6">
                <div class="well well-sm">Методичні вказівки по даному предмету:</div>  
                 <p><?php 
                        foreach($model->metodychkies as $metodychky) {               
                            echo 
                            Html::a($metodychky->title, 
                                ['/metodychky/view', 'id' => $metodychky->id])
                            . '<br />'; 
                        }
                     ?></p>
            </div>
        </div>

    
</div>
