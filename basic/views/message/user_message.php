<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dektrium\user\models\User;
use app\models\Teacher;

/* @var $this yii\web\View */
/* @var $model app\models\Message */
/* @var $receiver_id */

$this->title                   = 'Написати повідомлення';
$this->params['breadcrumbs'][] = [ 'label' => 'Повідомлення', 'url' => [ 'index' ] ];
$this->params['breadcrumbs'][] = $this->title;
if (Teacher::getTeacherByUserId( $receiver_id )) {
    $username = Teacher::getTeacherNameByUserId( $receiver_id );
} else {
    $username = Html::encode( User::findOne( $receiver_id )->username );
}
?>
<div class="message-create">

    <h1><?= Html::encode( $this->title ) ?></h1>

    <div class="message-form">

        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field( $model, 'receiver_id' )->dropDownList( [ $username ] ) ?>

        <?= $form->field( $model, 'text' )->textarea( [ 'rows' => 6 ] ) ?>

        <div class="form-group">
            <?= Html::submitButton( 'Створити', [ 'class' => 'btn btn-success' ] ) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>

</div>
