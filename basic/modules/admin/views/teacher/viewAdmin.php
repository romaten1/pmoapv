<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\icons\Icon;
use app\models\TeachPredmet;
use app\models\Predmet;

/* @var $this yii\web\View */
/* @var $model app\models\Teacher */

$this->title = $model->last_name . ' ' . $model->name . ' ' . $model->second_name;
$this->params['breadcrumbs'][] = ['label' => 'Викладачі', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="teacher-view">

    <h1><?= Icon::show('user', [], Icon::BSG).Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Оновити', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Видалити', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Ви впевнені, що хочете видалити цей запис?',
                'method' => 'post',
            ],
        ]) ?>
        <?= Html::a('Створити', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'name',
            'second_name',
            'last_name',
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
    Предмети, які веде викладач:<br />
        <?
            $predmet_id = TeachPredmet::findAll([
                'teach_id' => $model->id,
            ]); 
            foreach($predmet_id as $predmet){
                $predmet_name = Predmet::findOne($predmet->predmet_id);
                echo 
                Html::a($predmet_name->title, 
                    ['/admin/predmet/view', 'id' => $predmet_name->id], ['class' => 'btn btn-default'])
                . '<br />'; 
            }
            

        ?>

</div>
