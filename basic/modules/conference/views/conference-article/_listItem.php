<?php
use yii\helpers\Html;
use app\modules\conference\models\Conference;
?>


<div class="row">
	<div class="col-md-12">
		<h2><?= Html::a(Html::encode($model->title), ['view', 'id' => $model->id]); ?></h2>
		<h4>Автори: <?= $model->author;?></h4>
		<h4><?= Conference::getConferenceLabel($model->conference_id);?></h4>
	</div>

</div>
<br />
