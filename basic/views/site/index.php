<?php
/* @var $this yii\web\View */
use yii\helpers\Url;
use claudejanz\jquerySlider\widgets\SliderWidget;
use yii\web\JsExpression;

$this->title = 'Кафедра ПМОАПВ УНУС';
?>
<div class="site-index">

    <div class="jumbotron">
        <img src="<?= Url::to('@web/uploads/logo.jpg', true) ?>">'
        <h1>ВІТАЄМО!</h1>

        <p class="lead">Раді бачити вас на сайті <br />
        <strong>кафедри процесів, машин та обладнання АПВ </strong><br />
        Уманського національного університету садівництва.</p>

        <!-- <p><a class="btn btn-lg btn-success" href="http://www.yiiframework.com">Get started with Yii</a></p> -->
    </div>
    
    <?= philippfrenzel\yii2sly\yii2sly::widget([
        'id' => 'sp_slider',
        'items'=> [
            ['content' => '<img src="' . Url::to('@web/uploads/images/001.jpeg') . '"></img>'],
            ['content' => '<img src="' . Url::to('@web/uploads/images/002.jpeg') . '"></img>'],
            ['content' => '<img src="' . Url::to('@web/uploads/images/003.jpeg') . '"></img>'],
            ['content' => '<img src="' . Url::to('@web/uploads/images/004.jpeg') . '"></img>'],
            ['content' => '<img src="' . Url::to('@web/uploads/images/005.jpeg') . '"></img>'],
            ['content' => '<img src="' . Url::to('@web/uploads/images/006.jpeg') . '"></img>'],
            ['content' => '<img src="' . Url::to('@web/uploads/images/007.jpeg') . '"></img>']
        ],
        'options' => [
            'style' => "height:200px;",

        ],
        'clientOptions' => [
            'horizontal' => 1,
            'activateMiddle' => 1,
            'itemNav' => 'centered',
            'activateOn' =>   'click'
                       
        ]
    ]); ?>
    
    <?php 
       /* SliderWidget::begin([
            'responsive' => true,
            'options'=>['style'=>'position: relative; top: 0px; left: 0px; width: 600px; height: 300px;'],
            'pluginOptions' => [
                '$AutoPlay' => true,
                '$AutoPlayInterval' => 6000,
                '$SlideDuration' => 800,
                '$SlideshowOptions' => [
                    '$Class' => new JsExpression('$JssorSlideshowRunner$'),
                    '$Transitions' => [
                        ['$Duration' => 700, '$Opacity' => 2, '$Brother' => ['$Duration' => 1000, '$Opacity' => 2]]
                    ]
                ]
            ]
        ]);
        echo '<div u="slides" style="cursor: move; position: absolute; overflow: hidden; left: 0px; top: 0px; width: 1600px; height: 1066px;">
                            <div><img u="image" src="' . Url::to('@web/img/jssor/01.jpg') . '"></img>
                            <div><img u="image" src="' . Url::to('@web/img/jssor/02.jpg') . '"></img>
                            <div><img u="image" src="' . Url::to('@web/img/jssor/03.jpg') . '"></img>
                            <div><img u="image" src="' . Url::to('@web/img/jssor/04.jpg') . '"></img>
                            <div><img u="image" src="' . Url::to('@web/img/jssor/05.jpg') . '"></img>
                            <div><img u="image" src="' . Url::to('@web/img/jssor/06.jpg') . '"></img>
                            <div><img u="image" src="' . Url::to('@web/img/jssor/07.jpg') . '"></img>
                            <div><img u="image" src="' . Url::to('@web/img/jssor/08.jpg') . '"></img>
                        </div>';
        SliderWidget::end();*/

     ?>

    <div class="body-content">

        <div class="row">
            <div class="col-lg-4">
                <h2>Історія кафедри</h2>

                <p>Кафедра створена в 1929 році, коли Уманський агрополітехнікум був реорганізований в Уманський 
                сільськогосподарський інститут. Першим завідувачем кафедри був професор В.Ф. Чалий. 
                    Матеріальна база кафедри в перші роки складалася з машин і знарядь на кінній тязі. У 1935-1941 
                    роках кафедра поповнилася тракторами, машинами на тракторній тязі, молотарками та ін. 
                    Значний вклад у розвиток кафедри також зробили завідувачі Моторний К.П. (1944-1949 рр.), 
                    В.Г. Красько (1956-1960 рр.), К.С. Хвиля (1960-1973 рр.), Сінгур М.К.(1973-1983 рр.),
                    В.І. Марченко (1983-2009 рр.), Березовський А.П. (2009-2010 рр.), Войтік А.В. (2010-2012 рр.), 
                    Вольвак С.Ф. (2012-2014 рр.).              
                  </p>

                <p><a class="btn btn-default" href= <?= Url::to(['/static-page/view-alias', 'alias' => 'history']); ?> >Далі ... &raquo;</a></p>
            </div>
            <div class="col-lg-4">
                <h2>Наукова робота</h2>

                <p>Кафедра працює за комплексною науковою темою дослідження механізованих процесів агропромислового 
                виробництва і має наукові розробки з питань підвищення рівня механізації в плодових розсадниках 
                та ягідниках, паливної економічності та екологічності дизелів та ін. При кафедрі працює аспірантура, функціонує 
                студентський науковий гурток, в якому студенти займаються науковою роботою.              </p>

                <p><a class="btn btn-default" href= <?= Url::to(['/static-page/view-alias', 'alias' => 'napryamy-nauki']); ?> >Далі ... &raquo;</a></p>
            </div>                               
            <div class="col-lg-4">
                <h2>Практична підготовка студентів</h2>

                <p>Машинно-тракторний і автомобільний парк кафедри систематично поповнюється новими сільськогосподарськими 
                машинами, обладнанням і автомобілями, що дозволяє проводити навчання студентів на базі сучасної 
                сільськогосподарської та автомобільної техніки.
                Студенти проходять навчальну практику на кафедральному полігоні і виробничу в 
                умовах навчально-дослідного господарства та інших господарств регіону</p>

                <p><a class="btn btn-default" href= <?= Url::to(['/static-page/view-alias', 'alias' => 'praktika']); ?> >Далі ... &raquo;</a></p>
            </div>
        </div>

    </div>
</div>
