<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\ParentGroup */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="parent-group-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field( $model, 'title' )->textInput( [ 'maxlength' => 100 ] ) ?>

    <div class="form-group">
        <?= Html::submitButton( $model->isNewRecord ? 'Створити' : 'Оновити',
            [ 'class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary' ] ) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
