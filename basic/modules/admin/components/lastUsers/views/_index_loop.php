<?php
/**
 * Представление цикла зарегистрированных пользователей.
 * @var yii\base\View $this Представление
 * @var  $models
 */


use yii\helpers\Html;

if ($models) {
    foreach ($models as $model) {
        echo '<li>Користувач: ' . Html::a(Html::encode($model->username),
                ['/user/profile/show', 'id' => $model->id]) . '&nbsp &nbsp &nbsp'
            . Html::a('Надати роль', ['/rbac/auth-assignment/create','user_id' => $model->id], ['class' => 'btn btn-xs btn-warning'])
            . '<br />' . Html::encode($model->email) . ' '
            . Yii::$app->formatter->asDate($model->created_at, 'long') . '</li>';
    }
}