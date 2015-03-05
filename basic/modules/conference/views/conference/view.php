<?php

use yii\helpers\Html;

use app\modules\conference\models\ConferenceArticle;
use kartik\icons\Icon;

Icon::map($this);
/* @var $this yii\web\View */
/* @var $model app\modules\conference\models\Conference */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Наукові заходи', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="conference-view">

	<h2><?= Html::encode($this->title) ?> </h2>

	<p><?= 'Дата проведення: '.Html::encode($model->conference_date) ?></p>

	<p><?= $model->description?></p>
	<div class="row">
		<div class="col-md-12">
			<div class="well well-sm">Опубліковані роботи, що відносяться до даного наукового заходу: </div>
			<p><?php
				foreach ( $model->articles as $article ) {
					if ( $article->active == ConferenceArticle::STATUS_ACTIVE ) {
						echo
							Icon::show('file-pdf-o') . Html::a( $article->title . ' ',
								[ '/conference/conference-article/view', 'id' => $article->id ] )
							. '<br />';
					}
				}
				?></p>
		</div>
	</div>


</div>
