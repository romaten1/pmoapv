<?php

use yii\helpers\Html;
use yii\widgets\ListView;
use kartik\icons\Icon;

/* @var $this yii\web\View */
/* @var $searchModel app\models\NewsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Новини';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="news-index">

    <h1><?= Html::encode($this->title) ?></h1>
	<div class="panel-group" id="accordion">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h4 class="panel-title">
					<a class="accordion-toggle" href="#collapseOne" data-toggle="collapse" data-parent="#accordion">
						Пошук серед новин
					</a>
				</h4>
			</div>
			<div class="panel-collapse collapse" id="collapseOne">
				<div class="panel-body">
					<div class="row">
						<?php echo $this->render('_search', ['model' => $searchModel]); ?>
					</div>

				</div>
			</div>
		</div>
	</div>
    <?= ListView::widget([
        'dataProvider' => $dataProvider,
        'itemOptions' => ['class' => 'item'],
        'itemView' => '_listItem',
    ]) ?>

    

</div>
