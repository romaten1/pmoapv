<?php
use app\assets\MainPageAsset;
use yii\helpers\Html;
use yii\helpers\Url;
use app\assets\AbiturientAsset;
use app\assets\AppAsset;

/* @var $this \yii\web\View */
/* @var $content string */
AbiturientAsset::register( $this );
AppAsset::register( $this );
MainPageAsset::register($this);

$this->title = 'Абітурієнту';
?>
<?php $this->beginPage() ?>

    <!DOCTYPE html>
    <html lang="en">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <title><?= Html::encode( $this->title ) ?></title>
        <?php $this->head() ?>
    </head>

    <body id="page-top" class="index">
    <?php $this->beginBody() ?>
    <!-- Navigation -->
    <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header page-scroll">
                <button type="button" class="navbar-toggle" data-toggle="collapse"
                        data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Навігація</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand page-scroll" href="<?= Url::to( [ '/' ] ); ?>">Сайт кафедри ПМОАПВ</a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">

                    <li>
                        <a class="page-scroll" href="#page-top">Вітаємо</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="#services">Ми пропонуємо</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="#portfolio">Про нас</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="#about">Ваш вибір</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="#team">Команда</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="#contact">Контакти</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container-fluid -->
    </nav>

    <!-- Header -->
    <header>
        <div class="container">
            <?php if (Yii::$app->session->hasFlash( 'contactFormSubmitted' )): ?>
                <div class="intro-text ">
                    <div class="intro-lead-in">
                        <div class="backs wow fadeInUp">
                            Дякуємо, що зв'язалися з нами! <br/>
                            Ми відповімо Вам як тільки зможемо.
                        </div>
                    </div>
                </div>

            <?php else: ?>
                <div class="intro-text ">
                    <div class="intro-lead-in">
                        <div class="backs wow fadeInUp">
                            Шановні абітурієнти!<br/> <br/>
                            Кафедра ПМОАПВ рада вітати Вас!
                        </div>
                    </div>
                    <div class="intro-heading wow zoomInUp" data-wow-delay="1s">Приєднуйтесь до нас!</div>
                    <a href="#services" class="page-scroll btn btn-xl wow zoomIn" data-wow-delay="2s">Дізнайтесь більше</a>
                    <span class="abo  wow zoomIn" data-wow-delay="3s"> або </span>
                    <a href="#contact" class="page-scroll btn btn-default btn-xl btn-contact wow zoomIn" data-wow-delay="3s">Звертайтесь до нас!</a>
                </div>
            <?php endif; ?>
        </div>
    </header>

    <!-- Services Section -->
    <section id="services">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 class="section-heading wow tada" data-wow-offset="200">Ми пропонуємо</h2>

                    <h3 class="section-subheading text-muted">Навчання за такими спеціальностями</h3>
                </div>
            </div>
            <div class="row text-center">
                <div class="col-md-4 wow bounceIn" data-wow-delay="1s">
                    <span class="fa-stack fa-4x">
                        <i class="fa fa-circle fa-stack-2x text-primary"></i>
                        <i class="fa fa-user fa-stack-1x fa-inverse"></i>
                    </span>
                    <h4 class="service-heading">Бакалавр</h4>

                    <p class="text-muted">Напрям підготовки 6.100202 Процеси, машини та обладнання агропромислового
                        виробництва</p>
                </div>
                <div class="col-md-4 wow bounceIn" data-wow-delay="2s">
                    <span class="fa-stack fa-4x">
                        <i class="fa fa-circle fa-stack-2x text-primary"></i>
                        <i class="fa fa-university fa-stack-1x fa-inverse"></i>
                    </span>
                    <h4 class="service-heading">Спеціаліст</h4>

                    <p class="text-muted">Спеціальність 7.10010201 Процеси, машини та обладнання агропромислових
                        підприємств</p>
                </div>
                <div class="col-md-4 wow bounceIn" data-wow-delay="3s">
                    <span class="fa-stack fa-4x">
                        <i class="fa fa-circle fa-stack-2x text-primary"></i>
                        <i class="fa fa-mortar-board fa-stack-1x fa-inverse"></i>
                    </span>
                    <h4 class="service-heading">Магістр</h4>

                    <p class="text-muted">Спеціальність 8.10010201 Процеси, машини та обладнання агропромислових
                        підприємств</p>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h3 class="section-subheading text-muted  wow bounceIn" data-wow-delay="4s">а також за вказаними спеціальностями</h3>

                    <h3 class="section-heading  wow fadeInUp" data-wow-delay="5s">Заочна форма навчання</h3>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 text-center  wow bounceIn" data-wow-delay="6s">
                    <br/>
                    <h4 class="section-heading">Про умови вступу на нашу спеціальність дізнайтесь більше</h4>
                    <a href="http://www.udau.edu.ua/ua/future-students/vstupna-kampaniya-2015/pravila-prijomu.html"
                       class="btn btn-xl">на сайті університету</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Portfolio Grid Section -->
    <section id="portfolio" class="bg-light-gray">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 class="section-heading">Наші переваги</h2>

                    <h3 class="section-subheading text-muted">Приходьте до нас і самі переконайтеся </h3>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 col-sm-6 portfolio-item wow flipInX" data-wow-delay="0s">
                    <a href="#portfolioModal7" class="portfolio-link" data-toggle="modal">
                        <div class="portfolio-hover">
                            <div class="portfolio-hover-content">
                                <i class="fa fa-plus fa-3x"></i>
                            </div>
                        </div>
                        <img src="abiturient/img/portfolio/konkurs.jpg" class="img-responsive" alt="">
                    </a>

                    <div class="portfolio-caption">
                        <h4>Участь у всеукраїнських конкурсах</h4>

                        <p class="text-muted">Наші студенти беруть участь і перемагають в провідних змаганнях між
                            кращими студентами аграрних вузів</p>
                    </div>
                </div>
                <div class="col-md-4 col-sm-6 portfolio-item wow flipInX" data-wow-delay="0.5s">
                    <a href="#portfolioModal8" class="portfolio-link" data-toggle="modal">
                        <div class="portfolio-hover">
                            <div class="portfolio-hover-content">
                                <i class="fa fa-plus fa-3x"></i>
                            </div>
                        </div>
                        <img src="abiturient/img/portfolio/olimp.jpg" class="img-responsive" alt="">
                    </a>

                    <div class="portfolio-caption">
                        <h4>Участь в олімпіадах</h4>

                        <p class="text-muted">Наші студенти - учасники і переможці всеукраїнських олімпіад зі
                            спеціальностіі</p>
                    </div>
                </div>
                <div class="col-md-4 col-sm-6 portfolio-item wow flipInX" data-wow-delay="1s">
                    <a href="#portfolioModal9" class="portfolio-link" data-toggle="modal">
                        <div class="portfolio-hover">
                            <div class="portfolio-hover-content">
                                <i class="fa fa-plus fa-3x"></i>
                            </div>
                        </div>
                        <img src="abiturient/img/portfolio/exibition.jpg" class="img-responsive" alt="">
                    </a>

                    <div class="portfolio-caption">
                        <h4>Всеукраїнські та міжнародні виставки</h4>

                        <p class="text-muted">Відвідування виставок - можливість ознайомитися з сучасними досягненнми
                            науки і техніки</p>
                    </div>
                </div>
                <div class="col-md-4 col-sm-6 portfolio-item wow flipInX" data-wow-delay="0s">
                    <a href="#portfolioModal1" class="portfolio-link" data-toggle="modal">
                        <div class="portfolio-hover">
                            <div class="portfolio-hover-content">
                                <i class="fa fa-plus fa-3x"></i>
                            </div>
                        </div>
                        <img src="abiturient/img/portfolio/history.jpg" class="img-responsive" alt="">
                    </a>

                    <div class="portfolio-caption">
                        <h4>Багата історія</h4>

                        <p class="text-muted">Кафедра заснована 1929 року</p>
                    </div>
                </div>
                <div class="col-md-4 col-sm-6 portfolio-item wow flipInX" data-wow-delay="0.5s">
                    <a href="#portfolioModal2" class="portfolio-link" data-toggle="modal">
                        <div class="portfolio-hover">
                            <div class="portfolio-hover-content">
                                <i class="fa fa-plus fa-3x"></i>
                            </div>
                        </div>
                        <img src="abiturient/img/portfolio/teachers.jpg" class="img-responsive" alt="">
                    </a>

                    <div class="portfolio-caption">
                        <h4>Викладачі</h4>

                        <p class="text-muted">Заняття ведуть висококваліфіковані викладачі</p>
                    </div>
                </div>
                <div class="col-md-4 col-sm-6 portfolio-item wow flipInX" data-wow-delay="1s">
                    <a href="#portfolioModal3" class="portfolio-link" data-toggle="modal">
                        <div class="portfolio-hover">
                            <div class="portfolio-hover-content">
                                <i class="fa fa-plus fa-3x"></i>
                            </div>
                        </div>
                        <img src="abiturient/img/portfolio/praktika.jpg" class="img-responsive" alt="">
                    </a>

                    <div class="portfolio-caption">
                        <h4>Практична підготовка</h4>

                        <p class="text-muted">Співпрацюємо з десятками передових підприємств галузі по всій Україні</p>
                    </div>
                </div>
                <div class="col-md-4 col-sm-6 portfolio-item wow flipInX" data-wow-delay="0s">
                    <a href="#portfolioModal4" class="portfolio-link" data-toggle="modal">
                        <div class="portfolio-hover">
                            <div class="portfolio-hover-content">
                                <i class="fa fa-plus fa-3x"></i>
                            </div>
                        </div>
                        <img src="abiturient/img/portfolio/science.jpg" class="img-responsive" alt="">
                    </a>

                    <div class="portfolio-caption">
                        <h4>Наукова робота</h4>

                        <p class="text-muted">Ваше бажання відкриттів буде підтримано і втілено</p>
                    </div>
                </div>
                <div class="col-md-4 col-sm-6 portfolio-item wow flipInX" data-wow-delay="0.5s">
                    <a href="#portfolioModal5" class="portfolio-link" data-toggle="modal">
                        <div class="portfolio-hover">
                            <div class="portfolio-hover-content">
                                <i class="fa fa-plus fa-3x"></i>
                            </div>
                        </div>
                        <img src="abiturient/img/portfolio/matteh.jpg" class="img-responsive" alt="">
                    </a>

                    <div class="portfolio-caption">
                        <h4>Матеріально-технічна база</h4>

                        <p class="text-muted">Машинно-тракторний і автомобільний парк кафедри систематично
                            поповнюється</p>
                    </div>
                </div>
                <div class="col-md-4 col-sm-6 portfolio-item wow flipInX" data-wow-delay="1s">
                    <a href="#portfolioModal6" class="portfolio-link" data-toggle="modal">
                        <div class="portfolio-hover">
                            <div class="portfolio-hover-content">
                                <i class="fa fa-plus fa-3x"></i>
                            </div>
                        </div>
                        <img src="abiturient/img/portfolio/org.jpg" class="img-responsive" alt="">
                    </a>

                    <div class="portfolio-caption">
                        <h4>Дозвілля студентів</h4>

                        <p class="text-muted">Ви зможете розкрити свій творчий потенціал</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section id="about">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 class="section-heading">Ваш шлях</h2>

                    <h3 class="section-subheading text-muted">... лежить через нашу кафедру</h3>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <ul class="timeline">
                        <li>
                            <div class="timeline-image">
                                <img class="img-circle img-responsive wow pulse" src="abiturient/img/about/1.jpg" alt="" data-wow-iteration="5">
                            </div>
                            <div class="timeline-panel">
                                <div class="timeline-heading">
                                    <h4>...</h4>
                                    <h4 class="subheading">Ви навчаєтесь</h4>
                                </div>
                                <div class="timeline-body">
                                    <p class="text-muted">в школі, вузі, коледжі і мрієте про якісну вищу освіту і
                                        отримання в майбутньому улюбленої роботи з високою оплатою. Мріяти корисно але
                                        недостатньо. Тому ви шукаєте куди б це поступити</p>
                                </div>
                            </div>
                        </li>
                        <li class="timeline-inverted">
                            <div class="timeline-image">
                                <img class="img-circle img-responsive wow pulse" src="abiturient/img/about/2.jpg" alt="" data-wow-iteration="5">
                            </div>
                            <div class="timeline-panel">
                                <div class="timeline-heading">
                                    <h4>Червень 2015</h4>
                                    <h4 class="subheading">Ви подаєте документи</h4>
                                </div>
                                <div class="timeline-body">
                                    <p class="text-muted">в Уманський національний університет садівництва на напрям
                                        підготовки 6.100202 Процеси, машини та обладнання агропромислового виробництва і
                                        успішно поступаєте на державне місце</p>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="timeline-image">
                                <img class="img-circle img-responsive wow pulse" src="abiturient/img/about/3.jpg" alt="" data-wow-iteration="5">
                            </div>
                            <div class="timeline-panel">
                                <div class="timeline-heading">
                                    <h4>2015 - 2019</h4>
                                    <h4 class="subheading">Ви вчитеся</h4>
                                </div>
                                <div class="timeline-body">
                                    <p class="text-muted">успішно здаючи всі заліки, екзамени, курсові проекти на
                                        відмінно, отримуєте іменну стипендію, і, звісно, не забуваючи відпочивати :)</p>
                                </div>
                            </div>
                        </li>
                        <li class="timeline-inverted">
                            <div class="timeline-image">
                                <img class="img-circle img-responsive wow pulse" src="abiturient/img/about/4.jpg" alt="" data-wow-iteration="5">
                            </div>
                            <div class="timeline-panel">
                                <div class="timeline-heading">
                                    <h4>Червень 2019</h4>
                                    <h4 class="subheading">Ви захищаєте дипломний проект</h4>
                                </div>
                                <div class="timeline-body">
                                    <p class="text-muted">бакалавра на дуже важливу тему із впровадженням у виробництво
                                        на відмінно. Вся екзаменаційна комісія аплодує Вам після захисту захоплюючись
                                        Вашими знаннями та напрацюваннями</p>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="timeline-image">
                                <img class="img-circle img-responsive wow pulse" src="abiturient/img/about/5.jpg" alt="" data-wow-iteration="5">
                            </div>
                            <div class="timeline-panel">
                                <div class="timeline-heading">
                                    <h4>2019 - 2020</h4>
                                    <h4 class="subheading">Магістратура</h4>
                                </div>
                                <div class="timeline-body">
                                    <p class="text-muted">Розуміючи потребу подальшого власного розвитку і прагнучи
                                        більшого, Ви поступаєте в магістратуру на спеціальність 8.10010201 Процеси,
                                        машини та обладнання агропромислових підприємств, обираєте собі важливий
                                        напрямок наукової роботи і успішно захищаєте магстерську роботу.</p>
                                </div>
                            </div>
                        </li>
                        <li class="timeline-inverted">
                            <div class="timeline-image">
                                <img class="img-circle img-responsive wow pulse" src="abiturient/img/about/6.jpg" alt="" data-wow-iteration="5">
                            </div>
                            <div class="timeline-panel">
                                <div class="timeline-heading">
                                    <h4>2020</h4>
                                    <h4 class="subheading">І нарешті - омріяна робота!</h4>
                                </div>
                                <div class="timeline-body">
                                    <p class="text-muted">Отримавши диплом ви проходите співбесіду в престижній
                                        агропромисловій фірмі, проявляєте високі знання, набуті під час навчання та
                                        проходження практики в університеті і отримуєте омріяну посаду з високою оплатою
                                        праці та значними можливостями кар'єрного зросту</p>
                                </div>
                            </div>
                        </li>
                        <li class="timeline-inverted">
                            <div class="timeline-image">
                                <h4>Оберіть
                                    <br>вірний
                                    <br>шлях!</h4>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- Team Section -->
    <section id="team" class="bg-light-gray">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 class="section-heading">Наші викладачі</h2>

                    <h3 class="section-subheading text-muted">Якість навчання залежить від викладачів. Наші -
                        кращі!</h3>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-4">
                    <div class="team-member">
                        <img src="abiturient/img//team/1.jpg" class="img-responsive img-circle" alt="">
                        <h4>Андрій Войтік</h4>

                        <p class="text-muted">Завідувач кафедри, к.т.н.</p>
                        <ul class="list-inline social-buttons">
                            <li><a href="#"><i class="fa fa-twitter"></i></a>
                            </li>
                            <li><a href="#"><i class="fa fa-facebook"></i></a>
                            </li>
                            <li><a href="#"><i class="fa fa-vk"></i></a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="team-member">
                        <img src="abiturient/img//team/2.jpg" class="img-responsive img-circle" alt="">
                        <h4>Олександр Пушка</h4>

                        <p class="text-muted">Декан факультету, к.т.н., доцент</p>
                        <ul class="list-inline social-buttons">
                            <li><a href="#"><i class="fa fa-twitter"></i></a>
                            </li>
                            <li><a href="#"><i class="fa fa-facebook"></i></a>
                            </li>
                            <li><a href="#"><i class="fa fa-vk"></i></a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="team-member">
                        <img src="abiturient/img//team/3.jpg" class="img-responsive img-circle" alt="">
                        <h4>Юрій Ковальчук</h4>

                        <p class="text-muted">К.т.н., доцент</p>
                        <ul class="list-inline social-buttons">
                            <li><a href="#"><i class="fa fa-twitter"></i></a>
                            </li>
                            <li><a href="#"><i class="fa fa-facebook"></i></a>
                            </li>
                            <li><a href="#"><i class="fa fa-vk"></i></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2 text-center">
                    <p class="large text-muted">
                        <a class="btn btn-primary" href= <?= Url::to( [ '/teacher' ] ); ?>>
                            Всі викладачі ...
                        </a>
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Clients Aside -->
    <aside class="clients">
        <div class="container">
            <div class="row ">
                <div class="col-md-3 col-sm-6 ">
                </div>
                <div class="col-md-3 col-sm-6 ">
                    <a href="http://www.udau.edu.ua/">
                        <img src="abiturient/img/logos/unus_small.png" class="img-responsive img-centered" alt="">
                    </a>
                </div>
                <div class="col-md-3 col-sm-6">
                    <a href="http://minagro.gov.ua/">
                        <img src="abiturient/img/logos/apk.png" class="img-responsive img-centered" alt="">
                    </a>
                </div>
                <div class="col-md-3 col-sm-6 ">
                </div>
            </div>
        </div>
    </aside>

    <section id="contact">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 class="section-heading">Звертайтеся до нас!</h2>

                    <h3 class="section-subheading text-muted">Якщо Вас щось цікавить - заповніть форму і ми відповімо
                        Вам найближим часом</h3>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <?= $content; ?>
                </div>
            </div>
        </div>
    </section>

    <footer>
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <span class="copyright">Кафедра ПМОАПВ 2015</span>
                </div>
                <div class="col-md-4">
                    <ul class="list-inline social-buttons">
                        <li><a href="#"><i class="fa fa-twitter"></i></a>
                        </li>
                        <li><a href="#"><i class="fa fa-facebook"></i></a>
                        </li>
                        <li><a href="#"><i class="fa fa-vk"></i></a>
                        </li>
                    </ul>
                </div>

            </div>
        </div>
    </footer>

    <!-- Portfolio Modals -->
    <!-- Use the modals below to showcase details about your portfolio projects! -->

    <!-- Portfolio Modal 1 -->
    <div class="portfolio-modal modal fade" id="portfolioModal1" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-content">
            <div class="close-modal" data-dismiss="modal">
                <div class="lr">
                    <div class="rl">
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-lg-offset-2">
                        <div class="modal-body">
                            <!-- Project Details Go Here -->
                            <h2>Без минулого немає майбутнього</h2>

                            <p class="item-intro text-muted">Кафедра заснована в 1929 році</p>
                            <img class="img-responsive" src="abiturient/img/portfolio/history-preview.jpg" alt="">

                            <p>Кафедра створена в 1929 році,
                                коли Уманський агрополітехнікум був
                                реорганізований в Уманський сільськогосподарський інститут.
                                Першим завідувачем кафедри був професор В.Ф. Чалий.
                                Матеріальна база кафедри в перші роки складалася з машин і знарядь на кінній тязі.
                                У 1935-1941 роках кафедра поповнилася тракторами, машинами на тракторній тязі,
                                молотарками та ін.</p>
                            <button type="button" class="btn btn-primary" data-dismiss="modal"><i
                                    class="fa fa-share"></i> Закрити
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Portfolio Modal 2 -->
    <div class="portfolio-modal modal fade" id="portfolioModal2" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-content">
            <div class="close-modal" data-dismiss="modal">
                <div class="lr">
                    <div class="rl">
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-lg-offset-2">
                        <div class="modal-body">
                            <h2>Викладацький склад</h2>

                            <p class="item-intro text-muted">Навчитися може кожен, вчити - одиниці.</p>
                            <img class="img-responsive img-centered" src="abiturient/img/portfolio/teachers-preview.jpg"
                                 alt="">

                            <p>
                                Серед викладачів кафедри більшість кандидати та доктори технічних та інших наук.
                                Викладачі проходять підвищення кваліфікації за дисциплінами, які викладаються.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Portfolio Modal 3 -->
    <div class="portfolio-modal modal fade" id="portfolioModal3" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-content">
            <div class="close-modal" data-dismiss="modal">
                <div class="lr">
                    <div class="rl">
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-lg-offset-2">
                        <div class="modal-body">
                            <!-- Project Details Go Here -->
                            <h2>Кращі виробники галузі до ваших послуг</h2>

                            <p class="item-intro text-muted">Ми працюємо над залученням провідних сільськогосподарських
                                виробників України до проведення практичної підготовки наших студентів</p>
                            <img class="img-responsive img-centered" src="abiturient/img/portfolio/praktika-preview.jpg"
                                 alt="">

                            <p>Кафедра плідно співпрацює з багатьма сільськогосподарськими та промисловими
                                підприємствами
                                м. Умань, Черкаської, Київської, Вінницької, Кіровоградської та інших областей у
                                напрямку
                                проходження студентами всіх видів практики та підготовки курсових і дипломних проектів,
                                стажування викладачів і наукових співробітників кафедри,
                                проведення дослідів та впровадження у виробництво ефективних наукових розробок.</p>
                            <button type="button" class="btn btn-primary" data-dismiss="modal"><i
                                    class="fa fa-share"></i> Закрити
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Portfolio Modal 4 -->
    <div class="portfolio-modal modal fade" id="portfolioModal4" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-content">
            <div class="close-modal" data-dismiss="modal">
                <div class="lr">
                    <div class="rl">
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-lg-offset-2">
                        <div class="modal-body">
                            <!-- Project Details Go Here -->
                            <h2>Наукова робота</h2>

                            <p class="item-intro text-muted">Якщо ви володієте знанням, дайте іншим запалити від нього
                                свої світильники.</p>
                            <img class="img-responsive img-centered" src="abiturient/img/portfolio/science-preview.jpg"
                                 alt="">

                            <p>Кафедра працює за комплексною науковою темою дослідження
                                механізованих процесів агропромислового виробництва і має наукові
                                розробки з питань підвищення рівня механізації в плодових розсадниках
                                та ягідниках, паливної економічності та екологічності дизелів, розробки
                                гнучкої малогабаритної кормоприготувальної техніки та ін.</p>

                            <p>При кафедрі працює аспірантура, функціонує студентський
                                науковий гурток, в якому студенти займаються науковою роботою.
                                Результати науково-дослідної роботи студенти використовують при
                                підготовці доповідей на студентських наукових конференціях,
                                наукових тез і статей, виконанні курсових і дипломних проектів. </p>
                            <button type="button" class="btn btn-primary" data-dismiss="modal"><i
                                    class="fa fa-share"></i> Закрити
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Portfolio Modal 5 -->
    <div class="portfolio-modal modal fade" id="portfolioModal5" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-content">
            <div class="close-modal" data-dismiss="modal">
                <div class="lr">
                    <div class="rl">
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-lg-offset-2">
                        <div class="modal-body">
                            <!-- Project Details Go Here -->
                            <h2>Матеріально-технічне забезпечення</h2>

                            <p class="item-intro text-muted">Інженер повинен вміти все</p>
                            <img class="img-responsive img-centered" src="abiturient/img/portfolio/matteh-preview.jpg"
                                 alt="">

                            <p>Для якісного навчання на кафедрі створена значна матеріально технічна база, що є
                                запорукою успішного засвоєння студентами вивченого матеріалу.
                                Кафедра має 17 навчальних аудиторій, із них три лекційні аудиторії обладнані
                                мультимедійними засобами. У двох окремих навчальних корпусах кафедри розміщено
                                комп’ютерний клас, спеціалізовані навчальні та науково-навчальні лабораторії. Кафедра
                                має також навчальну майстерню, навчальний полігон, ангар та відкриту площадку для
                                зберігання сільськогосподарської техніки.
                                За кафедрою закріплені 7 легкових автомобілів;
                                2 гусеничних і 6 колісних тракторів; зернозбиральний комбайн;
                                ґрунтообробна, посівна, збиральна, фермська та інша
                                сільськогосподарська техніка понад 40 найменувань.</p>
                            <button type="button" class="btn btn-primary" data-dismiss="modal"><i
                                    class="fa fa-share"></i> Закрити
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Portfolio Modal 6 -->
    <div class="portfolio-modal modal fade" id="portfolioModal6" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-content">
            <div class="close-modal" data-dismiss="modal">
                <div class="lr">
                    <div class="rl">
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-lg-offset-2">
                        <div class="modal-body">
                            <!-- Project Details Go Here -->
                            <h2>Плекаючи таланти</h2>

                            <p class="item-intro text-muted">Кожен студент може продовжувати займатися своєю улюбленою
                                справою і в університеті</p>
                            <img class="img-responsive img-centered" src="abiturient/img/portfolio/org-preview.jpg"
                                 alt="">

                            <p>Різноманітні колективи, гуртки, ансамблі, в яких беруть участь наші студенти дають змогу
                                з користю провести вільний час.</p>
                            <button type="button" class="btn btn-primary" data-dismiss="modal"><i
                                    class="fa fa-share"></i> Закрити
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Portfolio Modal 7 -->
    <div class="portfolio-modal modal fade" id="portfolioModal7" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-content">
            <div class="close-modal" data-dismiss="modal">
                <div class="lr">
                    <div class="rl">
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-lg-offset-2">
                        <div class="modal-body">
                            <!-- Project Details Go Here -->
                            <h2>Участь у всеукраїнських конкурсах</h2>

                            <p class="item-intro text-muted">Нашим природним середовищем стало вже змагання, змістом
                                нашого життя — боротьба.</p>
                            <img class="img-responsive img-centered" src="abiturient/img/portfolio/konkurs-preview.jpg"
                                 alt="">

                            <p>8 жовтня 2013 р. відбувся Всеукраїнський конкурс
                                «Кращий студент напряму «Процеси, машини та обладнання АПВ».
                                Організаторами заходу виступили: Департамент науково-освітнього
                                забезпечення АПВ та розвитку сільських територій Міністерства аграрної
                                політики та продовольства України, компанія «Мрія Агрохолдинг»,
                                ДУ «НМЦ «Агроосвіта».
                                Участь у конкурсі взяли студенти 5 курсу інженерно-технологічного факультету
                                Уманського національного університету садівництва Панчук Дмитро і Легкун Сергій
                                та зайняли почесне 4 командне місце в рейтингу
                                серед студентів 17 аграрних вищих навчальних закладів України.</p>
                            <button type="button" class="btn btn-primary" data-dismiss="modal"><i
                                    class="fa fa-share"></i> Закрити
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Portfolio Modal 8 -->
    <div class="portfolio-modal modal fade" id="portfolioModal8" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-content">
            <div class="close-modal" data-dismiss="modal">
                <div class="lr">
                    <div class="rl">
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-lg-offset-2">
                        <div class="modal-body">
                            <!-- Project Details Go Here -->
                            <h2>Бути кращим</h2>

                            <p class="item-intro text-muted">Участь у всеукраїнських олімпіадах дає змогу на когось
                                подивитись і себе показати. З кращого боку.</p>
                            <img class="img-responsive img-centered" src="abiturient/img/portfolio/olimp-preview.jpg"
                                 alt="">

                            <p>10–12 квітня 2013 року на базі Кіровоградського національного технічного університету
                                відбувся II етап Всеукраїнської студентської олімпіади зі спеціальності «Процеси, машини
                                та обладнання агропромислових підприємств».
                                В олімпіаді брали участь більше 50 студентів з 11 вищих навчальних закладів України.
                                Студент Уманського національного університету
                                садівництва Демиденко Віктор показав вагомі теоретичні
                                та практичні знання, які допомогли йому стати переможцем
                                олімпіади і отримати диплом ІІ ступеня. </p>
                            <button type="button" class="btn btn-primary" data-dismiss="modal"><i
                                    class="fa fa-share"></i> Закрити
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Portfolio Modal 9 -->
    <div class="portfolio-modal modal fade" id="portfolioModal9" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-content">
            <div class="close-modal" data-dismiss="modal">
                <div class="lr">
                    <div class="rl">
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-lg-offset-2">
                        <div class="modal-body">
                            <!-- Project Details Go Here -->
                            <h2>Виставкова діяльність</h2>

                            <p class="item-intro text-muted">Краще один раз побачити, чим десять раз почути</p>
                            <img class="img-responsive img-centered"
                                 src="abiturient/img/portfolio/exibition-preview.jpg" alt="">

                            <p>Наші студенти та викладачі щорічно багато разів відвідують всеукраїнські та міжнародні
                                виставки в різних містах України</p>
                            <button type="button" class="btn btn-primary" data-dismiss="modal"><i
                                    class="fa fa-share"></i> Закрити
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php $this->endBody() ?>
    </body>

    </html>
<?php $this->endPage() ?>