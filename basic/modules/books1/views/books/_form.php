<?php

use app\modules\books\models\Authors;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\books\models\Books */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="books-form">

    <?php $form = ActiveForm::begin( [
        'options' => [ 'enctype' => 'multipart/form-data' ] // important
    ] ); ?>

    <?= $form->field( $model, 'name' )->textInput( [ 'maxlength' => true ] ) ?>

    <? if ( ! empty( $model->preview )) {
        echo Html::a( Html::img( "img/books/thumbs/thumb_" . $model->preview, [ 'width' => '100px' ] ),
            '/img/books/' . $model->preview,
            [
                'class'         => 'thumbnail',
                'data-lightbox' => 'image-1',
                'data-title'    => $model->name,
            ] );
    } ?>

    <?= $form->field( $model, 'preview' )->fileInput() ?>

    <?php echo $form->field( $model, 'date' )->widget( 'trntv\yii\datetimepicker\DatetimepickerWidget', [
        'phpDatetimeFormat'    => 'dd-MM-yyyy',
        'momentDatetimeFormat' => 'DD-MM-YYYY',
        'clientOptions'        => [
            'viewMode'          => 'months',
            'minDate'           => new \yii\web\JsExpression( 'new Date("1970-01-01")' ),
            'sideBySide'        => true,
            'showClear'         => true,
            'widgetPositioning' => [
                'horizontal' => 'auto',
                'vertical'   => 'auto'
            ]
        ]
    ] ); ?>

    <?= $form->field( $model, 'author_id' )->dropDownList( Authors::getAuthorsArray(),
        [ 'prompt' => 'выберите автора ...' ] ) ?>

    <div class="form-group">
        <?= Html::submitButton( 'Обновить',
            [ 'class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary' ] ) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
