<?php
/**
 *
 */
use yii\helpers\Html;

if ($models) {
	foreach ($models as $model) {
		echo '<p>'.Html::a(Html::encode($model->title ), 
			['/metodychky/view', 'id' => $model->id]).'</p>';
	}
}