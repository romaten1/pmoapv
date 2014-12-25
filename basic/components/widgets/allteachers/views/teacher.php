<?php 
	use yii\helpers\Html;
	use yii\helpers\Url;
	use yii\widgets\ListView;
 ?>


    <div class="container">    
        <div class="jumbotron">        
            <h2>Викладачі кафедри</h2>       
        </div>
        
	        <?= $this->render('_index_loop', [
		    	'models' => $models
		    ]) ?>
        <p class="text-center">
        	<a class="btn btn-primary" href= <?= Url::to(['/teacher']); ?> >
        		Всі викладачі ... 
        	</a>
        </p>
    </div>


