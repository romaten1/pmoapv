<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\modules\conference\models\ConferenceArticle;
use app\modules\conference\models\Conference;
use mihaildev\ckeditor\CKEditor;
use mihaildev\elfinder\ElFinder;
use app\helpers\FileHelper;

/* @var $this yii\web\View */
/* @var $model app\modules\conference\models\ConferenceArticle */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="conference-article-form">

    <?php $form = ActiveForm::begin( [
        'options' => [ 'enctype' => 'multipart/form-data' ] // important
    ] ); ?>

    <?= $form->field( $model, 'conference_id' )->dropDownList( Conference::getConferenceArray() ) ?>

    <?= $form->field( $model, 'title' )->textInput( [ 'maxlength' => 256 ] ) ?>

    <?= $form->field( $model, 'description' )->widget( CKEditor::className(), [
        'editorOptions' => ElFinder::ckeditorOptions( [ 'elfinder', 'path' => 'Global' ], [
                'preset' => 'full',
                'inline' => false,
                'height' => '250'
            ]
        ),
    ] ); ?>

    <? if ( ! empty( $model->file )) {
        echo "Присутній файл:" . Html::encode( $model->file );
    } ?>

    <?= $form->field( $model, 'file' )->fileInput() ?>

    <?= $form->field( $model, 'active' )->dropDownList( ConferenceArticle::getStatusArray() ) ?>

    <?= $form->field( $model, 'author' )->textInput( [ 'maxlength' => 256 ] ) ?>

    <div class="form-group">
        <?= Html::submitButton( $model->isNewRecord ? 'Створити' : 'Оновити',
            [ 'class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary' ] ) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
