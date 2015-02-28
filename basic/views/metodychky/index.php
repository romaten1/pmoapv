<?php

use yii\helpers\Html;
use yii\widgets\ListView;
use app\assets\AccordeonAsset;

/* @var $this yii\web\View */
/* @var $searchModel app\models\MetodychkySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
AccordeonAsset::register($this);

$this->title = 'Навчально-методичне забезпечення кафедри';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="metodychky-index">

   <h1><?= Html::encode($this->title) ?></h1>
	<div class="panel-group" id="accordion">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h4 class="panel-title">
					<a class="accordion-toggle" href="#collapseOne" data-toggle="collapse" data-parent="#accordion">
						Пошук серед методичних вказівок
					</a>
				</h4>
			</div>
			<div class="panel-collapse collapse" id="collapseOne">
				<div class="panel-body">
					<div class="row">
						<?php  echo $this->render('_search', ['model' => $searchModel]); ?>
					</div
				</div>
			</div>
		</div>
	</div>

    <p>
        <?= ''; //Html::a('Створити методичні вказівки', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= ListView::widget([
        'dataProvider' => $dataProvider,
       //'options' => ['class' => 'list-group'],
        'itemOptions' => ['class' => 'item well'],
        'itemView' => '_listItem',
        'layout' => '{items}{pager}',
    ]) ?>

	</div>
</div>