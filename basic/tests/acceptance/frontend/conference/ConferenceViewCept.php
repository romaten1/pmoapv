<?php
$I = new AcceptanceTester($scenario);
$I->wantTo('ensure that Conferrence view page works');
$I->amOnPage('basic/web/index.php?r=conference/conference/view&id=1');
$I->see('Дата проведення:');
$I->see('Conferrence 1');
$I->seeLink('Контакти');
//$I->seeLink('Назва');

