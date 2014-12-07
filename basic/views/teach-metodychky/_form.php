<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\TeachMetodychky */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="teach-metodychky-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'teach_id')->textInput() ?>

    <?= $form->field($model, 'metodychky_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Створити' : 'Оновити', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
