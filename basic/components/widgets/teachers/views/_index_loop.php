<?php
/**
 * Представление цикла последних постов.
 * @var yii\base\View $this Представление
 * @var common\modules\blogs\models\Post $models Массив моделей
 */


use yii\helpers\Html;

if ($models) {
	foreach ($models as $model) {
		echo '<p>'.Html::a(Html::encode($model->last_name . ' ' . $model->name . ' ' 
        		. $model->second_name), ['/prepod/prepod/view', 'id' => $model->id]).'</p>';
	}
}