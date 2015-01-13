<?php
use yii\helpers\Html;
use yii\widgets\ListView;
use app\models\Teacher;
use app\models\Message;


/* @var $this yii\web\View */
?>

<div class="row">     
    <div class="col-md-9">
    <h2 class="featurette-heading">Сторінка викладача </h2>
        <div class="panel-group" id="accordion">
          <div class="panel panel-default">
            <div class="panel-heading">
              <h4 class="panel-title">
                <a class="accordion-toggle" href="#collapseOne" data-toggle="collapse" data-parent="#accordion">
                  Отримані повідомлення
                </a>
                <span class="pull-right">Непереглянутих: 
                    <span class="badge"><?= Message::getNotRecievedMessageCount(); ?></span></span>
                   
              </h4>
            </div>
            <div class="panel-collapse collapse" id="collapseOne">
              <div class="panel-body">
                <div class="row">
                    <div class="col-md-12">
                        <?= Html::a('Переглянути всі отримані повідомлення', ['/message/'], ['class' => 'btn btn-default pull-left']) ?>
                        <?= Html::a('Створити повідомлення', ['/message/create'], ['class' => 'btn btn-success pull-right']) ?>
                    </div>
               </div>
               <br />
                <?= ListView::widget([
                    'dataProvider' => $dataReceivedProvider,
                    'itemOptions' => ['class' => 'item'],
                    'itemView' => '_recievedItem',                        
                ]) ?>
              </div>
            </div>
          </div>
          <div class="panel panel-default">
            <div class="panel-heading">
              <h4 class="panel-title">
                <a class="accordion-toggle" href="#collapseThree" data-toggle="collapse" data-parent="#accordion">
                  Особисті методичні вказівки
                </a>
                <span class="pull-right">Всього: 
                    <span class="badge"><?= count($metodychky); ?></span></span>
                   
                
              </h4>
            </div>
            <div class="panel-collapse collapse" id="collapseThree">
              <div class="panel-body">
                <div class="col-md-9">
                    <?php foreach($metodychky as $met) { 
                    echo Html::a($met->title, ['/metodychky/view', 'id' => $met->id])
                    . '<br />';}  ?>
                </div>
                <div class="col-md-3">
                    <?= Html::a('Створити методичку', ['/admin/metodychky/create'], ['class' => 'btn btn-success']) ?>
                </div>
              </div>
            </div>
          </div>
          <div class="panel panel-default">
            <div class="panel-heading">
              <h4 class="panel-title">
                <a class="accordion-toggle" href="#collapseTwo" data-toggle="collapse" data-parent="#accordion">
                  Особисті предмети
                </a>
                <span class="pull-right">Всього: 
                    <span class="badge"><?= count($predmet); ?></span></span>
                   
              </h4>
            </div>
            <div class="panel-collapse collapse" id="collapseTwo">
              <div class="panel-body">
                <?php foreach($predmet as $pr) {               
                        echo Html::a($pr->title, ['/predmet/view', 'id' => $pr->id])
                        . '<br />'; 
                    }  ?>
              </div>
            </div>
          </div>
          <div class="panel panel-default">
            <div class="panel-heading">
              <h4 class="panel-title">
                <a class="accordion-toggle" href="#collapseFour" data-toggle="collapse" data-parent="#accordion">
                  Особисті новини
                </a>
                <span class="pull-right">Всього: 
                    <span class="badge"><?= count($news); ?></span></span>
                   
              </h4>
            </div>
            <div class="panel-collapse collapse" id="collapseFour">
              <div class="panel-body">
                <div class="col-md-9">
                    <?php foreach($news as $item) {               
                            echo Html::a($item->title, ['/teacher-news/view', 'id' => $item->id])
                            . '<br />'; 
                        }  ?>
                </div>
                <div class="col-md-3">
                    <?= Html::a('Створити новину', ['/teacher-news/create'], ['class' => 'btn btn-success']) ?>
                </div>
              </div>
            </div>
          </div>
                    
          <div class="panel panel-default">
            <div class="panel-heading">
              <h4 class="panel-title">
                <a class="accordion-toggle" href="#collapseFive" data-toggle="collapse" data-parent="#accordion">
                  Надіслані повідомлення
                </a>
              </h4>
            </div>
            <div class="panel-collapse collapse" id="collapseFive">
              <div class="panel-body">
                <div class="row"> 
                    <?= Html::a('Переглянути всі надіслані повідомлення', ['/message/ownmessage'], ['class' => 'btn btn-default pull-left']) ?>
                    <?= Html::a('Створити повідомлення', ['/message/create'], ['class' => 'btn btn-success pull-right']) ?>
               </div>
               <br />
                <?= ListView::widget([
                    'dataProvider' => $dataOwnProvider,
                    'itemOptions' => ['class' => 'item'],
                    'itemView' => '_ownItem',                        
                ]) ?>
              </div>
            </div>
          </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="panel panel-primary">
            <div class="panel-heading">
              <h4 class="panel-title">
                
                  <?= Teacher::getPrepod(Yii::$app->user->id)?>
                
              </h4>
            </div>
            
              <div class="panel-body">
                <p><?= $teacher->image ? Html::img('@web/uploads/teacher/'.$teacher->image) : '' ?></p>

                <p><?= 'Посада: '.Html::encode($teacher->job) ?></p>
            
                <p><?= 'Науковий ступінь: '.Html::encode($teacher->science_status) ?></p>
            
                <p><?= 'Організаційна посада: '.Html::encode($teacher->org_status) ?></p>
              </div>
            
          </div>
    </div>
</div>

 