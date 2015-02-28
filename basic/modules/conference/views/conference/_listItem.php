<?php
use yii\helpers\Html;
use app\helpers\FileHelper;
?>


<div class="row">
	<div class="col-md-12">
		<h2><?= Html::a(Html::encode($model->title), ['view', 'id' => $model->id]); ?></h2><br />
		<?= $model->conference_date;?>
	</div>

</div>
<br />
