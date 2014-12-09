<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\tinymce\TinyMce;
use dosamigos\fileupload\FileUpload;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\Metodychky */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="metodychky-form">

   <?php $form = ActiveForm::begin([
        'options'=>['enctype'=>'multipart/form-data'] // important
    ]); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => 255]) ?>

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
	
	
   	
	<? if(!empty($model->file)){echo Html::img('@web/uploads/metod/'.$model->file);} ?>


	<?= $form->field($model, 'file')->widget(FileUpload::classname(), [
        'url' => ['metodychky/create','id' => $model->id], // your url, this is just for demo purposes,
	    'options' => ['accept' => 'image/*'],
	    'clientOptions' => [
	        'maxFileSize' => 2000000
	    ],
    ]);?>


	
	<?= $form->field($model, 'active')->dropDownList(['1' => 'Активнo', '0' => 'Неактивнo'])  ?>

	
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Створити' : 'Оновити', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
