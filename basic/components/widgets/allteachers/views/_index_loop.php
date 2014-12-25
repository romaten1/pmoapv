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
		
		$teacher_full_name = $model->last_name . ' ' . $model->name . ' '. $model->second_name;
	    
	    if($row%2 == 0){ 
				echo '<div class="row row-pad">';
			}    
		echo '<div class="col-md-6">
                <div class="row">
                    <div class="col-md-2">
                        <a href="'.Url::to('@web/uploads/teacher/').$model->image.'" rel="prettyPhoto" title="">
                            <img src="'.Url::to('@web/uploads/teacher/thumbs/thumb_').$model->image.'" alt="" />
                        </a>
                    </div>
                    <div class="col-md-10">'
                        .Html::a(Html::encode($teacher_full_name), ['/teacher/view', 'id' => $model->id],['class'=>'text-primary']).
                        '<br />'
                        .$model->job . ', ' . $model->science_status .
                    '</div>
                </div>
            </div>';

		if($row%2 != 0){ 
			echo '</div>';
		}	
		$row++;
	}	
}