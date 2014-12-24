<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\tinymce\TinyMce;
use mihaildev\ckeditor\CKEditor;
use mihaildev\elfinder\ElFinder;

/* @var $this yii\web\View */
/* @var $model app\models\Teacher */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="teacher-form">

    <?php $form = ActiveForm::begin([
        'options'=>['enctype'=>'multipart/form-data'] // important
    ]); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => 100]) ?>

    <?= $form->field($model, 'second_name')->textInput(['maxlength' => 100]) ?>

    <?= $form->field($model, 'last_name')->textInput(['maxlength' => 100]) ?>

    <? if(!empty($model->image)){echo Html::img('@web/uploads/teacher/'.$model->image);} ?>

    <?= $form->field($model, 'image')->fileInput() ?>

    <?= $form->field($model, 'job')->textInput(['maxlength' => 100]) ?>

    <?= $form->field($model, 'science_status')->textInput(['maxlength' => 100]) ?>

    <?= $form->field($model, 'org_status')->textInput(['maxlength' => 100]) ?>

    <?= $form->field($model, 'description')->widget(CKEditor::className(),[
        'editorOptions' => ElFinder::ckeditorOptions(['elfinder', 'path' => 'Global'],['preset' => 'full', 
            'inline' => false,
            'height' => '250']
            ),        
    ]);?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Створити' : 'Оновити', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
