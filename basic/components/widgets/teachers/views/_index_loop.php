<?php
/**
 *
 */
use yii\helpers\Html;

if ($models) {
	foreach ($models as $model) {
		echo '<p>'.Html::a(Html::encode($model->last_name . ' ' . $model->name . ' ' 
        		. $model->second_name), ['/teacher/view', 'id' => $model->id],['class'=>'text-primary']).'</p>';
	}
}