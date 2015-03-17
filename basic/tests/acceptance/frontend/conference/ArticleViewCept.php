<?php
$I = new AcceptanceTester($scenario);
$I->wantTo('ensure that article View page works');
$I->amOnPage('basic/web/index.php?r=conference/conference-article/view&id=1');
$I->see('Назва');
$I->see('Автори');
$I->seeLink('Контакти');
//$I->seeLink('Назва');

