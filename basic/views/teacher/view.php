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

    <h1><?= Html::encode($this->title) ?></h1>

    
    <p><?= $model->image ? Html::img('@web/uploads/teacher/'.$model->image) : '' ?></p>

    <p><?= 'Посада: '.Html::encode($model->job) ?></p>

    <p><?= 'Науковий ступінь: '.Html::encode($model->science_status) ?></p>

    <p><?= 'Організаційна посада: '.Html::encode($model->org_status) ?></p>

    <p><?= $model->description?></p>
    <div class="row">
        <div class="col-md-6">
            <p class="btn btn-default">Предмети, які веде викладач:</p>
             <p><?
                    $predmet_id = TeachPredmet::findAll([
                        'teach_id' => $model->id,
                    ]); 
                    foreach($predmet_id as $predmet){
                        $predmet_name = Predmet::findOne($predmet->predmet_id);
                        echo 
                        Html::a($predmet_name->title, 
                            ['/predmet/view', 'id' => $predmet_name->id])
                        . '<br />'; 
                    } 
                ?></p>
        </div>
        <div class="col-md-6">
            <p class="btn btn-default">Викладач є автором методичних вказівок:</p>
            <p><?
                $metodychky_id = TeachMetodychky::findAll([
                    'teach_id' => $model->id,
                ]); 
                foreach($metodychky_id as $metodychky){
                    $metodychky_name = Metodychky::findOne($metodychky->metodychky_id);
                    echo 
                    Html::a($metodychky_name->title, 
                        ['/metodychky/view', 'id' => $metodychky_name->id])
                    . '<br />'; 
                } 
            ?></p>
        </div>
    </div>
    
    

</div>
