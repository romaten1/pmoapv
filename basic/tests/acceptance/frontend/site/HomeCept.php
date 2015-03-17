<?php
$I = new AcceptanceTester($scenario);
$I->wantTo('ensure that home page works');
$I->amOnPage('basic/web/index.php');
$I->see('ПМОАПВ');
$I->seeLink('Контакти');
$I->click('Про кафедру');
$I->see('Кафедра є випусковою');