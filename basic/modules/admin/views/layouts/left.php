<?php
use yii\bootstrap\Nav;
use yii\helpers\Url;

?>
<aside class="left-side sidebar-offcanvas">

    <section class="sidebar">

        <!-- You can delete next ul.sidebar-menu. It's just demo. -->

        <ul class="sidebar-menu">
            <li>
                <a href="#" class="navbar-link">
                    <i class="fa fa-angle-down"></i> <span class="text-info">Меню адміністратора</span>
                </a>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-envelope"></i>
                    <span>Повідомлення</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="<?= Url::toRoute('/admin/contacts')?>"><i class="fa fa-angle-double-right"></i>Гостей</a></li>
                    <li><a href="<?= Url::toRoute('/admin/message')?>"><i class="fa fa-angle-double-right"></i>Користувачів</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-calendar"></i>
                    <span>Кафедральні новини</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="<?= Url::toRoute('/admin/news')?>"><i class="fa fa-angle-double-right"></i>Перелік</a></li>
                    <li><a href="<?= Url::toRoute('/admin/news/create')?>"><i class="fa fa-angle-double-right"></i>Створити новину</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-table"></i>
                    <span>Повідомлення викладачів</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="<?= Url::toRoute('/admin/teacher-news')?>"><i class="fa fa-angle-double-right"></i>Перелік</a></li>
                    <li><a href="<?= Url::toRoute('/admin/teacher-news/create')?>"><i class="fa fa-angle-double-right"></i>Створити повідомлення викладачів</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-th"></i>
                    <span>Статичні сторінки</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="<?= Url::toRoute('/admin/static-page')?>"><i class="fa fa-angle-double-right"></i>Перелік</a></li>
                    <li><a href="<?= Url::toRoute('/admin/static-page/create')?>"><i class="fa fa-angle-double-right"></i>Створити</a></li>
                    <li><a href="<?= Url::toRoute('/admin/parent-group')?>"><i class="fa fa-angle-double-right"></i>Категорії</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-user"></i>
                    <span>Викладачі</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="<?= Url::toRoute('/admin/teacher')?>"><i class="fa fa-angle-double-right"></i>Перелік</a></li>
                    <li><a href="<?= Url::toRoute('/admin/teacher/create')?>"><i class="fa fa-angle-double-right"></i>Створити</a></li>
                    <li><a href="<?= Url::toRoute('/admin/teach-predmet')?>"><i class="fa fa-angle-double-right"></i>Викладач-предмет</a></li>
                    <li><a href="<?= Url::toRoute('/admin/teach-metodychky')?>"><i class="fa fa-angle-double-right"></i>Викладач-методичка</a></li>
                    <li><a href="<?= Url::toRoute('/admin/predmet-metodychky')?>"><i class="fa fa-angle-double-right"></i>Предмет-методичка</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-user"></i>
                    <span>Студенти</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="<?= Url::toRoute('/admin/student')?>"><i class="fa fa-angle-double-right"></i>Перелік</a></li>
                    <li><a href="<?= Url::toRoute('/admin/student/create')?>"><i class="fa fa-angle-double-right"></i>Створити</a></li>
                    <li><a href="<?= Url::toRoute('/admin/student-group')?>"><i class="fa fa-angle-double-right"></i>Студентські групи</a></li>
                    <li><a href="<?= Url::toRoute('/admin/best-student')?>"><i class="fa fa-angle-double-right"></i>Кращі студенти</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-book"></i>
                    <span>Дипломи та грамоти</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="<?= Url::toRoute('/admin/diploma')?>"><i class="fa fa-angle-double-right"></i>Перелік</a></li>
                    <li><a href="<?= Url::toRoute('/admin/diploma/create')?>"><i class="fa fa-angle-double-right"></i>Створити</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-book"></i>
                    <span>Предмети</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="<?= Url::toRoute('/admin/predmet')?>"><i class="fa fa-angle-double-right"></i>Перелік</a></li>
                    <li><a href="<?= Url::toRoute('/admin/predmet/create')?>"><i class="fa fa-angle-double-right"></i>Створити</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-book"></i>
                    <span>Методички</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="<?= Url::toRoute('/admin/metodychky')?>"><i class="fa fa-angle-double-right"></i>Перелік</a></li>
                    <li><a href="<?= Url::toRoute('/admin/metodychky/create')?>"><i class="fa fa-angle-double-right"></i>Створити</a></li>
                </ul>
            </li>
            <li>
                <a href="<?= Url::toRoute('/user/admin/index')?>">
                    <i class="fa fa-calendar"></i> <span>Користувачі</span>
                </a>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-book"></i>
                    <span>Наукові заходи</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="<?= Url::toRoute('/admin/conference')?>"><i class="fa fa-angle-double-right"></i>Перелік</a></li>
                    <li><a href="<?= Url::toRoute('/admin/conference/create')?>"><i class="fa fa-angle-double-right"></i>Створити</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-book"></i>
                    <span>Наукові праці</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="<?= Url::toRoute('/admin/conference-article')?>"><i class="fa fa-angle-double-right"></i>Перелік</a></li>
                    <li><a href="<?= Url::toRoute('/admin/conference-article/create')?>"><i class="fa fa-angle-double-right"></i>Створити</a></li>
                </ul>
            </li>
        </ul>

    </section>

</aside>
