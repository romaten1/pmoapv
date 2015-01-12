<?php 
	use yii\helpers\Html;
    
    foreach($metodychky as $met) {               
        echo 
        Html::a($met->title, 
            ['/metodychky/view', 'id' => $met->id])
        . '<br />'; 
    } 
 ?>


