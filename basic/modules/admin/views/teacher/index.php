<?php

use yii\helpers\Html;
use yii\widgets\ListView;
use kartik\icons\Icon;

/* @var $this yii\web\View */
/* @var $searchModel app\models\TeacherSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Викладачі';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="teacher-index">

    <h1><?= Icon::show('user', [], Icon::BSG).Html::encode($this->title) ?></h1>
    
    <?= ListView::widget([
        'dataProvider' => $dataProvider,
        'itemOptions' => ['class' => 'item'],
        'itemView' => function ($model, $key, $index, $widget) {
        	$return = '<p>'.Html::a(Html::encode($model->last_name . ' ' . $model->name . ' ' 
        		. $model->second_name), ['view', 'id' => $model->id]);
        	$return .= '<br />';
        	$return .= $model->job . ', ' . $model->science_status . '</p>';
            return $return;
        },
    ]) ?>

</div>
