<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\modules\conference\models\ConferenceArticle;
use app\modules\conference\models\Conference;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\modules\conference\models\ConferenceArticle */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Статті конференцій', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="conference-article-view">

    <h1><?= Html::encode($this->title) ?></h1>

	<p>
		<?= Html::a('Оновити', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
		<?= Html::a('Видалити', ['delete', 'id' => $model->id], [
			'class' => 'btn btn-danger',
			'data' => [
				'confirm' => 'Ви впевнені, що хочете видалити цей запис?',
				'method' => 'post',
			],
		]) ?>
	</p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [

	        [
		        'attribute' => 'conference_id',
		        'value' => Conference::getConferenceLabel($model->conference_id),
		        'format' => 'html'
	        ],

            'title',
	        [
		        'attribute' => 'description',
		        'format' => 'html'
	        ],
	        [
		        'attribute' => 'file',
		        'value' => $model->file ? ' <a href=' . Url::to('/basic/web/uploads/conference/'. $model->file, true).' >' . $model->title.'</a>'
			        : 'Файл на сайті відсутній',
		        'format' => 'html'
	        ],
	        [
		        'attribute' => 'created_at',
		        'format' => 'date'
	        ],
	        [
		        'attribute' => 'updated_at',
		        'format' => 'date'
	        ],
	        [
		        'attribute' => 'active',
		        'value' => ConferenceArticle::getStatus($model->active),
	        ],
            'author',
        ],
    ]) ?>

</div>
