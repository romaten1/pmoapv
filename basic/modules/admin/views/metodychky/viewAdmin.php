<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;
use kartik\icons\Icon;
use app\models\Metodychky;
use app\helpers\FileHelper;

/* @var $this yii\web\View */
/* @var $model app\models\Metodychky */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Методичні вказівки', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="metodychky-view">

   <h1><?= Icon::show('book', [], Icon::BSG).Html::encode($this->title) ?></h1>

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
            'id',
            'title',
            [
                'attribute' => 'description',
                'format' => 'html'
            ],
            [
                'attribute' => 'file',
                'value' => $model->file ? ' <a href=' . Url::to('/basic/web/uploads/metodychky/'. $model->file, true).' >' . $model->title.'</a>'
                : 'Файл на сайті відсутній',
                'format' => 'html'
            ],
            [
                'attribute' => 'active',
                'value' => Metodychky::getStatus($model->active),
            ],
            [
                'attribute' => 'created_at',
                'format' => 'date'
            ],
            [
                'attribute' => 'updated_at',
                'format' => 'date'
            ],
	        [
		        'attribute' => 'size',
		        'value' => FileHelper::Size2Str($model->size),
	        ],
        ],
    ]) ?>

    <div class="row">
            <div class="col-md-6">
                <div class="well well-sm">Автори методичних вказівок:</div>  
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
        </div>

</div>
