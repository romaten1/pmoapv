<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Message;

/* @var $this yii\web\View */
/* @var $model app\models\Message */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="message-form">

    <?php $form = ActiveForm::begin(); ?>  

    <?= $form->field($model, 'receiver_id')->textInput() ?>

    <?= $form->field($model, 'text')->textarea(['rows' => 6]) ?> 

    <?= $form->field($model, 'recieved_at')->textInput() ?>

    <?= $form->field($model, 'active')->dropDownList(Message::getStatusArray())  ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Створити' : 'Оновити', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
