<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\icons\Icon;
use app\modules\admin\models\Metodychky;
use app\modules\admin\models\TeachPredmet;
use app\modules\admin\models\TeachMetodychky;
use app\modules\admin\models\Predmet;

/* @var $this yii\web\View */
/* @var $model app\models\Teacher */

$this->title = $model->last_name . ' ' . $model->name . ' ' . $model->second_name;
$this->params['breadcrumbs'][] = ['label' => 'Викладачі', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="teacher-view">
    <div class="row">    
        <div class="col-xs-3">
            <? if(!empty($model->image)){echo Html::img('@web/uploads/teacher/'.$model->image, ['class'=>'img-thumbnail center-block']);} ?>
        </div>
        <div class="col-xs-9">
            <h1><?= Html::encode($this->title) ?></h1>

            <p>
                <?= Html::a('Оновити', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
                <?= Html::a('Видалити', ['delete', 'id' => $model->id], [
                    'class' => 'btn btn-danger',
                    'data' => [
                        'confirm' => 'Ви впевнені, що хочете видалити цей запис?',
                        'method' => 'post',
                    ],
                ]) ?>
                <?= Html::a('Створити нового викладача', ['create'], ['class' => 'btn btn-success']) ?>
            </p>
        </div>
    </div>
                

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'last_name',
            'name',
            'second_name',
            
            'image',
            'job',
            'science_status',
            'org_status',
            [
                'attribute' => 'description',
                'format' => 'html'
            ],
        ],
    ]) ?>
    <div class="row">
        <div class="col-md-6">
            <div class="well well-sm">Предмети, які веде викладач:</div>
             <p><?
                    foreach($model->predmet as $predmet) {               
                        echo 
                        Html::a($predmet->title, 
                            ['/admin/predmet/view', 'id' => $predmet->id])
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
                            ['/admin/metodychky/view', 'id' => $metodychky->id])
                        . '<br />'; 
                    }
                 ?></p>
        </div>
    </div>

</div>
