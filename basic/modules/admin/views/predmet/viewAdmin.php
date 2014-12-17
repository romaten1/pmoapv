<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\icons\Icon;
use app\models\TeachPredmet;
use app\models\Teacher;

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
            'id',
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

    <p>
        Предмет викладає:<br />
        <?
            $teacher_id = TeachPredmet::findAll([
                'predmet_id' => $model->id,
            ]); 
            foreach($teacher_id as $teacher ){
                $teacher_name = Teacher::findOne($teacher->teach_id);
                echo 
                Html::a($teacher_name->last_name.' '
                    .$teacher_name->name.' '
                    .$teacher_name->second_name, 
                    ['/admin/teacher/view', 'id' => $teacher_name->id], ['class' => 'btn btn-default'])
                . '<br />'; 
            }
            

        ?>
    </p>

</div>
