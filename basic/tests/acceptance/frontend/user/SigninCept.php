<?php 
$I = new AcceptanceTester($scenario);
$I->wantTo('see that user sign in');
$I->amOnPage('basic/web/index.php?r=user/security/login');
$I->fillField('#login-form-login','admin');
$I->fillField('#login-form-password','804744');
$I->click ('Авторизуватися');
$I->see('Admin');
$I->seeLink('Admin');
$I->seeLink('Профіль');
$I->seeLink('Модерація');