<?php
$I = new AcceptanceTester($scenario);
$I->wantTo('ensure that Article index page works');
$I->amOnPage('basic/web/index.php?r=conference/conference-article');
$I->see('ПМОАПВ');
$I->see('Статті з конференцій');
$I->seeLink('Контакти');
//$I->seeLink('Назва');

