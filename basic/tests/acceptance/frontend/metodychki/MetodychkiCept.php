<?php
$I = new AcceptanceTester($scenario);
$I->wantTo('ensure that metodychky index page works');
$I->amOnPage('basic/web/index.php?r=metodychky/index');
$I->fillField('#login-form-login','admin');
$I->fillField('#login-form-password','804744');
$I->click('Авторизуватися');
$I->see('Admin');
$I->see('ПМОАПВ');
$I->see('Навчально-методичне');
$I->see('Інтернаціональний');
$I->see('Лісовий  Іван');
$I->seeLink('Новини кафедри');
$I->seeLink('Контакти');
$I->seeLink('Методичні вказівки');
$I->seeLink('Войтік Андрій Володимирович');
$I->seeLink('Нова методичка');
$I->click('Нова методичка');
$I->see('Нова методичка');
$I->see('Автори методичних вказівок:');


