<?php

use app\modules\books\models\Authors;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\books\models\BooksSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="books-search">

    <?php $form = ActiveForm::begin( [
        'action' => [ 'index' ],
        'method' => 'get',
    ] ); ?>
    <div class="row">
        <div class="col-md-4">
            <?= $form->field( $model, 'author_id' )->dropDownList( Authors::getAuthorsArray(),
                [ 'prompt' => 'авторы ...' ] ) ?>
        </div>
        <div class="col-md-4">
            <?= $form->field( $model, 'name' )->textInput( [ 'maxlength' => 10 ] ) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <?php echo $form->field( $model, 'date_min' )->widget( 'trntv\yii\datetimepicker\DatetimepickerWidget', [
                'phpDatetimeFormat'    => 'dd-MM-yyyy',
                'momentDatetimeFormat' => 'DD-MM-YYYY',
                'clientOptions'        => [
                    //'useCurrent' => 'false',
                    //'defaultDate' => '',
                    'viewMode' => 'months',
                    'minDate'           => new \yii\web\JsExpression( 'new Date("1970-01-01")' ),
                    'sideBySide'        => true,
                    'showClear' => true,
                    'widgetPositioning' => [
                        'horizontal' => 'auto',
                        'vertical'   => 'auto'
                    ]
                ]
            ] ); ?>
        </div>
        <div class="col-md-4">
            <?php echo $form->field( $model, 'date_max' )->widget( 'trntv\yii\datetimepicker\DatetimepickerWidget', [
                'phpDatetimeFormat'    => 'dd-MM-yyyy',
                'momentDatetimeFormat' => 'DD-MM-YYYY',
                'clientOptions'        => [
                    //'useCurrent' => 'false',
                    //'defaultDate' => new \yii\web\JsExpression( 'new Date()' ),
                    'viewMode' => 'months',
                    'minDate'           => new \yii\web\JsExpression( 'new Date("1970-01-01")' ),
                    'sideBySide'        => true,
                    'showClear' => true,
                    'widgetPositioning' => [
                        'horizontal' => 'auto',
                        'vertical'   => 'auto'
                    ]
                ]

            ] ); ?>
        </div>
        <div class="col-md-4">
            <div class=" form-group">
                <?= Html::submitButton( 'Искать', [ 'class' => 'btn btn-primary pull-right' ] ) ?>
            </div>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
