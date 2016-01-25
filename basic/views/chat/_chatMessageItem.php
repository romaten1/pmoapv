<?php
use app\models\Teacher;
use yii\helpers\Html;

?>


<div class="panel panel-default">
    <div class="panel-heading text-right">
		<span class="pull-left"><strong class="">Від
                <?= Html::a( $model->user->username . ' ('
                             . Teacher::getTeacherNameByUserId($model->user->id) . ') ',
                    [ '/user/profile/show/', 'id' => $model->user->id ] ) ?></strong></span>
        <?= date( "H:i:s - d.m.y", $model->created_at ) ?>
    </div>
    <div class="panel-body">
        <div class="col-md-8"><?= $model->message ?></div>

    </div>
</div>