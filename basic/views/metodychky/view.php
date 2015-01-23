<?php

use yii\helpers\Html;
use yii\helpers\Url;
use app\helpers\FileHelper;

/* @var $this yii\web\View */
/* @var $model app\models\Metodychky */

$this->title                   = $model->title;
$this->params['breadcrumbs'][] = [ 'label' => 'Методичні вказівки', 'url' => [ 'index' ] ];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="metodychky-view">

	<h2><?= Html::encode( $this->title ) ?></h2>
	<p>
		<?php if(Yii::$app->user->can('moderator')){
					echo Html::a('Оновити методичні вказівки', ['/metodychky/update/', 'id' => $model->id ], ['class' => 'btn btn-success']);
				} ?>
	</p>
	<p><?= $model->description ?></p>

	<p>
		<strong>Електронна версія: </strong>
		<?php
		echo $model->file ?
			' <a href=' . Url::to( '/basic/web/uploads/metodychky/' . $model->file,	true ) .
			' >' . $model->title . '</a>' .	'<br />Розмір файлу: ' . FileHelper::Size2Str( $model->size )
			: 'Файл на сайті відсутній';
		echo '<br />Додано: ' . date( 'd.m.Y', $model->updated_at );;
		?>
	</p>

	<div class="row">
		<div class="col-md-6">
			<div class="well well-sm">Автори методичних вказівок:</div>
			<p><?php
				foreach ( $model->teachers as $teach ) {
					echo
						Html::a( $teach->last_name . ' '
						         . $teach->name . ' '
						         . $teach->second_name,
							[ '/teacher/view', 'id' => $teach->id ] )
						. '<br />';
				}
				?></p>
		</div>
	</div>
</div>
