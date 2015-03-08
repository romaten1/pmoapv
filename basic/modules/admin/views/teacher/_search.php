<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\TeacherSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="teacher-search">

    <?php $form = ActiveForm::begin( [
        'action' => [ 'index' ],
        'method' => 'get',
    ] ); ?>

    <?= $form->field( $model, 'id' ) ?>

    <?= $form->field( $model, 'name' ) ?>

    <?= $form->field( $model, 'second_name' ) ?>

    <?= $form->field( $model, 'last_name' ) ?>

    <?= $form->field( $model, 'image' ) ?>

    <?php // echo $form->field($model, 'job') ?>

    <?php // echo $form->field($model, 'science_status') ?>

    <?php // echo $form->field($model, 'org_status') ?>

    <?php // echo $form->field($model, 'description') ?>

    <div class="form-group">
        <?= Html::submitButton( 'Search', [ 'class' => 'btn btn-primary' ] ) ?>
        <?= Html::resetButton( 'Reset', [ 'class' => 'btn btn-default' ] ) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
