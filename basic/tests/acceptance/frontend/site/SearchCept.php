<?php
$I = new AcceptanceTester($scenario);
$I->wantTo('ensure that search page works');
$I->amOnPage('basic/web/index.php?r=site/search');
$I->see('ПМОАПВ');
$I->see('Пошук на сайті');
$I->seeLink('Контакти');
$I->seeLink('Пошук');

