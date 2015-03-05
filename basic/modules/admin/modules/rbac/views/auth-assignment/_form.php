<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\modules\admin\modules\rbac\models\AuthItem;
use dektrium\user\models\User;
use app\modules\admin\modules\rbac\models\AuthAssignment;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\modules\rbac\models\AuthAssignment */
/* @var $form yii\widgets\ActiveForm */

?>

<div class="auth-assignment-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'item_name')->dropDownList(AuthItem::getAuthItemArray(), ['prompt'=>'Виберіть роль ...'])  ?>

	<?php echo (!empty($model->user_id)) ? '<p><b>Користувач: '.User::findOne($model->user_id)->username.'</b></p>' : '' ?>
	<?php
		if(!empty($model->user_id)){
			$user = AuthAssignment::find()->where(['user_id' => $model->user_id])->one();
			$role = $user->item_name;
			echo '<p><b>Поточна роль: ';
			if(!empty($role) && $model->isNewRecord){
				echo $role . '</b></p>';
				echo 'Роль уже задано для цього користувача! краще змініть існуючу ' .
				Html::a('Редагувати роль', ['/rbac/auth-assignment/update', 'user_id' => $user->user_id, 'item_name' => $user->item_name], ['class' => 'btn btn-xl btn-danger']);

			} else {
				echo $role ? $role : 'Роль відсутня</b></p>';
				echo $form->field($model, 'user_id')->textInput(['maxlength' => 64]);
				echo '<div class="form-group">';
				echo Html::submitButton($model->isNewRecord ? 'Створити' : 'Оновити', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']);
			}
		}
    else {
	    echo $form->field($model, 'user_id')->textInput(['maxlength' => 64]);
	    echo '<div class="form-group">';
	    echo Html::submitButton($model->isNewRecord ? 'Створити' : 'Оновити', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']);

    }

	?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
