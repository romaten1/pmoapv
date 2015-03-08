<?php
/* @var $this yii\web\View */
use yii\helpers\Url;
use app\components\widgets\allteachers\AllteacherWidget;
use app\components\widgets\allnews\AllnewsWidget;

$this->title = 'Кафедра ПМОАПВ УНУС';
?>
<div class="site-index">

    <div class="jumbotron">
        <img src="<?= Url::to( '@web/uploads/logo.png', true ) ?>">

        <h1>ВІТАЄМО!</h1>

        <p class="lead">Раді бачити вас на сайті <br/>
            <strong>КАФЕДРИ ПРОЦЕСІВ, МАШИН ТА ОБЛАДНАННЯ АПВ </strong><br/>
            інженерно-технологічного факультету <br/>
            Уманського національного університету садівництва</p><br/>

        <p><a class="btn btn-success" href="<?= Url::to( [ '/site/abiturient' ] ); ?>">Ви абітурієнт?</a></p><br/>

    </div>
</div>

</div>
</div>

<div class="container_upper">
    <div class="container">
        <div class="row">
            <div class="col-md-4 text-center">
                <img class="img-circle" src="<?= Url::to( '@web/img/index/13.jpg' ); ?>">

                <h2>Методична робота</h2>

                <p>Викладачі кафедри беруть активну участь у виданні підручників, посібників,
                    методичних вказівок і наукових праць. Навчальний процес забезпечений кафедральними
                    науково-методичними розробками.
                    Видані підручники і навчальні посібники: «Сільськогосподарські машини», «Ґрунтообробні машини»,
                    «Машини сільськогосподарські», «Комбайни зернозбиральні», «Системи технологій у рослинництві»,
                    «Мобільні енергетичні засоби», «Машиновикористання в землеробстві», «Машиновикористання та екологія
                    довкілля»,
                    «Будова і технічне обслуговування тракторів і автомобілів», «Деталі машин. Курсове проектування» та
                    ін.</p>

                <p><a class="btn btn-default"
                      href="<?= Url::to( [ '/static-page/view-alias', 'alias' => 'metod_work' ] ); ?>">Далі
                        ... &raquo;</a></p>
            </div>
            <div class="col-md-4 text-center">
                <img class="img-circle" src="<?= Url::to( '@web/img/index/08.jpg' ); ?>">

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

                <p><a class="btn btn-default"
                      href="<?= Url::to( [ '/static-page/view-alias', 'alias' => 'history' ] ); ?>">Далі ... &raquo;</a>
                </p>
            </div>
            <div class="col-md-4 text-center">
                <img class="img-circle" src="<?= Url::to( '@web/img/index/03.jpg' ); ?>">

                <h2>Наукова робота</h2>

                <p>Кафедра працює за комплексною науковою темою дослідження механізованих процесів агропромислового
                    виробництва і має наукові розробки з питань підвищення рівня механізації в плодових розсадниках
                    та ягідниках, паливної економічності та екологічності дизелів та ін. При кафедрі працює аспірантура,
                    функціонує
                    студентський науковий гурток, в якому студенти займаються науковою роботою. </p>

                <p><a class="btn btn-default"
                      href="<?= Url::to( [ '/static-page/view-alias', 'alias' => 'napryamy-nauki' ] ); ?>">Далі
                        ... &raquo;</a></p>
            </div>
            <!-- /.row -->
        </div>
    </div>
</div>

<div class="container3">
    <div class="container">
        <!-- START THE FEATURETTES -->
        <div class="featurette">
            <img class="featurette-image img-circle pull-right" src="<?= Url::to( '@web/img/index/06.jpg' ); ?>">

            <h2 class="featurette-heading">Абітурієнтам: <span
                    class="text-muted">наша кафедра – Ваш правильний вибір!</span></h2>

            <p class="lead">Кафедра здійснює підготовку фахівців інженерної служби
                з механізації сільськогосподарського виробництва освітньо-кваліфікаційних рівнів
                «бакалавр», «спеціаліст» і «магістр» за спеціальністю «Процеси, машини та обладнання агропромислових
                підприємств»</p>

            <p><a class="btn btn-default"
                  href="<?= Url::to( [ '/static-page/view-alias', 'alias' => 'zvernennya' ] ); ?>">Далі ... &raquo;</a>
            </p>
        </div>
        <!-- /END THE FEATURETTES -->
    </div>
</div>

<div class="container2">
    <div class="container">
        <!-- START THE FEATURETTES -->
        <div class="featurette">
            <img class="featurette-image img-circle pull-left" src="<?= Url::to( '@web/img/index/05.jpg' ); ?>">

            <h2 class="featurette-heading">Студентам: <span
                    class="text-muted">Все що потрібнно для якісної освіти </span></h2>

            <p class="lead"> На кафедрі викладається понад 30 навчальних дисциплін, а також здійснюється підготовка
                водіїв категорії «В».
                У навчальному процесі використовуються лекційні аудиторії, комп’ютеризовані класи, спеціалізовані
                лабораторії,
                а також сільськогосподарські машини та обладнання, призначені для виконання різних механізованих
                технологічних операцій у
                виробництві сільськогосподарської продукції. </p>
        </div>

        <!-- /END THE FEATURETTES -->
    </div>
</div>

<div class="container3">
    <?php echo AllnewsWidget::widget(); ?>
</div>

<!--<div class="container2">
        <?php echo AllteacherWidget::widget(); ?>        
</div>--> 




