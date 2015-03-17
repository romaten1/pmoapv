<?php
$I = new AcceptanceTester($scenario);
$I->wantTo('ensure that metodychky view page works');
$I->amOnPage('basic/web/index.php?r=metodychky/view&id=28');
$I->fillField('#login-form-login','admin');
$I->fillField('#login-form-password','804744');
$I->click('Авторизуватися');
$I->see('Admin');
$I->see('ПМОАПВ');
$I->see('Інтернаціональний');
$I->seeLink('Методичні вказівки');
$I->seeLink('Войтік Андрій Володимирович');
$I->see('Нова методичка');
$I->see('Автори методичних вказівок:');


