<?php

use app\models\Chat;
use app\models\Teacher;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ChatMessage */
/* @var $form yii\widgets\ActiveForm */

$fullname = Teacher::getUserIdTeacherNameArray();
?>

<div class="chat-message-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'chat_id')->dropDownList( Chat::getChatsArray() ) ?>

    <?= $form->field( $model, 'user_id' )->dropDownList( $fullname ) ?>

    <?= $form->field($model, 'message')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
