<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\icons\Icon;
use app\modules\admin\models\TeachPredmet;
use app\modules\admin\models\Teacher;

/* @var $this yii\web\View */
/* @var $model app\models\Predmet */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Предмети', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="predmet-view">

    <h1><?= Icon::show('briefcase', [], Icon::BSG).Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Оновити', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Видалити', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Ви впевнені, що хочете видалити цей запис?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'title',
            [
                'attribute' => 'description',
                'format' => 'html'
            ],
            [
                'attribute' => 'active',
                'value' => $model->active == '1' ? 'Активна' : 'Неактивна',
            ],
        ],
    ]) ?>

    <div class="row">
            <div class="col-md-6">
                <div class="well well-sm">Викладачі, що ведуть предмет:</div>  
                 <p><?php 
                        foreach($model->teachers as $teach) {               
                            echo 
                            Html::a($teach->last_name.' '
                                .$teach->name.' '
                                .$teach->second_name, 
                                ['/admin/teacher/view', 'id' => $teach->id])
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
                                ['/admin/metodychky/view', 'id' => $metodychky->id])
                            . '<br />'; 
                        }
                     ?></p>
            </div>
        </div>

</div>
