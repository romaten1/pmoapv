<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;
use kartik\icons\Icon;
use app\models\TeachMetodychky;
use app\models\Teacher;
use app\modules\admin\models\Metodychky;

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

        ],
    ]) ?>

    Автори методичних вказівок:<br />
        <?
            $metodychky_id = TeachMetodychky::findAll([
                'metodychky_id' => $model->id,
            ]); 
            foreach($metodychky_id as $metodychky ){
                $teacher_name = Teacher::findOne($metodychky->teach_id);
                echo 
                Html::a($teacher_name->last_name.' '
                    .$teacher_name->name.' '
                    .$teacher_name->second_name, 
                    ['/admin/teacher/view', 'id' => $teacher_name->id], ['class' => 'btn btn-default'])
                . '<br />'; 
            }
            

        ?> 

</div>
