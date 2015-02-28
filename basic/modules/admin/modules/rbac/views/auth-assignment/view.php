<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use dektrium\user\models\User;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\modules\rbac\models\AuthAssignment */

$this->title = $model->item_name;
$this->params['breadcrumbs'][] = ['label' => 'Auth Assignments', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="auth-assignment-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'item_name' => $model->item_name, 'user_id' => $model->user_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'item_name' => $model->item_name, 'user_id' => $model->user_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
	<p>
		<?= Html::a('Create Auth Assignment', ['create'], ['class' => 'btn btn-success']) ?>
	</p>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'item_name',
            [
		        'attribute' => 'user_id',
		        'value' => User::findOne($model->user_id)->username,
	        ],
	        [
		        'attribute' => 'created_at',
		        'format' => 'date',
	        ],
        ],
    ]) ?>

</div>
