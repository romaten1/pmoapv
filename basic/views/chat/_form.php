<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Message;
use app\models\Teacher;

/* @var $this yii\web\View */
/* @var $model app\models\ChatMessage */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="message-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field( $model, 'message' )->textarea( [ 'rows' => 2 ] )->label('Нове повідомлення') ?>

    <div class="form-group">
        <?= Html::submitButton( 'Додати', [ 'class' => 'btn btn-success' ] ) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
