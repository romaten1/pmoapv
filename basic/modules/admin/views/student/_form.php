<?php

use app\models\Student;
use app\models\StudentGroup;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Student */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="student-form">

    <?php $form = ActiveForm::begin( [
        'options' => [ 'enctype' => 'multipart/form-data' ] // important
    ] ); ?>

    <?= $form->field($model, 'first_name')->textInput(['maxlength' => 100]) ?>

    <?= $form->field($model, 'second_name')->textInput(['maxlength' => 100]) ?>

    <? if ( ! empty( $model->image )) {
        echo Html::img( '@web/uploads/student/' . $model->image );
    } ?>

    <?= $form->field( $model, 'image' )->fileInput() ?>

    <?= $form->field( $model, 'group_id' )->dropDownList( ArrayHelper::map( StudentGroup::find()->all(), 'id',
        'title' ) ) ?>

    <?= $form->field( $model, 'active' )->dropDownList( Student::getStatusArray() ) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
