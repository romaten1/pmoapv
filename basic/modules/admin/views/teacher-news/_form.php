<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Teacher;
use app\models\TeacherNews;
use mihaildev\ckeditor\CKEditor;
use mihaildev\elfinder\ElFinder;

/* @var $this yii\web\View */
/* @var $model app\models\TeacherNews */
/* @var $form yii\widgets\ActiveForm */

$fullname = Teacher::getUserIdTeacherNameArray();
?>

<div class="teacher-news-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field( $model, 'teacher_id' )->dropDownList( $fullname ) ?>

    <?= $form->field( $model, 'title' )->textInput( [ 'maxlength' => 255 ] ) ?>

    <?= $form->field( $model, 'text' )->widget( CKEditor::className(), [
        'editorOptions' => ElFinder::ckeditorOptions( [ 'elfinder', 'path' => 'Global' ], [
                'preset' => 'full',
                'inline' => false,
                'height' => '250'
            ]
        ),
    ] ); ?>

    <strong>Створено:</strong> <?= date( 'H:i / d-m-Y', $model->created_at ) ?><br/><br/>

    <strong>Оновлено:</strong> <?= date( 'H:i / d-m-Y', $model->updated_at ) ?><br/><br/>

    <?= $form->field( $model, 'active' )->dropDownList( TeacherNews::getStatusArray() ) ?>

    <div class="form-group">
        <?= Html::submitButton( $model->isNewRecord ? 'Створити' : 'Оновити',
            [ 'class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary' ] ) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
