<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\Metodychky;
use app\models\Teacher;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\TeachMetodychky */
$metodychky = Metodychky::findOne($model->metodychky_id)->title;
$teacher = Teacher::findOne($model->teach_id)->last_name.' '.
                    Teacher::findOne($model->teach_id)->name.' '.
                    Teacher::findOne($model->teach_id)->second_name;
$this->title = $metodychky . ': '. $teacher;

$this->params['breadcrumbs'][] = ['label' => 'Teach Metodychkies', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="teach-metodychky-view">

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
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            [
                'attribute' => 'teach_id',
                'value' => $teacher,
                
            ],
            [
                'attribute' => 'metodychky_id',
                'value' =>$metodychky,
            ],
        ],
    ]) ?>

</div>
