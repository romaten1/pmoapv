<?php 
	use yii\helpers\Url;
 ?>


    <div class="container">    
        <div class="jumbotron">        
            <h2 class="featurette-heading">Останні новини</h2>       
        </div>
        
	        <?= $this->render('_index_loop', [
		    	'models' => $models
		    ]) ?>
        <p class="text-center">
        	<a class="btn btn-success" href= <?= Url::to(['/news']); ?> >
        		Всі новини ... 
        	</a>
        </p>
    </div>


