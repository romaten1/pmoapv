<?php 
	use yii\helpers\Html;
	use yii\widgets\ListView;
 ?>

<div id="teacher-widget">
    <h3><?= Html::a('Викладачі кафедри', 
			['/teacher']) ?></h3>
    <?= $this->render('_index_loop', [
    	'models' => $models
    ]) ?>
</div>

