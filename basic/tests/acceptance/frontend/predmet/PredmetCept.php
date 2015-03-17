<?php
$I = new AcceptanceTester($scenario);
$I->wantTo('ensure that Predmet index page and view works');
$I->amOnPage('basic/web/index.php?r=predmet/index');
$I->see('ПМОАПВ');
$I->see('Навчально-методичне');
$I->see('Інтернаціональний');
$I->see('Предмети');
$I->seeLink('Новини кафедри');
$I->seeLink('Контакти');
$I->seeLink('Методичні вказівки');
$I->seeLink('Войтік Андрій Володимирович');
$I->seeLink('Автоматизоване проектування деталей машин');
$I->click('Автоматизоване проектування деталей машин');
$I->see('Викладачі, що ведуть предмет:');
$I->seeLink('Вихватнюк Роман Вікторович');
$I->see('Методичні вказівки по даному предмету:');
$I->seeLink('Методичка по АПДМ');

