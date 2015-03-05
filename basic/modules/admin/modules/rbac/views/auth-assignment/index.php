<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\modules\admin\modules\rbac\models\AuthItem;
use dektrium\user\models\User;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\admin\modules\rbac\models\AuthAssignmentSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Ролі користувачів';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="auth-assignment-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Задати роль користувача', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
		        'attribute' => 'user_id',
		        'format' => 'html',
		        'value' => function ($model) {
			        $username = User::findOne($model->user_id);
			        return Html::a($username->username, ['/user/profile/show', 'id' => $username->id, ['class' => 'btn btn-success']]);},

	        ],
	        [
		        'attribute' => 'item_name',
		        'format' => 'html',
		        'filter' => AuthItem::getAuthItemArray()
	        ],
            [
		        'attribute' => 'created_at',
		        'format' => 'date',
	        ],


            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
