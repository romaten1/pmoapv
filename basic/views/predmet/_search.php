<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\search\MetodychkySearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="predmet-search">

    <?php $form = ActiveForm::begin( [
        'action' => [ 'index' ],
        'method' => 'get',
    ] ); ?>
    <div class="col-md-12">
        <?= $form->field( $model, 'title' ) ?>

        <div class="form-group">
            <?= Html::submitButton( 'Пошук', [ 'class' => 'btn btn-primary' ] ) ?>
            <?= '';//Html::resetButton('Відмінити', ['class' => 'btn btn-default'])  ?>
        </div>
    </div>
    <?php ActiveForm::end(); ?>

</div>
