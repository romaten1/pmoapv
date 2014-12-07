<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\tinymce\TinyMce;
use dosamigos\fileupload\FileUpload;

/* @var $this yii\web\View */
/* @var $model app\models\Teacher */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="teacher-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => 100]) ?>

    <?= $form->field($model, 'second_name')->textInput(['maxlength' => 100]) ?>

    <?= $form->field($model, 'last_name')->textInput(['maxlength' => 100]) ?>

    <? if(!empty($model->image)){echo Html::img('@web/uploads/images/'.$model->image);} ?>


    <?= $form->field($model, 'image')->widget(FileUpload::classname(), [
        'url' => ['metodychky/create','id' => $model->id], // your url, this is just for demo purposes,
        'options' => ['accept' => 'image/*'],
        'clientOptions' => [
            'maxFileSize' => 2000000
        ],
    ]);?>

    <?= $form->field($model, 'job')->textInput(['maxlength' => 100]) ?>

    <?= $form->field($model, 'science_status')->textInput(['maxlength' => 100]) ?>

    <?= $form->field($model, 'org_status')->textInput(['maxlength' => 100]) ?>

    <?= $form->field($model, 'description')->widget(TinyMce::className(), [
        'options' => ['rows' => 6],
        'language' => 'ru',
        'clientOptions' => [
            'plugins' => [
                "advlist autolink lists link charmap print preview anchor",
                "searchreplace visualblocks code fullscreen",
                "insertdatetime media table contextmenu paste"
            ],
            'toolbar' => "undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image"
        ]
    ]);?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Створити' : 'Оновити', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
