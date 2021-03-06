<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use mihaildev\ckeditor\CKEditor;
use mihaildev\elfinder\ElFinder;
use app\models\Metodychky;
use app\helpers\FileHelper;

/* @var $this yii\web\View */
/* @var $model app\models\Metodychky */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="metodychky-form">

    <?php $form = ActiveForm::begin( [
        'options' => [ 'enctype' => 'multipart/form-data' ] // important
    ] ); ?>

    <?= $form->field( $model, 'title' )->textInput( [ 'maxlength' => 255 ] ) ?>

    <?= $form->field( $model, 'description' )->widget( CKEditor::className(), [
        'editorOptions' => ElFinder::ckeditorOptions( [ 'elfinder', 'path' => 'Global' ], [
                'preset' => 'full',
                'inline' => false,
                'height' => '250'
            ]
        ),
    ] ); ?>

    <? if ( ! empty( $model->file )) {
        echo "Присутній файл:" . Html::encode( $model->file ) . ". Розмір файлу: " . FileHelper::Size2Str( $model->size );
    } ?>

    <?= $form->field( $model, 'file' )->fileInput() ?>

    <?= $form->field( $model, 'active' )->dropDownList( Metodychky::getStatusArray() ) ?>


    <div class="form-group">
        <?= Html::submitButton( $model->isNewRecord ? 'Створити' : 'Оновити',
            [ 'class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary' ] ) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
