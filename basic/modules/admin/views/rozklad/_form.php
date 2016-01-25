<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use mihaildev\ckeditor\CKEditor;
use mihaildev\elfinder\ElFinder;
use app\models\Teacher;

/* @var $this yii\web\View */
/* @var $model app\models\Teacher */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="teacher-form">
    <h2>Заванажуйте файли в форматi .xls</h2>
    <?php $form = ActiveForm::begin( [
        'options' => [ 'enctype' => 'multipart/form-data' ] // important
    ] ); ?>

    <?= $form->field( $model, 'file' )->fileInput() ?>

    <?= $form->field( $model, 'file2' )->fileInput() ?>

    <div class="form-group">
        <?= Html::submitButton( 'Оновити',
            [ 'class' => 'btn btn-success' ] ) ?>
    </div>

    <?php ActiveForm::end(); ?>

    <? if ( ! empty( $result )) {
        echo  $result ;
    } ?>

</div>
