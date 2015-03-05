<?php

use yii\helpers\Html;
use dektrium\user\models\User;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\modules\rbac\models\AuthAssignment */

$this->title = 'Оновити роль користувача: ' . ' ' . User::findOne($model->user_id)->username;
$this->params['breadcrumbs'][] = ['label' => 'Ролі користувачів', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->item_name, 'url' => ['view', 'item_name' => $model->item_name, 'user_id' => $model->user_id]];
$this->params['breadcrumbs'][] = 'Оновити';
?>
<div class="auth-assignment-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
