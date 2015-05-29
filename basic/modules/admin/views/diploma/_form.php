<?php

use app\models\Diploma;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Diploma */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="diploma-form">

    <?php $form = ActiveForm::begin( [
        'options' => [ 'enctype' => 'multipart/form-data' ] // important
    ] ); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => 255]) ?>

    <? if ( ! empty( $model->image )) {
        echo Html::img( '@web/uploads/diploma/' . $model->image );
    } ?>

    <?= $form->field( $model, 'image' )->fileInput() ?>

    <?= $form->field( $model, 'rating' )->dropDownList( [ 1 => 1, 2 => 2, 3 => 3, 4 => 4, 5 => 5] ) ?>

    <?= $form->field( $model, 'active' )->dropDownList( Diploma::getStatusArray() ) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
