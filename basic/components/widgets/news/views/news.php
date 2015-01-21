<?php 
	use yii\helpers\Html;
	use yii\widgets\ListView;
 ?>



<div class="panel panel-primary" id="news-widget">
  <div class="panel-heading"><h3 class="panel-title"><?= Html::a('Новини кафедри', 
			['/news']) ?></h3></div>
  <div class="panel-body">
    <?= $this->render('_index_loop', [
    	'models' => $models
    ]) ?>
  </div>
  
</div>