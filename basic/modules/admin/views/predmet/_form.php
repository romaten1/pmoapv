<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use mihaildev\ckeditor\CKEditor;
use mihaildev\elfinder\ElFinder;
use app\models\Predmet;

/* @var $this yii\web\View */
/* @var $model app\models\Predmet */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="predmet-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field( $model, 'title' )->textInput( [ 'maxlength' => 255 ] ) ?>

    <?= $form->field( $model, 'description' )->widget( CKEditor::className(), [
        'editorOptions' => ElFinder::ckeditorOptions( [ 'elfinder', 'path' => 'Global' ], [
                'preset' => 'full',
                'inline' => false,
                'height' => '250'
            ]
        ),
    ] ); ?>

    <?= $form->field( $model, 'active' )->dropDownList( Predmet::getStatusArray() ) ?>

    <div class="form-group">
        <?= Html::submitButton( $model->isNewRecord ? 'Створити' : 'Оновити',
            [ 'class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary' ] ) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
