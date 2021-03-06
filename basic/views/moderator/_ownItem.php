<?php
use dektrium\user\models\User;
use yii\helpers\Html;

?>


<div class="panel panel-default">
    <div class="panel-heading text-right">
		<span class="pull-left"><strong class="">Для
                <?= Html::a( User::findOne( $model->receiver_id )->username,
                    [ '/user/profile/show/', 'id' => $model->receiver_id ] ) ?>
            </strong></span>
        <?= date( "H:i:s - d.m.y", $model->created_at ) ?>
    </div>
    <div class="panel-body">
        <?= $model->text ?>
    </div>
</div>