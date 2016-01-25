<?php

use app\modules\customer\models\Customer;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\customer\models\CustomerOrder */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="customer-order-form">
    <div class="row">
        <div class="col-md-10">
    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field( $model, 'customer_id' )->dropDownList( Customer::getCustomersArray(),
        [ 'prompt' => 'выберите покупателя ...' ] ) ?>

    <?php echo $form->field( $model, 'posted_at' )->widget( 'trntv\yii\datetimepicker\DatetimepickerWidget', [
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

    <?= $form->field($model, 'amount')->textInput() ?>

    <?php echo $form->field( $model, 'paid_at' )->widget( 'trntv\yii\datetimepicker\DatetimepickerWidget', [
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

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Создать' : 'Обновить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>
        </div>
    </div>

</div>
