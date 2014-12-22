<?php 
	use yii\helpers\Html;
	use yii\widgets\ListView;
 ?>

<div id="metodychky-widget">
    <h3><?= Html::a('Методичні вказівки', 
			['/metodychky']) ?></h3>
    <?= $this->render('_index_loop', [
    	'models' => $models
    ]) ?>
</div>

