<?php

use yii\helpers\Html;
use app\modules\conference\models\Conference;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\modules\conference\models\ConferenceArticle */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Наукові заходи', 'url' => ['/conference']];
$this->params['breadcrumbs'][] = ['label' => 'Статті конференцій', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="conference-article-view">

    <h1><?= Html::encode($this->title) ?></h1>
	<h4>Стаття відноситься до конференції: <?= Conference::getConferenceLabel($model->conference_id);?></h4>
	<h4>Автори: <?= $model->author;?></h4>

	<p>
		<?= $model->description;?>
	</p>
	<p>
		<strong>Електронна версія: </strong>
		<?php
		echo $model->file ?
			' <a href=' . Url::to( '@web/uploads/conference/' . $model->file,	true ) .
			' >' . $model->title . '</a>' .	'<br /> ' : 'Файл на сайті відсутній<br />';
		echo 'Додано: ' . date( 'd.m.Y', $model->updated_at );;
		?>
	</p>
</div>
