<?php

use yii\helpers\Html;
use yii\widgets\ListView;


/* @var $this yii\web\View */
/* @var $searchModel app\models\TeacherSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Викладачі';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="teacher-index">

    <h1><?= Html::encode($this->title) ?></h1>
    
    <?= ListView::widget([
        'dataProvider' => $dataProvider,
        'itemOptions' => ['class' => 'item'],
        'itemView' => function ($model, $key, $index, $widget) {
        	$return = '<div class="row">
                            <div class="col-md-2">';
            $return .= $model->image ? Html::img('@web/uploads/teacher/thumbs/thumb_'.$model->image, ['class'=>'img-thumbnail']) : '';
            $return .= '</div>
                            <div class="col-md-10">';
            $return .= Html::a(Html::encode($model->last_name . ' ' . $model->name . ' ' 
                . $model->second_name), ['view', 'id' => $model->id]);
            $return .= '<br />';
            $return .= $model->job . ', ' . $model->science_status . '</p>';
            $return .= '</div>
                            </div><br />';
            return $return;
        },
    ]) ?>

    

</div>
