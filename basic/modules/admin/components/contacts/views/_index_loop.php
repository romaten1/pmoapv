<?php
/**
 * Представление цикла последних постов.
 * @var yii\base\View $this Представление
 * @var common\modules\blogs\models\Post $models Массив моделей
 */


use yii\helpers\Html;

if ($models) {
    foreach ($models as $model) {
        echo '<li>На тему: ' . Html::a(Html::encode($model->subject),
                ['/admin/contacts/view', 'id' => $model->id])
            . '<br />від: ' . Html::encode($model->name) . '</li>';
    }
}