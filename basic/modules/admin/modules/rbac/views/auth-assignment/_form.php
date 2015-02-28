<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\modules\admin\modules\rbac\models\AuthItem;
use dektrium\user\models\User;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\modules\rbac\models\AuthAssignment */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="auth-assignment-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'item_name')->dropDownList(AuthItem::getAuthItemArray())  ?>

	<?php echo !$model->isNewRecord ? '<p><b>Користувач: '.User::findOne($model->user_id)->username.'</b></p>' : '' ?>

	<?= $form->field($model, 'user_id')->textInput(['maxlength' => 64]) ?>

	    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
