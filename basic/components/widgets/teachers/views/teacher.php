<?php 
	use yii\helpers\Html;
	use yii\widgets\ListView;
 ?>

<div id="teacher-widget">
    <h3><?= 'Викладачі кафедри' ?></h3>
    <?= $this->render('_index_loop', [
    	'models' => $models
    ]) ?>
</div>

