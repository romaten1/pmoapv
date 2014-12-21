<?php 
	use yii\helpers\Html;
	use yii\widgets\ListView;
 ?>

<div id="news-widget">
    <h3><?= 'Новини кафедри' ?></h3>
    <?= $this->render('_index_loop', [
    	'models' => $models
    ]) ?>
</div>

