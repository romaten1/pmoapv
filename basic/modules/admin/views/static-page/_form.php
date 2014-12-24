<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use mihaildev\ckeditor\CKEditor;
use mihaildev\elfinder\ElFinder;

/* @var $this yii\web\View */
/* @var $model app\models\StaticPage */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="static-page-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'alias')->textInput(['maxlength' => 100]) ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'text')->widget(CKEditor::className(),[
        'editorOptions' => ElFinder::ckeditorOptions(['elfinder', 'path' => 'Global'],['preset' => 'full', 
            'inline' => false,
            'height' => '250']
            ),        
    ]);?>

    <?= $form->field($model, 'active')->dropDownList(['1' => 'Активнo', '0' => 'Неактивнo'])  ?>

    <?= $form->field($model, 'parent_group_id')->dropDownList(['0' => 'Про кафедру', '1' => 'Абітурієнту', '2' => 'Студенту', '3' => 'Наукова робота', ])  ?>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Створити' : 'Оновити', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
