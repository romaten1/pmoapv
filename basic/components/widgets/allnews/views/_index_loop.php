<?php
use yii\helpers\Html;
use yii\helpers\Url;
/**
 * Представление цикла последних постов.
 * @var yii\base\View $this Представление
 * @var common\modules\blogs\models\Post $models Массив моделей
 */


if ($models) {
	$row = 0;
	foreach ($models as $model) {
		
		if($row%2 == 0){ 
				echo '<div class="row row-pad">';
			}    
		echo '<div class="col-md-6">
                <div class="row">
                    <div class="col-md-3">
                        <a href="'.Url::to('@web/uploads/news/').$model->image.'" rel="prettyPhoto" title="">
                            <img src="'.Url::to('@web/uploads/news/thumbs/thumb_').$model->image.'" alt="" />
                        </a>
                    </div>
                    <div class="col-md-9">'
                        .Html::a(Html::encode($model->title), ['/news/view', 'id' => $model->id],['class'=>'text-primary']).                        
                    '</div>
                </div>
            </div>';

		if($row%2 != 0){ 
			echo '</div>';
		}	
		$row++;
	}	
}