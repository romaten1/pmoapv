<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Message;
use app\models\Teacher;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Message */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="message-form">

    <?php $form = ActiveForm::begin(); ?>  

    <?= $form->field($model, 'receiver_id')->dropDownList(Teacher::getPrepodsArray()) ?>

    <?= $form->field($model, 'text')->textarea(['rows' => 6]) ?> 

    <div class="form-group">
        <?= Html::submitButton('Створити', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
