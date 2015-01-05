<?php 
	use dektrium\user\models\User;
	use yii\helpers\Html;
 ?>


<div class="panel panel-default">
	<div class="panel-heading text-right">
		<span class="pull-left"><strong class="">Для <?=User::findOne($model->receiver_id)->username?></strong></span>
		<?=date("H:i:s - d.m.y", $model->created_at)?>
	</div>
	<div class="panel-body">
		<?=$model->text?>		
	</div>
</div>
