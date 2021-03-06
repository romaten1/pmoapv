<?php
use dektrium\user\models\User;
use yii\helpers\Html;

?>


<div class="panel panel-default">
    <div class="panel-heading text-right">
		<span class="pull-left"><strong class="">Від
                <?= Html::a( User::findOne( $model->author_id )->username,
                    [ '/user/profile/show/', 'id' => $model->author_id ] ) ?></strong></span>
        <?= date( "H:i:s - d.m.y", $model->created_at ) ?>
    </div>
    <div class="panel-body">
        <div class="col-md-8"><?= $model->text ?></div>
        <div class="col-md-2">
            <?= ( $model->recieved_at > 1 ? "Переглянуто" : Html::a( "Відмітити як переглянуте",
                [ '/message/recieve', 'id' => $model->id ] ) ) ?>
        </div>
        <div class="col-md-2">
            <?= Html::a( "Відповісти", [ '/message/user-message', 'receiver_id' => $model->author_id ] ) ?>
        </div>
    </div>
</div>