<?php

use yii\helpers\Html;
use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\conference\models\ConferenceArticleSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Статті з конференцій';
$this->params['breadcrumbs'][] = ['label' => 'Наукові заходи', 'url' => ['/conference']];
$this->params['breadcrumbs'][] = ['label' => $this->title, 'url' => ['index']];
?>
<div class="conference-article-index">

    <h1><?= Html::encode($this->title) ?></h1>
	<div class="panel-group" id="accordion">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h4 class="panel-title">
					<a class="accordion-toggle" href="#collapseOne" data-toggle="collapse" data-parent="#accordion">
						Пошук серед статей
					</a>
				</h4>
			</div>
			<div class="panel-collapse collapse" id="collapseOne">
				<div class="panel-body">
					<div class="row">
						<?php  echo $this->render('_search', ['model' => $searchModel]); ?>
					</div>
				</div>
			</div>
		</div>
	</div>

    <?= ListView::widget([
        'dataProvider' => $dataProvider,
        'itemOptions' => ['class' => 'item well'],
        'itemView' => '_listItem',
    ]) ?>

</div>
